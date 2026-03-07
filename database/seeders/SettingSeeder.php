<?php
namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // معلومات الشركة
            [
                'key' => 'company_name',
                'value' => 'آفاق العمران للتطوير العقاري',
                'type' => 'text',
                'group' => 'company_info',
                'label' => 'اسم الشركة',
                'description' => 'الاسم الرسمي للشركة',
                'is_public' => true,
            ],
            [
                'key' => 'company_logo',
                'value' => 'settings/logo.png',
                'type' => 'image',
                'group' => 'company_info',
                'label' => 'شعار الشركة',
                'description' => 'شعار الشركة للعرض في الموقع والتطبيق',
                'is_public' => true,
            ],
            [
                'key' => 'company_email',
                'value' => 'info@afaq-omran.com',
                'type' => 'text',
                'group' => 'company_info',
                'label' => 'البريد الإلكتروني',
                'description' => 'البريد الإلكتروني الرسمي للتواصل',
                'is_public' => true,
            ],
            [
                'key' => 'company_phone',
                'value' => '966920000000',
                'type' => 'text',
                'group' => 'company_info',
                'label' => 'رقم الهاتف',
                'description' => 'رقم الهاتف الموحد',
                'is_public' => true,
            ],
            
            // روابط التواصل الاجتماعي
            [
                'key' => 'facebook_url',
                'value' => 'https://facebook.com/afaqomran',
                'type' => 'text',
                'group' => 'social_media',
                'label' => 'رابط فيسبوك',
                'description' => 'صفحة الشركة على فيسبوك',
                'is_public' => true,
            ],
            [
                'key' => 'twitter_url',
                'value' => 'https://twitter.com/afaqomran',
                'type' => 'text',
                'group' => 'social_media',
                'label' => 'رابط تويتر',
                'description' => 'حساب الشركة على تويتر',
                'is_public' => true,
            ],
            [
                'key' => 'instagram_url',
                'value' => 'https://instagram.com/afaqomran',
                'type' => 'text',
                'group' => 'social_media',
                'label' => 'رابط انستغرام',
                'description' => 'حساب الشركة على انستغرام',
                'is_public' => true,
            ],
            [
                'key' => 'snapchat_url',
                'value' => 'https://snapchat.com/add/afaqomran',
                'type' => 'text',
                'group' => 'social_media',
                'label' => 'رابط سناب شات',
                'description' => 'حساب الشركة على سناب شات',
                'is_public' => true,
            ],
            
            // إعدادات عامة
            [
                'key' => 'app_store_link',
                'value' => 'https://apps.apple.com/app/afaq-omran',
                'type' => 'text',
                'group' => 'app_links',
                'label' => 'رابط آب ستور',
                'description' => 'رابط التطبيق على آب ستور',
                'is_public' => true,
            ],
            [
                'key' => 'google_play_link',
                'value' => 'https://play.google.com/store/apps/details?id=com.afaq.omran',
                'type' => 'text',
                'group' => 'app_links',
                'label' => 'رابط جوجل بلاي',
                'description' => 'رابط التطبيق على جوجل بلاي',
                'is_public' => true,
            ],
            [
                'key' => 'enable_notifications',
                'value' => 'true',
                'type' => 'boolean',
                'group' => 'system',
                'label' => 'تفعيل الإشعارات',
                'description' => 'تشغيل أو إيقاف الإشعارات في النظام',
                'is_public' => false,
            ],
            [
                'key' => 'default_booking_duration',
                'value' => '60',
                'type' => 'number',
                'group' => 'booking',
                'label' => 'مدة الحجز الافتراضية',
                'description' => 'مدة الموعد بالدقائق',
                'is_public' => false,
            ],
            [
                'key' => 'about_us',
                'value' => 'شركة آفاق العمران للتطوير العقاري هي شركة رائدة في مجال التطوير العقاري والبناء والترميم، تأسست لتقديم حلول عقارية متكاملة تلبي تطلعات عملائنا.',
                'type' => 'text',
                'group' => 'content',
                'label' => 'من نحن',
                'description' => 'نص صفحة من نحن',
                'is_public' => true,
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}