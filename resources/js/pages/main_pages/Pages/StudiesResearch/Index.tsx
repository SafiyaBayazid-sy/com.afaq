import { Head } from '@inertiajs/react';
import React from 'react';
import MainLayout from '../../components/Layouts/MainLayout';

export default function StudiesResearch() {
    const reports = [
        {
            title: 'تحليل سوق العقارات 2024',
            summary: 'دراسة تحليلية شاملة لمتغيرات السوق العقاري المحلي، تتناول العرض والطلب وتوقعات النمو للسنوات الخمس القادمة.',
            date: '15 يناير 2024',
            tag: 'تقرير 2024',
            image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuAfhToUxjgGFBewSi1lLHeVMuzEEsdZwDg4paEGOOp_ri_6Ah5cdcCYssCrI8pgB0BcMln11wrfa2lELtW5YdTHKNWkzqDWg5J9rt4kiPEnAKoEdti2ZYzZO6du1BcG4IObgK_w8Koww0deL3OeGbGyOwLtLjrrai4O4WnfvUgmyDDJtlz7TikyAJYBTtqhdR2twEJ-FexNa2lc5eoxvEimyRxctaA6C7BsOF4YRcDTAVF4LqPM6EiEw_T4lNvnJUu8KRdwON0dbj-I',
        },
        {
            title: 'جدوى المشاريع المستدامة',
            summary: 'تقييم الأثر الاقتصادي والبيئي للمباني الخضراء، وكيف تساهم التقنيات الحديثة في خفض التكاليف التشغيلية.',
            date: '02 فبراير 2024',
            tag: 'استدامة',
            image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBwRFsw8ROTKO7h-XpIQmZLf2lwi8NYBwm56xiuaY01TUWYLl2G9VoST8CYpNgXm4ZuIpnimf5jIKYMGRUiWr_VsChR0KcQwPZwBRJPAt8og_V8ojLiTqL1xrNYo8cEu7iz3EN-gOX3GDIbqLlWUjKpkiKAM6_a4gG3hQuc22thYhcEe45jSltv_lQ1bD9dU-xaCa9VtZZDDRAg4qWS7avFDZ_gAQM2eDu_3LFUJOWpNVm6UklRaTZwicBYarUi-YJVRXObKfNt_im_',
        },
        {
            title: 'توجيهات الأسعار الحالية',
            summary: 'تقرير مفصل عن تقلبات تكاليف المواد والعمالة وتأثير التضخم العالمي على تكلفة إنشاء المشاريع السكنية والتجارية.',
            date: '28 فبراير 2024',
            tag: 'اقتصاد',
            image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDCHXa2jBbtfq0F_6XI-1dGENuIkRjypfjrAdHUMXpcY5gILcVOblq0j-Xk9KZB7qWWYw0lvzeY3yxeOrF9-mGc1aqgx4ZGSXTo1fclFnsdYJBqmQJPDmdTD5VAvt5L55WtfIuQf5ow3KYocjc9FP4Stx3v5hy1as5o4eIN15-SWH2KLZdLd9-zz1Yi6gNIjgYsHPhybv2ZaeKXcr_lXnUIPzm0xZQBWU5joVyhV2-wbitqA0riSfG1JK6piBb2Rr9n2VlxHUC7yLlH',
        },
    ];

    const downloadablePapers = [
        { title: 'تقرير الابتكار والتكنولوجيا 2024', meta: 'PDF • 4.2 MB • نُشر في مارس 2024' },
        { title: 'معايير التصميم الحضري المعاصر', meta: 'PDF • 8.7 MB • نُشر في فبراير 2024' },
        { title: 'دليل كفاءة الطاقة في المباني', meta: 'PDF • 5.1 MB • نُشر في يناير 2024' },
        { title: 'مستقبل التطوير العقاري الذكي', meta: 'PDF • 12.4 MB • نُشر في ديسمبر 2023' },
    ];

    return (
        <MainLayout>
            <Head title="الدراسات والبحوث" />

            <div className="flex-grow">
                <section className="relative flex h-[450px] w-full items-center justify-center overflow-hidden" dir="rtl">
                    <div className="absolute inset-0 z-10 bg-gradient-to-b from-primary/80 to-background-dark/95" />
                    <div
                        className="absolute inset-0 z-0 bg-cover bg-center"
                        style={{
                            backgroundImage:
                                "url('https://images.unsplash.com/photo-1541888946425-d81bb19480c5?auto=format&fit=crop&q=80')",
                        }}
                    />
                    <div className="relative z-20 max-w-3xl px-4 text-center">
                        <h1 className="mb-6 text-4xl font-black leading-tight text-white md:text-6xl">مركز الدراسات والبحوث</h1>
                        <p className="mb-8 text-lg font-light text-slate-200 md:text-xl">
                            منصة معرفية متكاملة تقدم تحليلات معمقة وتقارير دورية حول اتجاهات سوق العقارات والإنشاءات في المنطقة
                        </p>
                        <div className="flex flex-wrap justify-center gap-4">
                            <button className="flex items-center gap-2 rounded-lg bg-white px-8 py-3 font-bold text-primary transition-all hover:bg-slate-100">
                                <span className="material-symbols-outlined">auto_graph</span>
                                استكشف التقارير
                            </button>
                            <button className="rounded-lg border border-white/20 bg-primary/40 px-8 py-3 font-bold text-white backdrop-blur-md transition-all hover:bg-primary/60">
                                الاشتراك في النشرة
                            </button>
                        </div>
                    </div>
                </section>

                <section className="mx-auto max-w-7xl px-6 py-16 lg:px-20" dir="rtl">
                    <div className="mb-10 flex items-center justify-between">
                        <div className="flex items-center gap-3">
                            <span className="material-symbols-outlined text-3xl text-primary">library_books</span>
                            <h2 className="text-2xl font-bold md:text-3xl">أحدث الدراسات</h2>
                        </div>
                        <a className="flex items-center gap-1 font-bold text-primary hover:underline" href="#">
                            عرض الكل
                            <span className="material-symbols-outlined">arrow_left</span>
                        </a>
                    </div>

                    <div className="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                        {reports.map((report) => (
                            <div
                                key={report.title}
                                className="group overflow-hidden rounded-xl border border-primary/10 bg-white shadow-sm transition-all hover:border-primary/30 hover:shadow-xl dark:bg-primary/5"
                            >
                                <div className="relative h-56 w-full overflow-hidden">
                                    <div className="absolute right-4 top-4 z-10 rounded-full bg-primary px-3 py-1 text-xs font-bold text-white">{report.tag}</div>
                                    <img className="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" src={report.image} alt={report.title} />
                                </div>
                                <div className="p-6">
                                    <h3 className="mb-3 text-xl font-bold transition-colors group-hover:text-primary">{report.title}</h3>
                                    <p className="mb-6 text-sm leading-relaxed text-slate-600 dark:text-slate-400">{report.summary}</p>
                                    <div className="flex items-center justify-between">
                                        <span className="flex items-center gap-1 text-xs text-slate-400">
                                            <span className="material-symbols-outlined text-sm">calendar_today</span>
                                            {report.date}
                                        </span>
                                        <button className="flex items-center gap-1 text-sm font-bold text-primary">
                                            قراءة المزيد
                                            <span className="material-symbols-outlined text-sm">arrow_back</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </section>

                <section className="border-y border-primary/10 bg-primary/5 px-6 py-16 lg:px-20" dir="rtl">
                    <div className="mx-auto max-w-7xl">
                        <div className="mb-10 flex items-center gap-3">
                            <span className="material-symbols-outlined text-3xl text-primary">download</span>
                            <h2 className="text-2xl font-bold md:text-3xl">أوراق بحثية قابلة للتحميل</h2>
                        </div>
                        <div className="grid grid-cols-1 gap-6 lg:grid-cols-2">
                            {downloadablePapers.map((paper) => (
                                <div
                                    key={paper.title}
                                    className="flex items-center justify-between rounded-xl border border-primary/10 bg-white p-6 transition-shadow hover:shadow-md dark:bg-background-dark"
                                >
                                    <div className="flex items-center gap-4">
                                        <div className="flex size-12 items-center justify-center rounded-lg bg-red-100 text-red-600 dark:bg-red-900/20">
                                            <span className="material-symbols-outlined text-3xl">picture_as_pdf</span>
                                        </div>
                                        <div>
                                            <h4 className="text-lg font-bold">{paper.title}</h4>
                                            <p className="text-sm text-slate-500">{paper.meta}</p>
                                        </div>
                                    </div>
                                    <button className="rounded-lg bg-primary p-2 text-white transition-opacity hover:opacity-90">
                                        <span className="material-symbols-outlined">download</span>
                                    </button>
                                </div>
                            ))}
                        </div>
                    </div>
                </section>
                            </div>
        </MainLayout>
    );
}
