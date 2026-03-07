<?php
namespace Database\Seeders;

use App\Models\MarketingCampaign;
use Illuminate\Database\Seeder;

class MarketingCampaignSeeder extends Seeder
{
    public function run(): void
    {
        $campaigns = [
            [
                'name' => 'حملة فلل الرياض',
                'platform' => 'فيسبوك',
                'utm_source' => 'facebook',
                'utm_medium' => 'social',
                'utm_campaign' => 'riyadh_villas_2026',
                'start_date' => '2026-02-01',
                'end_date' => '2026-02-28',
                'budget' => 15000.00,
                'notes' => 'حملة تستهدف الباحثين عن فلل في الرياض',
            ],
            [
                'name' => 'إعلانات جوجل - ترميم',
                'platform' => 'جوجل أدز',
                'utm_source' => 'google_ad',
                'utm_medium' => 'cpc',
                'utm_campaign' => 'renovation_ads_q1',
                'start_date' => '2026-01-15',
                'end_date' => '2026-03-15',
                'budget' => 25000.00,
                'notes' => 'حملة إعلانات بحث تستهدف كلمات مفتاحية للترميم',
            ],
            [
                'name' => 'حملة سناب شات للشباب',
                'platform' => 'سناب شات',
                'utm_source' => 'snapchat',
                'utm_medium' => 'social',
                'utm_campaign' => 'youth_snap_2026',
                'start_date' => '2026-02-15',
                'end_date' => '2026-03-15',
                'budget' => 10000.00,
                'notes' => 'حملة تستهدف الفئة العمرية 25-35 سنة',
            ],
            [
                'name' => 'تيك توك عقار',
                'platform' => 'تيك توك',
                'utm_source' => 'tiktok',
                'utm_medium' => 'social',
                'utm_campaign' => 'property_tips',
                'start_date' => '2026-02-20',
                'end_date' => '2026-03-20',
                'budget' => 8000.00,
                'notes' => 'محتوى توعوي عن الاستثمار العقاري',
            ],
            [
                'name' => 'حملة جوجل البحثية',
                'platform' => 'جوجل أدز',
                'utm_source' => 'google_search',
                'utm_medium' => 'cpc',
                'utm_campaign' => 'construction_search',
                'start_date' => '2026-01-01',
                'end_date' => '2026-03-31',
                'budget' => 30000.00,
                'notes' => 'حملة موسعة للبحث عن كلمات البناء والتشييد',
            ],
        ];

        foreach ($campaigns as $campaign) {
            MarketingCampaign::create($campaign);
        }
    }
}