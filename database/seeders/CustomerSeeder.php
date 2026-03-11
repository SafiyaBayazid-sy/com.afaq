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
                'source' => 'facebook',
                'phone' => '966500000001'

            ],
            [
                'user_id' => 4, // عبدالله الحربي
                'source' => 'google_ad',
                'phone' => '966500000002'
            ],
            [
                'user_id' => 5, // فهد الدوسري
                'source' => 'friend',
               'phone' => '966500000003'
            ],
            [
                'user_id' => 6, // نورة القحطاني
                'source' => 'snapchat',
                'phone' => '966500000004'
            ],
            [
                'user_id' => 7, // سعد الشمري (حساب غير نشط)
                'source' => 'tiktok',
                'phone' => '966500000005'
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
