<?php
namespace Database\Seeders;

use App\Models\Inquiry;
use Illuminate\Database\Seeder;

class InquirySeeder extends Seeder
{
    public function run(): void
    {
        $inquiries = [
            [
                'customer_id' => 1, // محمد العلي
                'category_id' => 1, // بناء جديد
                'message' => 'أرغب في الاستفسار عن إمكانية بناء فيلا بمساحة 500 متر في شمال الرياض. كم التكلفة التقريبية والمدة الزمنية؟',
                'status' => 'completed',
                'admin_notes' => 'تم التواصل مع العميل وإرسال العرض السعري',
                'created_at' => now()->subDays(5),
            ],
            [
                'customer_id' => 1, // محمد العلي
                'category_id' => 3, // استشارات هندسية
                'message' => 'هل يمكنكم توفير استشارة حول أفضل تصميم للفيلا مع مراعاة الخصوصية؟',
                'status' => 'contacted',
                'admin_notes' => 'تم تحويل الاستشارة للمهندس المختص',
                'created_at' => now()->subDays(2),
            ],
            [
                'customer_id' => 2, // عبدالله الحربي
                'category_id' => 2, // ترميم وتطوير
                'message' => 'لدي شقة قديمة في جدة وأرغب في ترميمها بالكامل. هل لديكم خبرة في هذا المجال؟',
                'status' => 'new',
                'admin_notes' => null,
                'created_at' => now()->subHours(5),
            ],

            [
                'customer_id' => 4, // نورة القحطاني
                'category_id' => 1, // بناء جديد
                'message' => 'هل يمكنكم بناء فيلا صغيرة على أرض مساحتها 300 متر في ضواحي الرياض؟',
                'status' => 'new',
                'admin_notes' => null,
                'created_at' => now()->subDay(),
            ],
        ];

        foreach ($inquiries as $inquiry) {
            Inquiry::create($inquiry);
        }
    }
}
