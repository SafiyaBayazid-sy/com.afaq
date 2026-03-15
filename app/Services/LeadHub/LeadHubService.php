<?php

namespace App\Services\LeadHub;

use App\Models\Customer;
use App\Models\Lead;
use App\Models\LeadActivity;
use App\Models\MarketingCampaign;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class LeadHubService
{
    public function createFromApi(array $payload, string $source): Lead
    {
        $leadData = [
            'name' => Arr::get($payload, 'name'),
            'email' => Arr::get($payload, 'email'),
            'phone' => Arr::get($payload, 'phone'),
            'status' => Arr::get($payload, 'status', 'new'),
            'assigned_to' => Arr::get($payload, 'assigned_to'),
            'campaign_id' => Arr::get($payload, 'campaign_id'),
            'notes' => Arr::get($payload, 'notes'),
            'metadata' => Arr::get($payload, 'metadata', []),
            'received_at' => now(),
            'customer_id' => Arr::get($payload, 'customer_id'),
        ];

        return $this->persistLead(
            $leadData,
            $source,
            filled(Arr::get($payload, 'external_id')) ? (string) Arr::get($payload, 'external_id') : null
        );
    }

    public function createFromWebhook(array $payload, string $provider): Lead
    {
        $normalized = match ($provider) {
            'facebook' => $this->normalizeFacebookPayload($payload),
            'google' => $this->normalizeGooglePayload($payload),
            default => [],
        };

        $leadData = [
            'name' => Arr::get($normalized, 'name'),
            'email' => Arr::get($normalized, 'email'),
            'phone' => Arr::get($normalized, 'phone'),
            'status' => 'new',
            'notes' => Arr::get($normalized, 'notes'),
            'metadata' => [
                'provider' => $provider,
                'normalized' => $normalized,
                'raw_payload' => $payload,
            ],
            'received_at' => now(),
            'customer_id' => Arr::get($normalized, 'customer_id'),
            'campaign_id' => Arr::get($normalized, 'campaign_id'),
        ];

        return $this->persistLead(
            $leadData,
            $provider,
            filled(Arr::get($normalized, 'external_id')) ? (string) Arr::get($normalized, 'external_id') : null
        );
    }

    protected function persistLead(array $leadData, string $source, ?string $externalId = null): Lead
    {
        return DB::transaction(function () use ($leadData, $source, $externalId): Lead {
            $leadData['source'] = $source;
            $leadData['external_id'] = $externalId;
            $leadData['customer_id'] = $leadData['customer_id'] ?? $this->resolveCustomerId($leadData);
            $leadData['campaign_id'] = $leadData['campaign_id'] ?? $this->resolveCampaignId($leadData);

            if (filled($externalId)) {
                $existingLead = Lead::query()
                    ->where('source', $source)
                    ->where('external_id', $externalId)
                    ->first();

                if ($existingLead) {
                    $existingLead->fill(array_filter([
                        'name' => $leadData['name'] ?? null,
                        'email' => $leadData['email'] ?? null,
                        'phone' => $leadData['phone'] ?? null,
                        'notes' => $leadData['notes'] ?? null,
                        'metadata' => $leadData['metadata'] ?? [],
                        'customer_id' => $leadData['customer_id'] ?? null,
                        'campaign_id' => $leadData['campaign_id'] ?? null,
                        'received_at' => $leadData['received_at'] ?? now(),
                    ], fn ($value) => ! is_null($value)));
                    $existingLead->save();

                    LeadActivity::create([
                        'lead_id' => $existingLead->id,
                        'user_id' => auth()->id(),
                        'activity_type' => 'webhook_synced',
                        'description' => "Webhook payload synced for {$source}.",
                        'meta' => [
                            'source' => $source,
                            'external_id' => $externalId,
                        ],
                    ]);

                    return $existingLead->fresh(['assignee', 'customer', 'campaign']);
                }
            }

            $lead = Lead::create($leadData);

            LeadActivity::create([
                'lead_id' => $lead->id,
                'user_id' => auth()->id(),
                'activity_type' => 'ingested',
                'description' => "Lead ingested from {$source}.",
                'meta' => [
                    'source' => $source,
                    'external_id' => $externalId,
                ],
            ]);

            return $lead->fresh(['assignee', 'customer', 'campaign']);
        });
    }

    protected function resolveCustomerId(array $leadData): ?int
    {
        if (! empty($leadData['customer_id'])) {
            return (int) $leadData['customer_id'];
        }

        $email = Arr::get($leadData, 'email');
        $phone = Arr::get($leadData, 'phone');

        if (blank($email) && blank($phone)) {
            return null;
        }

        return Customer::query()
            ->where(function ($query) use ($email, $phone): void {
                if (filled($phone)) {
                    $query->orWhere('phone', $phone);
                }

                if (filled($email)) {
                    $query->orWhereHas('user', fn ($userQuery) => $userQuery->where('email', $email));
                }
            })
            ->value('id');
    }

    protected function resolveCampaignId(array $leadData): ?int
    {
        if (! empty($leadData['campaign_id'])) {
            return (int) $leadData['campaign_id'];
        }

        $utmCampaign = Arr::get($leadData, 'utm_campaign');
        $campaignName = Arr::get($leadData, 'campaign_name') ?? Arr::get($leadData, 'notes');

        if (blank($utmCampaign) && blank($campaignName)) {
            return null;
        }

        return MarketingCampaign::query()
            ->where(function ($query) use ($utmCampaign, $campaignName): void {
                if (filled($utmCampaign)) {
                    $query->orWhere('utm_campaign', $utmCampaign);
                }

                if (filled($campaignName)) {
                    $query->orWhere('name', $campaignName);
                }
            })
            ->value('id');
    }

    protected function normalizeFacebookPayload(array $payload): array
    {
        $fieldData = collect(Arr::get($payload, 'field_data', []))
            ->mapWithKeys(function ($item) {
                $name = strtolower((string) Arr::get($item, 'name', ''));
                $value = Arr::get($item, 'values.0');

                return [$name => $value];
            })
            ->all();

        $campaignName = Arr::get($payload, 'campaign_name');
        $utmCampaign = Arr::get($payload, 'utm_campaign');
        $externalId = Arr::get($payload, 'leadgen_id') ?? Arr::get($payload, 'id');

        return [
            'external_id' => filled($externalId) ? (string) $externalId : null,
            'name' => $this->pickValue($fieldData, ['full_name', 'name', 'first_name']),
            'email' => $this->pickValue($fieldData, ['email', 'email_address']),
            'phone' => $this->pickValue($fieldData, ['phone_number', 'phone', 'mobile']),
            'notes' => $campaignName,
            'campaign_id' => $this->resolveCampaignId([
                'campaign_name' => $campaignName,
                'utm_campaign' => $utmCampaign,
            ]),
        ];
    }

    protected function normalizeGooglePayload(array $payload): array
    {
        $columnData = collect(Arr::get($payload, 'user_column_data', []))
            ->mapWithKeys(function ($item) {
                $columnName = strtolower((string) Arr::get($item, 'column_name', ''));
                $value = Arr::get($item, 'string_value');

                return [$columnName => $value];
            })
            ->all();

        $topLevel = collect($payload)
            ->mapWithKeys(fn ($value, $key) => [strtolower((string) $key) => $value])
            ->all();

        $formName = Arr::get($payload, 'form_name');
        $utmCampaign = Arr::get($payload, 'utm_campaign');
        $externalId = Arr::get($payload, 'lead_id') ?? Arr::get($payload, 'id');

        return [
            'external_id' => filled($externalId) ? (string) $externalId : null,
            'name' => $this->pickValue($columnData + $topLevel, ['full name', 'full_name', 'name']),
            'email' => $this->pickValue($columnData + $topLevel, ['email', 'email_address']),
            'phone' => $this->pickValue($columnData + $topLevel, ['phone number', 'phone_number', 'phone', 'mobile']),
            'notes' => $formName,
            'campaign_id' => $this->resolveCampaignId([
                'campaign_name' => $formName,
                'utm_campaign' => $utmCampaign,
            ]),
        ];
    }

    protected function pickValue(array $data, array $keys): ?string
    {
        foreach ($keys as $key) {
            $value = Arr::get($data, $key);

            if (filled($value)) {
                return (string) $value;
            }
        }

        return null;
    }
}
