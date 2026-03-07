<?php
namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $notifications = [
            // إشعارات للمديرين
            [
                'user_id' => 1, // أحمد المدير
                'type' => 'new_inquiry',
                'title' => 'استفسار جديد',
                'message' => 'تم استلام استفسار جديد من محمد العلي',
                'is_read' => true,
                'created_at' => now()->subDays(5),
            ],
            [
                'user_id' => 1,
                'type' => 'new_booking',
                'title' => 'حجز موعد جديد',
                'message' => 'تم حجز موعد جديد من فهد الدوسري',
                'is_read' => true,
                'created_at' => now()->subDays(3),
            ],
            [
                'user_id' => 2, // سارة المشرفة
                'type' => 'new_inquiry',
                'title' => 'استفسار جديد',
                'message' => 'تم استلام استفسار جديد من عبدالله الحربي',
                'is_read' => false,
                'created_at' => now()->subHours(5),
            ],
            [
                'user_id' => 1,
                'type' => 'new_customer',
                'title' => 'مستثمر جديد',
                'message' => 'تم تسجيل مستثمر جديد: نورة القحطاني',
                'is_read' => false,
                'created_at' => now()->subDay(),
            ],
            
            // إشعارات للعملاء
            [
                'user_id' => 3, // محمد العلي
                'type' => 'booking_confirmation',
                'title' => 'تأكيد الحجز',
                'message' => 'تم تأكيد حجز موعدك يوم ' . now()->addDays(3)->format('Y-m-d'),
                'is_read' => false,
                'created_at' => now()->subDays(2),
            ],
            [
                'user_id' => 3,
                'type' => 'inquiry_response',
                'title' => 'رد على استفسارك',
                'message' => 'تم الرد على استفسارك بخصوص بناء الفيلا',
                'is_read' => true,
                'created_at' => now()->subDays(4),
            ],
            [
                'user_id' => 4, // عبدالله الحربي
                'type' => 'booking_reminder',
                'title' => 'تذكير بالموعد',
                'message' => 'موعدك غداً الساعة 4:00 مساءً',
                'is_read' => false,
                'created_at' => now()->subDay(),
            ],
        ];

        foreach ($notifications as $notification) {
            Notification::create($notification);
        }
    }
}