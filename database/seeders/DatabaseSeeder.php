<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $this->call([
            UserSeeder::class,
            CustomerSeeder::class,
            InquiryCategorySeeder::class,
            ProjectSeeder::class,
            ProjectImageSeeder::class,
            InquirySeeder::class,
            BookingSeeder::class,
            MarketingCampaignSeeder::class,
            VisitorTrackingSeeder::class,
            NotificationSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
