<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DocsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_docs_home_page_is_available_and_organized(): void
    {
        $this->actingAs(User::factory()->create([
            'user_type' => 'admin',
            'is_active' => true,
        ]));

        $response = $this->get('/docs');

        $response
            ->assertOk()
            ->assertSee('AFAQ Docs Hub')
            ->assertSee('Interactive API Reference')
            ->assertSee('Mobile Team Quickstart')
            ->assertSee('Postman Collection');
    }

    public function test_docs_guide_page_can_render_text_document(): void
    {
        $this->actingAs(User::factory()->create([
            'user_type' => 'admin',
            'is_active' => true,
        ]));

        $response = $this->get('/docs/guides/quickstart');

        $response
            ->assertOk()
            ->assertSee('Mobile Team Quickstart')
            ->assertSee('AFAQ Customer API Quickstart');
    }

    public function test_docs_guide_page_can_render_the_crm_features_guide(): void
    {
        $this->actingAs(User::factory()->create([
            'user_type' => 'admin',
            'is_active' => true,
        ]));

        $response = $this->get('/docs/guides/crm-features');

        $response
            ->assertOk()
            ->assertSee('How the AFAQ CRM works from lead capture to follow-up.')
            ->assertSee('Admin Workspaces')
            ->assertSee('Dashboard KPIs');
    }

    public function test_docs_routes_are_not_public_outside_local_development(): void
    {
        $this->get('/docs')->assertForbidden();
    }
}
