<?php
namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            [
                'user_id' => 3, // محمد العلي
                'budget' => 1500000.00,
                'source' => 'facebook',
                'preferred_property_type' => 'villa',
                'notes' => 'يبحث عن فيلا مستقلة في شمال الرياض',
                'phone' => '966500000001'

            ],
            [
                'user_id' => 4, // عبدالله الحربي
                'budget' => 850000.00,
                'source' => 'google_ad',
                'preferred_property_type' => 'apartment',
                'notes' => 'مهتم بشقق فاخرة في جدة',
                'phone' => '966500000002'
            ],
            [
                'user_id' => 5, // فهد الدوسري
                'budget' => 2000000.00,
                'source' => 'friend',
                'preferred_property_type' => 'building',
                'notes' => 'يبحث عن عمارة استثمارية في الدمام',
                'phone' => '966500000003'
            ],
            [
                'user_id' => 6, // نورة القحطاني
                'budget' => 500000.00,
                'source' => 'snapchat',
                'preferred_property_type' => 'land',
                'notes' => 'أرض للاستثمار في ضواحي الرياض',
                'phone' => '966500000004'
            ],
            [
                'user_id' => 7, // سعد الشمري (حساب غير نشط)
                'budget' => 1200000.00,
                'source' => 'tiktok',
                'preferred_property_type' => 'floor',
                'notes' => 'يبحث عن دور كامل في الخبر',
                'phone' => '966500000005'
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
