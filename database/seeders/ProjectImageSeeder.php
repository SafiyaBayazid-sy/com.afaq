<?php
namespace Database\Seeders;

use App\Models\ProjectImage;
use Illuminate\Database\Seeder;

class ProjectImageSeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            // صور للمشروع الأول - فلل النرجس
            [
                'project_id' => 1,
                'image_path' => 'projects/narjis-villa/main.jpg',
                'is_main' => true,
                'sort_order' => 1,
            ],
            [
                'project_id' => 1,
                'image_path' => 'projects/narjis-villa/exterior-1.jpg',
                'is_main' => false,
                'sort_order' => 2,
            ],
            [
                'project_id' => 1,
                'image_path' => 'projects/narjis-villa/interior-1.jpg',
                'is_main' => false,
                'sort_order' => 3,
            ],
            [
                'project_id' => 1,
                'image_path' => 'projects/narjis-villa/garden.jpg',
                'is_main' => false,
                'sort_order' => 4,
            ],
            
            // صور للمشروع الثاني - ترميم قصر السلام
            [
                'project_id' => 2,
                'image_path' => 'projects/salam-palace/before-1.jpg',
                'is_main' => false,
                'sort_order' => 1,
            ],
            [
                'project_id' => 2,
                'image_path' => 'projects/salam-palace/after-1.jpg',
                'is_main' => true,
                'sort_order' => 2,
            ],
            [
                'project_id' => 2,
                'image_path' => 'projects/salam-palace/details-1.jpg',
                'is_main' => false,
                'sort_order' => 3,
            ],
            
            // صور للمشروع الثالث - برج الأعمال
            [
                'project_id' => 3,
                'image_path' => 'projects/business-tower/design-1.jpg',
                'is_main' => true,
                'sort_order' => 1,
            ],
            [
                'project_id' => 3,
                'image_path' => 'projects/business-tower/construction-1.jpg',
                'is_main' => false,
                'sort_order' => 2,
            ],
            
            // صور للمشروع الرابع - شاطئ الخبر
            [
                'project_id' => 4,
                'image_path' => 'projects/khobar-beach/view-1.jpg',
                'is_main' => true,
                'sort_order' => 1,
            ],
            [
                'project_id' => 4,
                'image_path' => 'projects/khobar-beach/apartment-1.jpg',
                'is_main' => false,
                'sort_order' => 2,
            ],
        ];

        foreach ($images as $image) {
            ProjectImage::create($image);
        }
    }
}