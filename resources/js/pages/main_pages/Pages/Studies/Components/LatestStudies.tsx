import { Link } from '@inertiajs/react';
import StudyCard from './StudyCard';

export default function LatestStudies() {
    const studies = [
        {
            badge: "تقرير 2024",
            imageUrl: "https://lh3.googleusercontent.com/aida-public/AB6AXuAfhToUxjgGFBewSi1lLHeVMuzEEsdZwDg4paEGOOp_ri_6Ah5cdcCYssCrI8pgB0BcMln11wrfa2lELtW5YdTHKNWkzqDWg5J9rt4kiPEnAKoEdti2ZYzZO6du1BcG4IObgK_w8Koww0deL3OeGbGyOwLtLjrrai4O4WnfvUgmyDDJtlz7TikyAJYBTtqhdR2twEJ-FexNa2lc5eoxvEimyRxctaA6C7BsOF4YRcDTAVF4LqPM6EiEw_T4lNvnJUu8KRdwON0dbj-I",
            title: "تحليل سوق العقارات 2024",
            description: "دراسة تحليلية شاملة لمتغيرات السوق العقاري المحلي، تتناول العرض والطلب وتوقعات النمو للسنوات الخمس القادمة.",
            date: "15 يناير 2024"
        },
        {
            badge: "استدامة",
            imageUrl: "https://lh3.googleusercontent.com/aida-public/AB6AXuBwRFsw8ROTKO7h-XpIQmZLf2lwi8NYBwm56xiuaY01TUWYLl2G9VoST8CYpNgXm4ZuIpnimf5jIKYMGRUiWr_VsChR0KcQwPZwBRJPAt8og_V8ojLiTqL1xrNYo8cEu7iz3EN-gOX3GDIbqLlWUjKpkiKAM6_a4gG3hQuc22thYhcEe45jSltv_lQ1bD9dU-xaCa9VtZZDDRAg4qWS7avFDZ_gAQM2eDu_3LFUJOWpNVm6UklRaTZwicBYarUi-YJVRXObKfNt_im_",
            title: "جدوى المشاريع المستدامة",
            description: "تقييم الأثر الاقتصادي والبيئي للمباني الخضراء، وكيف تساهم التقنيات الحديثة في خفض التكاليف التشغيلية.",
            date: "02 فبراير 2024"
        },
        {
            badge: "اقتصاد",
            imageUrl: "https://lh3.googleusercontent.com/aida-public/AB6AXuDCHXa2jBbtfq0F_6XI-1dGENuIkRjypfjrAdHUMXpcY5gILcVOblq0j-Xk9KZB7qWWYw0lvzeY3yxeOrF9-mGc1aqgx4ZGSXTo1fclFnsdYJBqmQJPDmdTD5VAvt5L55WtfIuQf5ow3KYocjc9FP4Stx3v5hy1as5o4eIN15-SWH2KLZdLd9-zz1Yi6gNIjgYsHPhybv2ZaeKXcr_lXnUIPzm0xZQBWU5joVyhV2-wbitqA0riSfG1JK6piBb2Rr9n2VlxHUC7yLlH",
            title: "توجيهات الأسعار الحالية",
            description: "تقرير مفصل عن تقلبات تكاليف المواد والعمالة وتأثير التضخم العالمي على تكلفة إنشاء المشاريع السكنية والتجارية.",
            date: "28 فبراير 2024"
        }
    ];

    return (
        <section className="py-16 px-6 lg:px-20 max-w-7xl mx-auto">
            <div className="flex items-center justify-between mb-10">
                <div className="flex items-center gap-3">
                    <span className="material-symbols-outlined text-primary text-3xl">library_books</span>
                    <h2 className="text-2xl md:text-3xl font-bold">أحدث الدراسات</h2>
                </div>
                <Link href="#" className="text-primary font-bold flex items-center gap-1 hover:underline">
                    عرض الكل
                    <span className="material-symbols-outlined">arrow_left</span>
                </Link>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {studies.map((study, index) => (
                    <StudyCard key={index} {...study} />
                ))}
            </div>
        </section>
    );
}