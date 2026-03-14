<?php

namespace Tests\Feature\Api;

use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeadHubApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_mobile_api_creates_new_lead(): void
    {
        $response = $this->postJson('/api/v1/leads/mobile', [
            'name' => 'Lead From App',
            'email' => 'lead@app.com',
            'phone' => '0555000001',
            'notes' => 'Interested in premium package',
            'metadata' => [
                'platform' => 'ios',
            ],
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.source', 'mobile_app')
            ->assertJsonPath('data.status', 'new');

        $this->assertDatabaseHas('leads', [
            'email' => 'lead@app.com',
            'source' => 'mobile_app',
            'status' => 'new',
        ]);

        $this->assertDatabaseHas('lead_activities', [
            'activity_type' => 'ingested',
            'description' => 'Lead ingested from mobile_app.',
        ]);
    }

    public function test_website_api_requires_minimum_contact_fields(): void
    {
        $response = $this->postJson('/api/v1/leads/website', [
            'notes' => 'No identifying info sent',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonPath('success', false)
            ->assertJsonStructure([
                'errors' => [
                    'name',
                ],
            ]);
    }

    public function test_facebook_webhook_deduplicates_by_external_id(): void
    {
        $payload = [
            'leadgen_id' => 'fb-123',
            'campaign_name' => 'Spring Campaign',
            'field_data' => [
                [
                    'name' => 'full_name',
                    'values' => ['Facebook Lead'],
                ],
                [
                    'name' => 'email',
                    'values' => ['fb@lead.com'],
                ],
                [
                    'name' => 'phone_number',
                    'values' => ['0555111222'],
                ],
            ],
        ];

        $this->postJson('/api/v1/leads/webhooks/facebook', $payload)->assertStatus(201);
        $this->postJson('/api/v1/leads/webhooks/facebook', $payload)->assertStatus(201);

        $this->assertEquals(1, Lead::query()->where('source', 'facebook')->count());

        $this->assertDatabaseHas('lead_activities', [
            'activity_type' => 'webhook_synced',
        ]);
    }

    public function test_google_webhook_maps_user_column_data(): void
    {
        $response = $this->postJson('/api/v1/leads/webhooks/google', [
            'lead_id' => 'gg-321',
            'form_name' => 'Google Lead Form',
            'user_column_data' => [
                [
                    'column_name' => 'Full Name',
                    'string_value' => 'Google Lead',
                ],
                [
                    'column_name' => 'Email',
                    'string_value' => 'google@lead.com',
                ],
                [
                    'column_name' => 'Phone Number',
                    'string_value' => '0555333444',
                ],
            ],
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.source', 'google');

        $this->assertDatabaseHas('leads', [
            'source' => 'google',
            'external_id' => 'gg-321',
            'email' => 'google@lead.com',
            'name' => 'Google Lead',
        ]);
    }
}
