<?php

use App\Models\VisitorTracking;

test('public visits store marketing attribution cookies and tracking rows', function () {
    $response = $this->get('/?utm_source=google&utm_medium=cpc&utm_campaign=spring-launch&utm_term=villa&utm_content=hero');

    $response->assertOk();
    $response->assertCookie('marketing_visitor_id');
    $response->assertCookie('marketing_attribution');

    $this->assertDatabaseHas('visitor_tracking', [
        'landing_path' => '/',
        'utm_source' => 'google',
        'utm_medium' => 'cpc',
        'utm_campaign' => 'spring-launch',
        'utm_term' => 'villa',
        'utm_content' => 'hero',
    ]);
});

test('later public visits reuse saved attribution when utm params are absent', function () {
    $this->withUnencryptedCookies([
        'marketing_visitor_id' => 'visitor-123',
        'marketing_attribution' => json_encode([
            'utm_source' => 'facebook',
            'utm_medium' => 'social',
            'utm_campaign' => 'riyadh-villas',
            'landing_path' => '/projects',
            'attributed_at' => now()->toIso8601String(),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
    ])->get('/about')->assertOk();

    $this->assertDatabaseHas('visitor_tracking', [
        'landing_path' => '/about',
        'utm_source' => 'facebook',
        'utm_medium' => 'social',
        'utm_campaign' => 'riyadh-villas',
    ]);
});

test('non public routes are not tracked as marketing visits', function () {
    $this->get('/dashboard')->assertRedirect(route('login'));

    expect(VisitorTracking::query()->count())->toBe(0);
});

test('duplicate page refreshes within the deduplication window are ignored', function () {
    $attribution = [
        'utm_source' => 'tiktok',
        'utm_medium' => 'social',
        'utm_campaign' => 'consulting-promo',
        'landing_path' => '/legal-consultations',
        'attributed_at' => now()->toIso8601String(),
    ];

    $fingerprint = sha1(json_encode([
        'path' => '/legal-consultations',
        'utm_source' => 'tiktok',
        'utm_medium' => 'social',
        'utm_campaign' => 'consulting-promo',
        'utm_term' => null,
        'utm_content' => null,
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

    $this->withUnencryptedCookies([
        'marketing_visitor_id' => 'visitor-456',
        'marketing_attribution' => json_encode($attribution, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
        'marketing_last_visit' => json_encode([
            'fingerprint' => $fingerprint,
            'tracked_at' => now()->subMinute()->toIso8601String(),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
    ])->get('/legal-consultations')->assertOk();

    expect(VisitorTracking::query()->count())->toBe(0);
});
