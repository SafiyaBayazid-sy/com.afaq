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
                'phone' => '966500000001',
                'password' => Hash::make('password'),
                'user_type' => 'admin',
                'is_active' => true,
            ],
            [
                'name' => 'سارة المشرفة',
                'email' => 'sarah@afaq.com',
                'phone' => '966500000002',
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
                'phone' => '966501234567',
                'password' => Hash::make('password'),
                'user_type' => 'customer',
                'is_active' => true,
            ],
            [
                'name' => 'عبدالله الحربي',
                'email' => 'abdullah@hotmail.com',
                'phone' => '966502345678',
                'password' => Hash::make('password'),
                'user_type' => 'customer',
                'is_active' => true,
            ],
            [
                'name' => 'فهد الدوسري',
                'email' => 'fahad@gmail.com',
                'phone' => '966503456789',
                'password' => Hash::make('password'),
                'user_type' => 'customer',
                'is_active' => true,
            ],
            [
                'name' => 'نورة القحطاني',
                'email' => 'noura@gmail.com',
                'phone' => '966504567890',
                'password' => Hash::make('password'),
                'user_type' => 'customer',
                'is_active' => true,
            ],
            [
                'name' => 'سعد الشمري',
                'email' => 'saad@yahoo.com',
                'phone' => '966505678901',
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
