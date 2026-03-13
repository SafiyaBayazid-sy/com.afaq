<?php

namespace App\Services\FormBuilder;

use App\Models\Customer;
use App\Models\FormField;
use App\Models\FormSubmission;
use App\Models\FormSubmissionAnswer;
use App\Models\FormTemplate;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class FormBuilderService
{
    public function getPublishedTemplateBySlug(string $slug): ?FormTemplate
    {
        return FormTemplate::query()
            ->published()
            ->where('slug', $slug)
            ->with([
                'fields' => fn ($query) => $query->active()->orderBy('sort_order'),
            ])
            ->first();
    }

    public function serializeTemplate(FormTemplate $template): array
    {
        return [
            'id' => $template->id,
            'name' => $template->name,
            'slug' => $template->slug,
            'description' => $template->description,
            'target' => $template->target,
            'success_message' => $template->success_message,
            'settings' => $template->settings ?? [],
            'fields' => $template->fields
                ->where('is_active', true)
                ->sortBy('sort_order')
                ->values()
                ->map(fn (FormField $field) => [
                    'id' => $field->id,
                    'label' => $field->label,
                    'key' => $field->key,
                    'type' => $field->type,
                    'placeholder' => $field->placeholder,
                    'help_text' => $field->help_text,
                    'is_required' => $field->is_required,
                    'sort_order' => $field->sort_order,
                    'options' => $field->normalized_options,
                    'constraints' => [
                        'min_length' => $field->min_length,
                        'max_length' => $field->max_length,
                        'min_value' => $field->min_value,
                        'max_value' => $field->max_value,
                    ],
                ])
                ->all(),
        ];
    }

    /**
     * @throws ValidationException
     */
    public function submit(FormTemplate $template, array $payload, ?User $user = null): FormSubmission
    {
        $validated = $this->validatePayload($template, $payload);
        $customerId = $this->resolveCustomerId($validated, $user);
        $answers = $validated['answers'] ?? [];

        return DB::transaction(function () use ($template, $validated, $customerId, $answers): FormSubmission {
            $submission = $template->submissions()->create([
                'customer_id' => $customerId,
                'source' => $validated['source'] ?? 'web',
                'lead_name' => $validated['lead_name'] ?? null,
                'lead_email' => $validated['lead_email'] ?? null,
                'lead_phone' => $validated['lead_phone'] ?? null,
                'submitted_at' => now(),
                'meta' => $validated['meta'] ?? null,
            ]);

            foreach ($template->fields->where('is_active', true)->sortBy('sort_order') as $field) {
                if (! array_key_exists($field->key, $answers)) {
                    continue;
                }

                $value = $answers[$field->key];

                if ($this->isEmptyAnswer($value)) {
                    continue;
                }

                $serializedAnswer = $this->serializeAnswer($value);

                FormSubmissionAnswer::create([
                    'form_submission_id' => $submission->id,
                    'form_field_id' => $field->id,
                    'field_key' => $field->key,
                    'field_label' => $field->label,
                    'field_type' => $field->type,
                    'answer_text' => $serializedAnswer['answer_text'],
                    'answer_json' => $serializedAnswer['answer_json'],
                ]);
            }

            return $submission->load([
                'template',
                'customer.user',
                'answers' => fn ($query) => $query->orderBy('id'),
            ]);
        });
    }

    /**
     * @throws ValidationException
     */
    public function validatePayload(FormTemplate $template, array $payload): array
    {
        $rules = [
            'lead_name' => ['nullable', 'string', 'max:255'],
            'lead_email' => ['nullable', 'email', 'max:255'],
            'lead_phone' => ['nullable', 'string', 'max:30'],
            'customer_id' => ['nullable', 'integer', 'exists:customers,id'],
            'source' => ['nullable', Rule::in(['web', 'app', 'api', 'admin'])],
            'meta' => ['nullable', 'array'],
            'answers' => ['required', 'array'],
        ];

        $attributes = [];
        $activeFields = $template->fields->where('is_active', true)->values();

        foreach ($activeFields as $field) {
            $key = "answers.{$field->key}";
            $attributes[$key] = $field->label;
            $rules[$key] = $this->buildFieldRules($field);

            if ($field->type === 'multi_select' && filled($field->normalized_options)) {
                $rules["{$key}.*"] = [Rule::in(array_keys($field->normalized_options))];
            }
        }

        $validator = Validator::make($payload, $rules, [], $attributes);

        $allowedFieldKeys = $activeFields->pluck('key')->all();

        $validator->after(function ($validator) use ($payload, $allowedFieldKeys): void {
            foreach (array_keys(Arr::get($payload, 'answers', [])) as $submittedKey) {
                if (in_array($submittedKey, $allowedFieldKeys, true)) {
                    continue;
                }

                $validator->errors()->add(
                    "answers.{$submittedKey}",
                    'This field does not belong to the selected form.'
                );
            }
        });

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        return $validator->validated();
    }

    protected function buildFieldRules(FormField $field): array
    {
        $rules = [$field->is_required ? 'required' : 'nullable'];

        switch ($field->type) {
            case 'text':
            case 'textarea':
                $rules[] = 'string';

                if (! is_null($field->min_length)) {
                    $rules[] = "min:{$field->min_length}";
                }

                if (! is_null($field->max_length)) {
                    $rules[] = "max:{$field->max_length}";
                }
                break;

            case 'email':
                $rules[] = 'email';
                $rules[] = 'max:255';
                break;

            case 'phone':
                $rules[] = 'string';
                $rules[] = 'max:30';
                break;

            case 'number':
                $rules[] = 'numeric';

                if (! is_null($field->min_value)) {
                    $rules[] = "min:{$field->min_value}";
                }

                if (! is_null($field->max_value)) {
                    $rules[] = "max:{$field->max_value}";
                }
                break;

            case 'date':
                $rules[] = 'date';
                break;

            case 'select':
            case 'radio':
                $rules[] = 'string';

                if (filled($field->normalized_options)) {
                    $rules[] = Rule::in(array_keys($field->normalized_options));
                }
                break;

            case 'checkbox':
                $rules[] = 'boolean';
                break;

            case 'multi_select':
                $rules[] = 'array';

                if ($field->is_required) {
                    $rules[] = 'min:1';
                }
                break;
        }

        return $rules;
    }

    protected function resolveCustomerId(array $validatedPayload, ?User $user = null): ?int
    {
        if (! empty($validatedPayload['customer_id'])) {
            return (int) $validatedPayload['customer_id'];
        }

        if ($user) {
            $customerId = $user->customerProfile()->value('id');

            if ($customerId) {
                return (int) $customerId;
            }
        }

        $leadEmail = $validatedPayload['lead_email'] ?? null;
        $leadPhone = $validatedPayload['lead_phone'] ?? null;

        if (blank($leadEmail) && blank($leadPhone)) {
            return null;
        }

        return Customer::query()
            ->where(function ($query) use ($leadEmail, $leadPhone): void {
                if (filled($leadPhone)) {
                    $query->orWhere('phone', $leadPhone);
                }

                if (filled($leadEmail)) {
                    $query->orWhereHas('user', fn ($userQuery) => $userQuery->where('email', $leadEmail));
                }
            })
            ->value('id');
    }

    protected function serializeAnswer(mixed $value): array
    {
        if (is_array($value)) {
            return [
                'answer_text' => null,
                'answer_json' => $value,
            ];
        }

        if (is_bool($value)) {
            return [
                'answer_text' => $value ? 'true' : 'false',
                'answer_json' => null,
            ];
        }

        return [
            'answer_text' => (string) $value,
            'answer_json' => null,
        ];
    }

    protected function isEmptyAnswer(mixed $value): bool
    {
        return is_null($value) || $value === '' || (is_array($value) && $value === []);
    }
}




