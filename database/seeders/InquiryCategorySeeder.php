<?php
namespace Database\Seeders;

use App\Models\InquiryCategory;
use Illuminate\Database\Seeder;

class InquiryCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'بناء جديد',
                'description' => 'استفسارات عن بناء مشاريع جديدة من الألف إلى الياء',
                'is_active' => true,
            ],
            [
                'name' => 'ترميم وتطوير',
                'description' => 'استفسارات عن ترميم وتجديد العقارات القائمة',
                'is_active' => true,
            ],
            [
                'name' => 'استشارات هندسية',
                'description' => 'استشارات حول التصميم والهندسة المعمارية',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            InquiryCategory::create($category);
        }
    }
}