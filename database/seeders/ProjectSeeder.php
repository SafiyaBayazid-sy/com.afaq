<?php
namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'name' => 'فلل النرجس الفاخرة',
                'description' => 'مشروع فلل مستقلة فاخرة في حي النرجس بالرياض، تتميز بتصميم عصري ومساحات واسعة',
                'country' => 'السعودية',
                'state' => 'الرياض',
                'city' => 'الرياض',
                'street' => 'حي النرجس',
                'price' => 2500000.00,
                'project_status' => 'completed',
                'project_type' => 'construction',
                'property_type' => 'villa',
                'map_location' => 'https://maps.google.com/?q=24.774265,46.738586',
                'video_url' => 'https://www.youtube.com/watch?v=example1',
                'is_active' => true,
            ],
            [
                'name' => 'ترميم قصر السلام',
                'description' => 'مشروع ترميم وتطوير قصر تاريخي في جدة مع الحفاظ على الطابع المعماري الأصيل',
                'country' => 'السعودية',
                'state' => 'مكة المكرمة',
                'city' => 'جدة',
                'street' => 'البلد',
                'price' => 1800000.00,
                'project_status' => 'completed',
                'project_type' => 'renovation',
                'property_type' => 'building',
                'map_location' => 'https://maps.google.com/?q=21.485811,39.192505',
                'video_url' => 'https://www.youtube.com/watch?v=example2',
                'is_active' => true,
            ],
            [
                'name' => 'برج الأعمال الشمالي',
                'description' => 'برج إداري تجاري في شمال الرياض مكون من 12 دور',
                'country' => 'السعودية',
                'state' => 'الرياض',
                'city' => 'الرياض',
                'street' => 'طريق الملك فهد',
                'price' => 15000000.00,
                'project_status' => 'in_progress',
                'project_type' => 'construction',
                'property_type' => 'building',
                'map_location' => 'https://maps.google.com/?q=24.794265,46.628586',
                'video_url' => 'https://www.youtube.com/watch?v=example3',
                'is_active' => true,
            ],
            [
                'name' => 'شاطئ الخبر السكني',
                'description' => 'مشروع سكني متكامل على واجهة الخبر البحرية',
                'country' => 'السعودية',
                'state' => 'الشرقية',
                'city' => 'الخبر',
                'street' => 'الكورنيش',
                'price' => 3500000.00,
                'project_status' => 'on_hold',
                'project_type' => 'construction',
                'property_type' => 'apartment',
                'map_location' => 'https://maps.google.com/?q=26.290427,50.208412',
                'video_url' => 'https://www.youtube.com/watch?v=example4',
                'is_active' => true,
            ],
            [
                'name' => 'تطوير طريق العليا',
                'description' => 'تطوير وترميم واجهة مبنى تجاري في طريق العليا بالرياض',
                'country' => 'السعودية',
                'state' => 'الرياض',
                'city' => 'الرياض',
                'street' => 'طريق العليا',
                'price' => 750000.00,
                'project_status' => 'completed',
                'project_type' => 'renovation',
                'property_type' => 'building',
                'map_location' => 'https://maps.google.com/?q=24.724265,46.658586',
                'video_url' => 'https://www.youtube.com/watch?v=example5',
                'is_active' => true,
            ],
            [
                'name' => 'مجمع فلل الياسمين',
                'description' => 'مجموعة من الفلل المتلاصقة في حي الياسمين بالرياض',
                'country' => 'السعودية',
                'state' => 'الرياض',
                'city' => 'الرياض',
                'street' => 'حي الياسمين',
                'price' => 4200000.00,
                'project_status' => 'completed',
                'project_type' => 'construction',
                'property_type' => 'villa',
                'map_location' => 'https://maps.google.com/?q=24.814265,46.668586',
                'video_url' => 'https://www.youtube.com/watch?v=example6',
                'is_active' => false, // مشروع غير نشط
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}