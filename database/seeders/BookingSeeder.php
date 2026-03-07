<?php
namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $bookings = [
            [
                'customer_id' => 1, // محمد العلي
                'booking_date' => now()->addDays(3)->toDateString(),
                'booking_time' => '10:30:00',
                'status' => 'upcoming',
                'notes' => 'أرغب في مناقشة تفاصيل بناء الفيلا',
                'admin_notes' => 'تم تأكيد الموعد',
                'created_at' => now()->subDays(2),
            ],
            [
                'customer_id' => 2, // عبدالله الحربي
                'booking_date' => now()->addDays(5)->toDateString(),
                'booking_time' => '16:00:00',
                'status' => 'upcoming',
                'notes' => 'الاستفسار عن ترميم الشقة',
                'admin_notes' => null,
                'created_at' => now()->subDay(),
            ],
            [
                'customer_id' => 3, // فهد الدوسري
                'booking_date' => now()->subDays(2)->toDateString(),
                'booking_time' => '13:15:00',
                'status' => 'completed',
                'notes' => 'عرض دراسة الجدوى',
                'admin_notes' => 'تم الاجتماع وعرض الدراسة',
                'created_at' => now()->subDays(5),
            ],
            [
                'customer_id' => 4, // نورة القحطاني
                'booking_date' => now()->subDays(1)->toDateString(),
                'booking_time' => '11:45:00',
                'status' => 'cancelled',
                'notes' => 'الاستفسار عن البناء على الأرض',
                'admin_notes' => 'تم الإلغاء من قبل العميلة',
                'created_at' => now()->subDays(3),
            ],
            [
                'customer_id' => 1, // محمد العلي
                'booking_date' => now()->subDays(10)->toDateString(),
                'booking_time' => '09:00:00',
                'status' => 'completed',
                'notes' => 'استشارة أولية',
                'admin_notes' => 'تم الاجتماع والتعرف على متطلبات العميل',
                'created_at' => now()->subDays(12),
            ],
        ];

        foreach ($bookings as $booking) {
            Booking::create($booking);
        }
    }
}