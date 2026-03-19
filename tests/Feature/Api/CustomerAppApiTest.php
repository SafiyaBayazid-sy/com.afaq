<?php

namespace Tests\Feature\Api;

use App\Models\Customer;
use App\Models\DeviceToken;
use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CustomerAppApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_projects_endpoint_supports_search_filters_and_sorting(): void
    {
        Project::create([
            'name' => 'Riyadh Tower',
            'description' => 'Luxury construction project in Riyadh',
            'city' => 'Riyadh',
            'price' => 2500000,
            'project_status' => 'in_progress',
            'project_type' => 'construction',
            'property_type' => 'building',
            'is_active' => true,
        ]);

        Project::create([
            'name' => 'Jeddah Villa',
            'description' => 'Renovation package',
            'city' => 'Jeddah',
            'price' => 800000,
            'project_status' => 'completed',
            'project_type' => 'renovation',
            'property_type' => 'villa',
            'is_active' => true,
        ]);

        Project::create([
            'name' => 'Hidden Riyadh Project',
            'description' => 'Should not be visible without include_inactive',
            'city' => 'Riyadh',
            'price' => 2100000,
            'project_status' => 'in_progress',
            'project_type' => 'construction',
            'property_type' => 'building',
            'is_active' => false,
        ]);

        $response = $this->getJson('/api/v1/projects?search=Riyadh&city=Riyadh&project_status=in_progress&project_type=construction&property_type=building&min_price=2000000&sort_by=price&sort_direction=asc');

        $response
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonCount(1, 'data.data')
            ->assertJsonPath('data.data.0.name', 'Riyadh Tower');

        $filtersResponse = $this->getJson('/api/v1/projects/filters');

        $filtersResponse
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.project_statuses.1.value', 'in_progress')
            ->assertJsonPath('data.property_types.0.value', 'villa');
    }

    public function test_inactive_project_detail_is_not_publicly_accessible(): void
    {
        $project = Project::create([
            'name' => 'Private Project',
            'description' => 'Hidden from public API',
            'project_status' => 'on_hold',
            'is_active' => false,
        ]);

        $this->getJson("/api/v1/projects/{$project->id}")
            ->assertStatus(404)
            ->assertJsonPath('success', false);
    }

    public function test_public_settings_and_content_pages_are_available_for_customer_app(): void
    {
        Setting::create([
            'key' => 'site_name',
            'value' => 'AFAQ',
            'type' => 'text',
            'group' => 'general',
            'is_public' => true,
        ]);

        Setting::create([
            'key' => 'site_description',
            'value' => 'Customer-first real estate platform',
            'type' => 'text',
            'group' => 'general',
            'is_public' => true,
        ]);

        Setting::create([
            'key' => 'contact_phone',
            'value' => '+966500000000',
            'type' => 'text',
            'group' => 'contact',
            'is_public' => true,
        ]);

        Setting::create([
            'key' => 'contact_email',
            'value' => 'hello@afaq.test',
            'type' => 'text',
            'group' => 'contact',
            'is_public' => true,
        ]);

        Setting::create([
            'key' => 'android_app_url',
            'value' => 'https://play.google.com/store/apps/details?id=com.afaq',
            'type' => 'text',
            'group' => 'mobile',
            'is_public' => true,
        ]);

        Setting::create([
            'key' => 'privacy_policy_url',
            'value' => 'https://afaq.test/privacy',
            'type' => 'text',
            'group' => 'mobile',
            'is_public' => true,
        ]);

        $settingsResponse = $this->getJson('/api/v1/settings/public');

        $settingsResponse
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.site_info.name', 'AFAQ')
            ->assertJsonPath('data.app_links.android', 'https://play.google.com/store/apps/details?id=com.afaq')
            ->assertJsonPath('data.groups.mobile.android_app_url', 'https://play.google.com/store/apps/details?id=com.afaq');

        $pagesResponse = $this->getJson('/api/v1/content/pages');

        $pagesResponse
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonFragment(['slug' => 'about'])
            ->assertJsonFragment(['slug' => 'app-download']);

        $appDownloadResponse = $this->getJson('/api/v1/content/pages/app-download');

        $appDownloadResponse
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.sections.0.content.android', 'https://play.google.com/store/apps/details?id=com.afaq')
            ->assertJsonPath('data.sections.0.content.privacy_policy', 'https://afaq.test/privacy');
    }

    public function test_authenticated_customer_can_manage_device_tokens(): void
    {
        $user = User::create([
            'name' => 'Customer App User',
            'email' => 'customer@app.test',
            'password' => 'password123',
            'user_type' => 'customer',
            'is_active' => true,
        ]);

        Customer::create([
            'user_id' => $user->id,
            'phone' => '0501234567',
            'source' => 'other',
        ]);

        Sanctum::actingAs($user, User::customerTokenAbilities());

        $storeResponse = $this->postJson('/api/v1/my/device-tokens', [
            'token' => 'expo-token-1',
            'platform' => 'android',
            'device_name' => 'Pixel 8',
            'app_version' => '1.0.0',
        ]);

        $storeResponse
            ->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.platform', 'android');

        $this->assertDatabaseHas('device_tokens', [
            'user_id' => $user->id,
            'token' => 'expo-token-1',
            'platform' => 'android',
        ]);

        $updateResponse = $this->postJson('/api/v1/my/device-tokens', [
            'token' => 'expo-token-1',
            'platform' => 'android',
            'device_name' => 'Pixel 8 Pro',
            'app_version' => '1.1.0',
        ]);

        $updateResponse
            ->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.device_name', 'Pixel 8 Pro');

        $this->assertDatabaseCount('device_tokens', 1);

        $listResponse = $this->getJson('/api/v1/my/device-tokens');

        $listResponse
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonCount(1, 'data');

        $deviceTokenId = $updateResponse->json('data.id');

        $deleteResponse = $this->deleteJson("/api/v1/my/device-tokens/{$deviceTokenId}");

        $deleteResponse
            ->assertOk()
            ->assertJsonPath('success', true);

        $this->assertDatabaseMissing('device_tokens', [
            'id' => $deviceTokenId,
        ]);
    }

    public function test_user_cannot_delete_another_users_device_token(): void
    {
        $owner = User::create([
            'name' => 'Owner',
            'email' => 'owner@app.test',
            'password' => 'password123',
            'user_type' => 'customer',
            'is_active' => true,
        ]);

        $otherUser = User::create([
            'name' => 'Other User',
            'email' => 'other@app.test',
            'password' => 'password123',
            'user_type' => 'customer',
            'is_active' => true,
        ]);

        $deviceToken = DeviceToken::create([
            'user_id' => $owner->id,
            'token' => 'foreign-token',
            'platform' => 'ios',
            'device_name' => 'iPhone',
        ]);

        Sanctum::actingAs($otherUser, User::customerTokenAbilities());

        $response = $this->deleteJson("/api/v1/my/device-tokens/{$deviceToken->id}");

        $response
            ->assertForbidden()
            ->assertJsonPath('success', false);
    }

    public function test_authenticated_customer_cannot_override_booking_customer_context(): void
    {
        $user = User::create([
            'name' => 'Booking User',
            'email' => 'booking@app.test',
            'password' => 'password123',
            'user_type' => 'customer',
            'is_active' => true,
        ]);

        $customer = Customer::create([
            'user_id' => $user->id,
            'phone' => '0509990001',
            'source' => 'other',
        ]);

        $otherUser = User::create([
            'name' => 'Other Booking User',
            'email' => 'booking-other@app.test',
            'password' => 'password123',
            'user_type' => 'customer',
            'is_active' => true,
        ]);

        $otherCustomer = Customer::create([
            'user_id' => $otherUser->id,
            'phone' => '0509990002',
            'source' => 'other',
        ]);

        Sanctum::actingAs($user, User::customerTokenAbilities());

        $response = $this->postJson('/api/v1/bookings', [
            'customer_id' => $otherCustomer->id,
            'booking_date' => now()->addDay()->toDateString(),
            'booking_time' => '10:30',
            'notes' => 'Keep my own customer context',
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.customer_id', $customer->id);

        $this->assertDatabaseHas('bookings', [
            'customer_id' => $customer->id,
            'notes' => 'Keep my own customer context',
        ]);
    }

    public function test_authenticated_customer_cannot_override_inquiry_customer_context(): void
    {
        $user = User::create([
            'name' => 'Inquiry User',
            'email' => 'inquiry@app.test',
            'password' => 'password123',
            'user_type' => 'customer',
            'is_active' => true,
        ]);

        $customer = Customer::create([
            'user_id' => $user->id,
            'phone' => '0509990011',
            'source' => 'other',
        ]);

        $otherUser = User::create([
            'name' => 'Other Inquiry User',
            'email' => 'inquiry-other@app.test',
            'password' => 'password123',
            'user_type' => 'customer',
            'is_active' => true,
        ]);

        $otherCustomer = Customer::create([
            'user_id' => $otherUser->id,
            'phone' => '0509990012',
            'source' => 'other',
        ]);

        Sanctum::actingAs($user, User::customerTokenAbilities());

        $response = $this->postJson('/api/v1/inquiries', [
            'customer_id' => $otherCustomer->id,
            'message' => 'Keep inquiry tied to my own account',
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.customer_id', $customer->id);

        $this->assertDatabaseHas('inquiries', [
            'customer_id' => $customer->id,
            'message' => 'Keep inquiry tied to my own account',
        ]);
    }
}
