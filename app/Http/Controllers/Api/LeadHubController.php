<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Services\LeadHub\LeadHubService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LeadHubController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected LeadHubService $leadHubService) {}

    public function storeFromMobile(Request $request): JsonResponse
    {
        return $this->storeApiLead($request, 'mobile_app');
    }

    public function storeFromWebsite(Request $request): JsonResponse
    {
        return $this->storeApiLead($request, 'website');
    }

    public function storeFacebookWebhook(Request $request): JsonResponse
    {
        return $this->storeWebhookLead($request, 'facebook');
    }

    public function storeGoogleWebhook(Request $request): JsonResponse
    {
        return $this->storeWebhookLead($request, 'google');
    }

    protected function storeApiLead(Request $request, string $source): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'external_id' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'metadata' => ['nullable', 'array'],
        ]);

        $validator->after(function ($validator) use ($request): void {
            if (blank($request->input('name')) && blank($request->input('email')) && blank($request->input('phone'))) {
                $validator->errors()->add('name', 'At least one contact field is required: name, email, or phone.');
            }
        });

        try {
            $payload = $validator->validate();
            $lead = $this->leadHubService->createFromApi($payload, $source);

            return $this->successResponse($this->serializeLead($lead), 'Lead created successfully.', 201);
        } catch (ValidationException $exception) {
            return $this->errorResponse('Validation failed.', 422, $exception->errors());
        } catch (\Throwable $exception) {
            report($exception);

            return $this->errorResponse('Unable to create lead right now.', 500);
        }
    }

    protected function storeWebhookLead(Request $request, string $provider): JsonResponse
    {
        if ($authorizationFailure = $this->validateWebhookAuthorization($request, $provider)) {
            return $authorizationFailure;
        }

        try {
            $lead = $this->leadHubService->createFromWebhook($request->all(), $provider);

            return $this->successResponse(
                $this->serializeLead($lead),
                ucfirst($provider).' webhook processed successfully.',
                201
            );
        } catch (\Throwable $exception) {
            report($exception);

            return $this->errorResponse('Unable to process webhook right now.', 500);
        }
    }

    protected function validateWebhookAuthorization(Request $request, string $provider): ?JsonResponse
    {
        $configuredSecret = config("services.leads.webhooks.{$provider}");

        if (! is_string($configuredSecret) || $configuredSecret === '') {
            return $this->errorResponse('Webhook integration is not configured.', 503);
        }

        $providedSecret = $request->headers->get('X-Afaq-Webhook-Secret')
            ?? $request->headers->get('X-Webhook-Secret');

        if (! is_string($providedSecret) || $providedSecret === '' || ! hash_equals($configuredSecret, $providedSecret)) {
            return $this->errorResponse('Invalid webhook signature.', 403);
        }

        return null;
    }

    protected function serializeLead(Lead $lead): array
    {
        return [
            'id' => $lead->id,
            'name' => $lead->name,
            'email' => $lead->email,
            'phone' => $lead->phone,
            'source' => $lead->source,
            'status' => $lead->status,
            'assigned_to' => $lead->assigned_to,
            'customer_id' => $lead->customer_id,
            'campaign_id' => $lead->campaign_id,
            'received_at' => $lead->received_at?->toDateTimeString(),
            'created_at' => $lead->created_at?->toDateTimeString(),
        ];
    }
}
