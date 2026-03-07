<?php
namespace Database\Seeders;

use App\Models\VisitorTracking;
use Illuminate\Database\Seeder;

class VisitorTrackingSeeder extends Seeder
{
    public function run(): void
    {
        $visitors = [
            [
                'utm_source' => 'facebook',
                'utm_medium' => 'social',
                'utm_campaign' => 'riyadh_villas_2026',
                'visited_at' => now()->subDays(10)->setTime(14, 30),
            ],
            [
                'utm_source' => 'facebook',
                'utm_medium' => 'social',
                'utm_campaign' => 'riyadh_villas_2026',
                'visited_at' => now()->subDays(9)->setTime(10, 15),
            ],
            [
                'utm_source' => 'google_ad',
                'utm_medium' => 'cpc',
                'utm_campaign' => 'renovation_ads_q1',
                'visited_at' => now()->subDays(8)->setTime(16, 45),
            ],
            [
                'utm_source' => 'google_ad',
                'utm_medium' => 'cpc',
                'utm_campaign' => 'renovation_ads_q1',
                'visited_at' => now()->subDays(7)->setTime(9, 20),
            ],
            [
                'utm_source' => 'snapchat',
                'utm_medium' => 'social',
                'utm_campaign' => 'youth_snap_2026',
                'visited_at' => now()->subDays(6)->setTime(20, 10),
            ],
            [
                'utm_source' => 'tiktok',
                'utm_medium' => 'social',
                'utm_campaign' => 'property_tips',
                'visited_at' => now()->subDays(5)->setTime(19, 30),
            ],
            [
                'utm_source' => 'google_search',
                'utm_medium' => 'organic',
                'utm_campaign' => null,
                'visited_at' => now()->subDays(4)->setTime(11, 05),
            ],
            [
                'utm_source' => null,
                'utm_medium' => 'direct',
                'utm_campaign' => null,
                'visited_at' => now()->subDays(3)->setTime(13, 40),
            ],
            [
                'utm_source' => 'friend',
                'utm_medium' => 'referral',
                'utm_campaign' => null,
                'visited_at' => now()->subDays(2)->setTime(15, 25),
            ],
            [
                'utm_source' => 'google_ad',
                'utm_medium' => 'cpc',
                'utm_campaign' => 'construction_search',
                'visited_at' => now()->subDay()->setTime(17, 50),
            ],
        ];

        foreach ($visitors as $visitor) {
            VisitorTracking::create($visitor);
        }
    }
}