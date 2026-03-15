<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


     // إنشاء مديرين
        $admins = [
            [
                'name' => 'أحمد المدير',
                'email' => 'admin@afaq.com',
                'password' => Hash::make('password'),
                'user_type' => 'admin',
                'is_active' => true,
            ],
            [
                'name' => 'سارة المشرفة',
                'email' => 'sarah@afaq.com',
                'password' => Hash::make('password'),
                'user_type' => 'admin',
                'is_active' => true,
            ],
        ];

        foreach ($admins as $admin) {
            User::create($admin);
        }

        // إنشاء مستثمرين (عملاء)
        $customers = [
            [
                'name' => 'محمد العلي',
                'email' => 'mohammed@gmail.com',
                'password' => Hash::make('password'),
                'user_type' => 'customer',
                'is_active' => true,
            ],
            [
                'name' => 'عبدالله الحربي',
                'email' => 'abdullah@hotmail.com',
                'password' => Hash::make('password'),
                'user_type' => 'customer',
                'is_active' => true,
            ],
            [
                'name' => 'فهد الدوسري',
                'email' => 'fahad@gmail.com',
                'password' => Hash::make('password'),
                'user_type' => 'customer',
                'is_active' => true,
            ],
            [
                'name' => 'نورة القحطاني',
                'email' => 'noura@gmail.com',
                'password' => Hash::make('password'),
                'user_type' => 'customer',
                'is_active' => true,
            ],
            [
                'name' => 'سعد الشمري',
                'email' => 'saad@yahoo.com',
                'password' => Hash::make('password'),
                'user_type' => 'customer',
                'is_active' => false, // حساب غير نشط
            ],
        ];

        foreach ($customers as $customer) {
            User::create($customer);
        }
    }
}
