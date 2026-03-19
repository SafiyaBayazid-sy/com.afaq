<?php

namespace Tests\Feature\Api;

use App\Models\Customer;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PdfContractApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_pdf_register_and_login_endpoints_are_available(): void
    {
        $registerResponse = $this->postJson('/api/auth/register', [
            'full_name' => 'محمد العميل',
            'phone' => '0501234567',
            'email' => 'pdf.contract@example.com',
            'password' => 'Password123',
            'source' => 'social_media',
        ]);

        $registerResponse
            ->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.user.full_name', 'محمد العميل')
            ->assertJsonPath('data.user.phone', '0501234567');

        $this->assertDatabaseHas('users', [
            'email' => 'pdf.contract@example.com',
            'user_type' => 'customer',
        ]);

        $loginResponse = $this->postJson('/api/auth/login', [
            'email' => 'pdf.contract@example.com',
            'password' => 'Password123',
        ]);

        $loginResponse
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.user.email', 'pdf.contract@example.com');
    }

    public function test_pdf_projects_endpoint_returns_simplified_project_cards(): void
    {
        $project = Project::create([
            'name' => 'مشروع برج الآمال',
            'description' => 'وصف مختصر للمشروع',
            'project_status' => 'completed',
            'project_type' => 'construction',
            'property_type' => 'building',
            'is_active' => true,
        ]);

        ProjectImage::create([
            'project_id' => $project->id,
            'image_path' => 'https://example.com/uploads/project1.jpg',
            'is_main' => true,
        ]);

        $response = $this->getJson('/api/projects');

        $response
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.0.title', 'مشروع برج الآمال')
            ->assertJsonPath('data.0.image_url', 'https://example.com/uploads/project1.jpg');
    }

    public function test_pdf_inspection_consultation_and_orders_endpoints_are_available(): void
    {
        $user = User::create([
            'name' => 'عميل التطبيق',
            'email' => 'orders.contract@example.com',
            'password' => 'Password123',
            'user_type' => 'customer',
            'is_active' => true,
        ]);

        Customer::create([
            'user_id' => $user->id,
            'phone' => '0507654321',
            'source' => 'other',
        ]);

        Sanctum::actingAs($user, User::customerTokenAbilities());

        $inspectionResponse = $this->postJson('/api/inspections/store', [
            'authorized_person' => 'أحمد محمد',
            'agent_phone' => '0912345678',
            'owner_phone' => '0998765432',
            'description' => 'يوجد ضرر واضح في الواجهة الخارجية للعقار',
            'address' => 'دمشق، مشروع دمر، الجزيرة الثانية',
        ]);

        $inspectionResponse
            ->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.status', 'pending');

        $consultationResponse = $this->postJson('/api/consultations/store', [
            'full_name' => 'محمد المستفيد',
            'phone_number' => '0991122334',
            'consultation_type' => 'إنشائية',
            'question' => 'ما أفضل طريقة لمعالجة التشققات الحالية؟',
        ]);

        $consultationResponse
            ->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.status', 'assigned_soon');

        $ordersResponse = $this->getJson('/api/orders');

        $ordersResponse
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonCount(2, 'data')
            ->assertJsonFragment(['title' => 'طلب معاينة هندسية'])
            ->assertJsonFragment(['title' => 'طلب استشارة هندسية']);

        $orderId = $inspectionResponse->json('data.inspection_id');

        $orderDetailsResponse = $this->getJson("/api/orders/{$orderId}");

        $orderDetailsResponse
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.location', 'دمشق، مشروع دمر، الجزيرة الثانية')
            ->assertJsonPath('data.timeline.0.status', 'pending')
            ->assertJsonPath('data.timeline.0.is_completed', true);
    }
}
