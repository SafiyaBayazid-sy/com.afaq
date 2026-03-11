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

         
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
