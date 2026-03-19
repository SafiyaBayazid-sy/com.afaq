<?php

namespace Tests\Feature\Api;

use App\Mail\AppDownloadLinkMail;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AppDownloadLinkApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_sends_app_download_link_email_to_requested_address(): void
    {
        Mail::fake();

        Setting::create([
            'key' => 'android_app_url',
            'value' => 'https://play.google.com/store/apps/details?id=com.afaq',
            'type' => 'text',
            'group' => 'mobile',
            'is_public' => true,
        ]);

        $response = $this->postJson('/api/v1/app-link/request', [
            'email' => 'user@example.com',
        ]);

        $response
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.email', 'user@example.com');

        Mail::assertSent(AppDownloadLinkMail::class, function (AppDownloadLinkMail $mail) {
            return $mail->hasTo('user@example.com')
                && $mail->androidUrl === 'https://play.google.com/store/apps/details?id=com.afaq';
        });
    }

    public function test_it_requires_a_valid_email_address(): void
    {
        Mail::fake();

        $response = $this->postJson('/api/v1/app-link/request', [
            'email' => 'not-an-email',
        ]);

        $response->assertStatus(422);

        Mail::assertNothingSent();
    }

    public function test_it_is_rate_limited(): void
    {
        Mail::fake();

        Setting::create([
            'key' => 'android_app_url',
            'value' => 'https://play.google.com/store/apps/details?id=com.afaq',
            'type' => 'text',
            'group' => 'mobile',
            'is_public' => true,
        ]);

        for ($attempt = 0; $attempt < 3; $attempt++) {
            $this->postJson('/api/v1/app-link/request', [
                'email' => "user{$attempt}@example.com",
            ])->assertOk();
        }

        $this->postJson('/api/v1/app-link/request', [
            'email' => 'blocked@example.com',
        ])->assertStatus(429);
    }
}
