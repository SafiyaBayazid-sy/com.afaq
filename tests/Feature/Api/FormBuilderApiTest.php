<?php

namespace Tests\Feature\Api;

use App\Models\Customer;
use App\Models\FormField;
use App\Models\FormTemplate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class FormBuilderApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_a_published_form_template(): void
    {
        $template = FormTemplate::create([
            'name' => 'Contact Form',
            'slug' => 'contact-form',
            'target' => 'both',
            'is_active' => true,
            'published_at' => now()->subMinute(),
        ]);

        FormField::create([
            'form_template_id' => $template->id,
            'label' => 'Full Name',
            'key' => 'full_name',
            'type' => 'text',
            'is_required' => true,
            'sort_order' => 1,
        ]);

        $response = $this->getJson('/api/v1/forms/contact-form');

        $response
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.slug', 'contact-form')
            ->assertJsonPath('data.fields.0.key', 'full_name');
    }

    public function test_it_validates_required_dynamic_fields_on_submission(): void
    {
        $template = FormTemplate::create([
            'name' => 'Inquiry Form',
            'slug' => 'inquiry-form',
            'target' => 'web',
            'is_active' => true,
            'published_at' => now()->subMinute(),
        ]);

        FormField::create([
            'form_template_id' => $template->id,
            'label' => 'Message',
            'key' => 'message',
            'type' => 'textarea',
            'is_required' => true,
            'sort_order' => 1,
        ]);

        $response = $this->postJson('/api/v1/forms/inquiry-form/submissions', [
            'source' => 'web',
            'answers' => [],
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonPath('success', false)
            ->assertJsonStructure([
                'errors' => [
                    'answers.message',
                ],
            ]);
    }

    public function test_it_stores_submission_and_links_customer_by_email(): void
    {
        $user = User::create([
            'name' => 'Customer One',
            'email' => 'customer@example.com',
            'password' => 'password123',
            'user_type' => 'customer',
            'is_active' => true,
        ]);

        $customer = Customer::create([
            'user_id' => $user->id,
            'phone' => '0500000000',
            'source' => 'other',
        ]);

        $template = FormTemplate::create([
            'name' => 'Lead Form',
            'slug' => 'lead-form',
            'target' => 'both',
            'is_active' => true,
            'published_at' => now()->subMinute(),
        ]);

        FormField::create([
            'form_template_id' => $template->id,
            'label' => 'Budget',
            'key' => 'budget',
            'type' => 'number',
            'is_required' => true,
            'sort_order' => 1,
        ]);

        $response = $this->postJson('/api/v1/forms/lead-form/submissions', [
            'source' => 'app',
            'lead_name' => 'Existing Customer',
            'lead_email' => 'customer@example.com',
            'answers' => [
                'budget' => 250000,
            ],
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.customer_id', $customer->id);

        $this->assertDatabaseHas('form_submissions', [
            'form_template_id' => $template->id,
            'customer_id' => $customer->id,
            'lead_email' => 'customer@example.com',
        ]);

        $this->assertDatabaseHas('form_submission_answers', [
            'field_key' => 'budget',
            'answer_text' => '250000',
        ]);
    }

    public function test_authenticated_submission_uses_the_authenticated_customer_even_when_customer_id_is_supplied(): void
    {
        $user = User::create([
            'name' => 'Primary Customer',
            'email' => 'primary@example.com',
            'password' => 'password123',
            'user_type' => 'customer',
            'is_active' => true,
        ]);

        $customer = Customer::create([
            'user_id' => $user->id,
            'phone' => '0501111111',
            'source' => 'other',
        ]);

        $otherUser = User::create([
            'name' => 'Other Customer',
            'email' => 'other@example.com',
            'password' => 'password123',
            'user_type' => 'customer',
            'is_active' => true,
        ]);

        $otherCustomer = Customer::create([
            'user_id' => $otherUser->id,
            'phone' => '0502222222',
            'source' => 'other',
        ]);

        $template = FormTemplate::create([
            'name' => 'Secure Form',
            'slug' => 'secure-form',
            'target' => 'both',
            'is_active' => true,
            'published_at' => now()->subMinute(),
        ]);

        FormField::create([
            'form_template_id' => $template->id,
            'label' => 'Details',
            'key' => 'details',
            'type' => 'textarea',
            'is_required' => true,
            'sort_order' => 1,
        ]);

        Sanctum::actingAs($user, User::customerTokenAbilities());

        $response = $this->postJson('/api/v1/forms/secure-form/submissions', [
            'customer_id' => $otherCustomer->id,
            'source' => 'app',
            'answers' => [
                'details' => 'Use my own account',
            ],
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.customer_id', $customer->id);

        $this->assertDatabaseHas('form_submissions', [
            'form_template_id' => $template->id,
            'customer_id' => $customer->id,
        ]);
    }
}
