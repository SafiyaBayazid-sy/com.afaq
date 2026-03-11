<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General Settings
            [
                'key' => 'site_name',
                'label' => 'اسم الموقع',
                'value' => 'آفاق العقارية',
                'type' => 'text',
                'group' => 'general',
                'description' => 'اسم موقع الويب الخاص بك',
                'is_public' => true,
            ],
            [
                'key' => 'site_description',
                'label' => 'وصف الموقع',
                'value' => 'شريكك الموثوق في العقار',
                'type' => 'text',
                'group' => 'general',
                'description' => 'وصف مختصر لموقعك',
                'is_public' => true,
            ],
            [
                'key' => 'site_logo',
                'label' => 'شعار الموقع',
                'value' => null,
                'type' => 'image',
                'group' => 'general',
                'description' => 'رفع شعار الموقع',
                'is_public' => true,
            ],

            // Contact Information
            [
                'key' => 'contact_phone',
                'label' => 'رقم الهاتف',
                'value' => '+966 50 123 4567',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'رقم الهاتف الرئيسي للاتصال',
                'is_public' => true,
            ],
            [
                'key' => 'contact_email',
                'label' => 'البريد الإلكتروني',
                'value' => 'info@afaq.com',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'البريد الإلكتروني الرئيسي',
                'is_public' => true,
            ],
            [
                'key' => 'contact_address',
                'label' => 'العنوان',
                'value' => 'الرياض، المملكة العربية السعودية',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'عنوان المكتب',
                'is_public' => true,
            ],

            // Business Information
            [
                'key' => 'business_hours',
                'label' => 'ساعات العمل',
                'value' => 'السبت - الخميس: ٩:٠٠ صباحاً - ٦:٠٠ مساءً',
                'type' => 'text',
                'group' => 'business',
                'description' => 'ساعات العمل',
                'is_public' => true,
            ],
            [
                'key' => 'total_properties',
                'label' => 'إجمالي العقارات',
                'value' => '150',
                'type' => 'number',
                'group' => 'business',
                'description' => 'إجمالي عدد العقارات المتاحة',
                'is_public' => true,
            ],
            [
                'key' => 'years_experience',
                'label' => 'سنوات الخبرة',
                'value' => '10',
                'type' => 'number',
                'group' => 'business',
                'description' => 'سنوات الخبرة في المجال العقاري',
                'is_public' => true,
            ],

            // Social Media
            [
                'key' => 'facebook_url',
                'label' => 'رابط فيسبوك',
                'value' => 'https://facebook.com/afaq',
                'type' => 'text',
                'group' => 'social',
                'description' => 'رابط صفحة فيسبوك',
                'is_public' => true,
            ],
            [
                'key' => 'twitter_url',
                'label' => 'رابط تويتر',
                'value' => 'https://twitter.com/afaq',
                'type' => 'text',
                'group' => 'social',
                'description' => 'رابط حساب تويتر',
                'is_public' => true,
            ],
            [
                'key' => 'instagram_url',
                'label' => 'رابط انستغرام',
                'value' => 'https://instagram.com/afaq',
                'type' => 'text',
                'group' => 'social',
                'description' => 'رابط حساب انستغرام',
                'is_public' => true,
            ],

            // SEO Settings
            [
                'key' => 'meta_keywords',
                'label' => 'الكلمات المفتاحية',
                'value' => 'عقار, عقارات, الرياض, السعودية, فلل, شقق, أراضي',
                'type' => 'text',
                'group' => 'seo',
                'description' => 'الكلمات المفتاحية لمحركات البحث',
                'is_public' => true,
            ],
            [
                'key' => 'meta_description',
                'label' => 'وصف ميتا',
                'value' => 'آفاق العقارية - شريكك الموثوق للعثور على العقار المثالي في المملكة العربية السعودية',
                'type' => 'text',
                'group' => 'seo',
                'description' => 'وصف ميتا لمحركات البحث',
                'is_public' => true,
            ],

            // Dashboard Widget HTML (New)
            [
                'key' => 'dashboard_widget_html',
                'label' => 'كود ويدجت لوحة التحكم',
                'value' => '<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">معلومات الموقع وإحصائيات الأعمال</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- معلومات الموقع -->
        <div class="space-y-4">
            <h4 class="text-md font-medium text-gray-700 border-b pb-2">معلومات الموقع</h4>

            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-sm font-medium text-gray-600">اسم الموقع:</span>
                    <span class="text-sm text-gray-900">{{ $siteInfo[\'name\'] }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-sm font-medium text-gray-600">الوصف:</span>
                    <span class="text-sm text-gray-900">{{ $siteInfo[\'description\'] }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-sm font-medium text-gray-600">الهاتف:</span>
                    <span class="text-sm text-gray-900">{{ $siteInfo[\'phone\'] }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-sm font-medium text-gray-600">البريد الإلكتروني:</span>
                    <span class="text-sm text-gray-900">{{ $siteInfo[\'email\'] }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-sm font-medium text-gray-600">العنوان:</span>
                    <span class="text-sm text-gray-900">{{ $siteInfo[\'address\'] }}</span>
                </div>
            </div>
        </div>

        <!-- إحصائيات الأعمال -->
        <div class="space-y-4">
            <h4 class="text-md font-medium text-gray-700 border-b pb-2">إحصائيات الأعمال</h4>

            <div class="space-y-3">
                <div class="flex justify-between items-center bg-blue-50 p-3 rounded">
                    <span class="text-sm font-medium text-blue-900">إجمالي العقارات:</span>
                    <span class="text-lg font-bold text-blue-600">{{ $businessStats[\'total_properties\'] }}</span>
                </div>

                <div class="flex justify-between items-center bg-green-50 p-3 rounded">
                    <span class="text-sm font-medium text-green-900">سنوات الخبرة:</span>
                    <span class="text-lg font-bold text-green-600">{{ $businessStats[\'years_experience\'] }}+</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-sm font-medium text-gray-600">ساعات العمل:</span>
                    <span class="text-sm text-gray-900">{{ $businessStats[\'business_hours\'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 pt-4 border-t">
        <p class="text-xs text-gray-500 text-center">
            💡 يمكنك تحديث هذه المعلومات من قسم الإعدادات
        </p>
    </div>
</div>',
                'type' => 'html',
                'group' => 'appearance',
                'description' => 'كود HTML مخصص لودجت لوحة التحكم',
                'is_public' => true,
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
