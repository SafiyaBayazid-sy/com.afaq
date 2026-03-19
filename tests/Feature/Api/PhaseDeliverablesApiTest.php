<?php

namespace Tests\Feature\Api;

use App\Models\Customer;
use App\Models\InquiryCategory;
use App\Models\Notification;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PhaseDeliverablesApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_auth_register_and_login_endpoints_work(): void
    {
        $register = $this->postJson('/api/v1/auth/register', [
            'name' => 'API Customer',
            'email' => 'api.customer@example.com',
            'password' => 'password123',
            'phone' => '0555444333',
            'source' => 'other',
        ]);

        $register
            ->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonStructure([
                'data' => ['user', 'customer', 'token'],
            ]);

        $login = $this->postJson('/api/v1/auth/login', [
            'email' => 'api.customer@example.com',
            'password' => 'password123',
        ]);

        $login
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonStructure([
                'data' => ['user', 'token'],
            ]);
    }

    public function test_projects_endpoint_returns_active_projects(): void
    {
        Project::create([
            'name' => 'Active Project',
            'project_status' => 'on_hold',
            'is_active' => true,
        ]);

        Project::create([
            'name' => 'Inactive Project',
            'project_status' => 'on_hold',
            'is_active' => false,
        ]);

        $response = $this->getJson('/api/v1/projects');

        $response
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonCount(1, 'data.data');
    }

    public function test_authenticated_user_can_submit_inquiry_booking_profile_and_notifications(): void
    {
        $user = User::create([
            'name' => 'Customer User',
            'email' => 'customer.user@example.com',
            'password' => 'password123',
            'user_type' => 'customer',
            'is_active' => true,
        ]);

        $customer = Customer::create([
            'user_id' => $user->id,
            'phone' => '0555666777',
            'source' => 'other',
        ]);

        $category = InquiryCategory::create([
            'name' => 'General',
            'is_active' => true,
        ]);

        Notification::create([
            'user_id' => $user->id,
            'type' => 'system',
            'title' => 'Hello',
            'message' => 'Welcome',
            'is_read' => false,
        ]);

        Sanctum::actingAs($user, User::customerTokenAbilities());

        $inquiryResponse = $this->postJson('/api/v1/inquiries', [
            'category_id' => $category->id,
            'message' => 'I need more details.',
        ]);

        $inquiryResponse
            ->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.customer_id', $customer->id);

        $bookingResponse = $this->postJson('/api/v1/bookings', [
            'booking_date' => now()->addDay()->toDateString(),
            'booking_time' => '10:30',
            'notes' => 'Morning slot preferred',
        ]);

        $bookingResponse
            ->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.customer_id', $customer->id);

        $profileResponse = $this->getJson('/api/v1/my/profile');

        $profileResponse
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.email', 'customer.user@example.com');

        $notificationsResponse = $this->getJson('/api/v1/my/notifications');

        $notificationsResponse
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonCount(1, 'data.data');
    }
}
