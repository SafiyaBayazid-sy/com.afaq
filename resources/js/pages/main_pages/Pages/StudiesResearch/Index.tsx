import { Head } from '@inertiajs/react';
import MainLayout from '../../components/Layouts/MainLayout';

const reports = [
    {
        title: 'تحليل سوق العقارات',
        summary: 'دراسة تحليلية توضح واقع السوق العقاري واتجاهاته، مع نظرة مستقبلية تساعد المستثمرين على تحديد أفضل الفرص العقارية.',
    },
    {
        title: 'جدوى المشاريع المستدامة',
        summary: 'تحليل شامل يوضح أهمية البناء المستدام والتصاميم الحديثة وكيف تساهم في تقليل التكاليف وتحسين كفاءة المباني.',
    },
    {
        title: 'توجيهات الأسعار الحالية',
        summary: 'تقرير يوضح تقدير تكاليف البناء والمواد والعمالة لمساعدة أصحاب المشاريع على التخطيط المالي بشكل أدق.',
    },
];

const downloadablePapers = [
    'معايير التصميم الحضري المعاصر',
    'مستقبل التطوير العقاري الذكي',
    'تقرير الابتكار والتكنولوجيا في البناء',
    'دليل كفاءة الطاقة في المباني',
];

export default function StudiesResearch() {
    return (
        <MainLayout>
            <Head title="مركز الدراسات العقارية" />

            <div className="flex-grow" dir="rtl">
                <section className="relative flex h-[450px] w-full items-center justify-center overflow-hidden">
                    <div className="absolute inset-0 z-10 bg-gradient-to-b from-primary/80 to-background-dark/95" />
                    <div className="absolute inset-0 z-0 bg-cover bg-center" style={{ backgroundImage: "url('https://images.unsplash.com/photo-1541888946425-d81bb19480c5?auto=format&fit=crop&q=80')" }} />
                    <div className="relative z-20 max-w-3xl px-4 text-right text-white">
                        <h1 className="mb-6 text-4xl font-black leading-tight md:text-6xl">مركز الدراسات العقارية</h1>
                        <p className="mb-8 text-lg leading-relaxed text-slate-200 md:text-xl">
                            نقدم دراسات وتحليلات متخصصة في قطاع العقارات والبناء تساعد المستثمرين وأصحاب العقارات على اتخاذ قرارات مدروسة قبل البدء بأي
                            مشروع.
                        </p>
                        <div className="flex flex-wrap gap-4">
                            <a className="rounded-lg bg-white px-8 py-3 font-bold text-primary transition-all hover:bg-slate-100" href="#reports">
                                استكشف التقارير
                            </a>
                            <a className="rounded-lg border border-white/20 bg-primary/40 px-8 py-3 font-bold text-white backdrop-blur-md transition-all hover:bg-primary/60" href="#contact">
                                اشترك في النشرة
                            </a>
                        </div>
                    </div>
                </section>

                <section className="mx-auto max-w-7xl px-6 py-16 lg:px-20" id="reports">
                    <div className="mb-10 text-right">
                        <h2 className="text-2xl font-bold md:text-3xl">أحدث الدراسات والتحليلات</h2>
                        <p className="mt-3 max-w-3xl text-slate-500">
                            نشارككم مجموعة من الدراسات التي يقدمها فريقنا المختص لمساعدتكم على فهم سوق العقارات والبناء بشكل أفضل.
                        </p>
                    </div>

                    <div className="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                        {reports.map((report) => (
                            <article
                                key={report.title}
                                className="overflow-hidden rounded-xl border border-primary/10 bg-white p-6 shadow-sm transition-all hover:border-primary/30 hover:shadow-xl dark:bg-primary/5"
                            >
                                <h3 className="mb-3 text-xl font-bold">{report.title}</h3>
                                <p className="text-sm leading-relaxed text-slate-600 dark:text-slate-300">{report.summary}</p>
                            </article>
                        ))}
                    </div>
                </section>

                <section className="border-y border-primary/10 bg-primary/5 px-6 py-16 lg:px-20">
                    <div className="mx-auto max-w-7xl">
                        <div className="mb-10 text-right">
                            <h2 className="text-2xl font-bold md:text-3xl">أدلة وتقارير متخصصة</h2>
                            <p className="mt-3 text-slate-500">
                                نوفر مجموعة من التقارير والأدلة المتخصصة التي تساعد المستثمرين وأصحاب العقارات على فهم أفضل لمجال التطوير العقاري والبناء
                                الحديث.
                            </p>
                        </div>
                        <div className="grid grid-cols-1 gap-6 lg:grid-cols-2">
                            {downloadablePapers.map((paper) => (
                                <div
                                    key={paper}
                                    className="flex items-center justify-between rounded-xl border border-primary/10 bg-white p-6 transition-shadow hover:shadow-md dark:bg-background-dark"
                                >
                                    <div className="flex items-center gap-4">
                                        <div className="flex size-12 items-center justify-center rounded-lg bg-red-100 text-red-600 dark:bg-red-900/20">
                                            <span className="material-symbols-outlined text-3xl">picture_as_pdf</span>
                                        </div>
                                        <h4 className="text-lg font-bold">{paper}</h4>
                                    </div>
                                    <a className="rounded-lg bg-primary p-2 text-white transition-opacity hover:opacity-90" href="#contact">
                                        <span className="material-symbols-outlined">download</span>
                                    </a>
                                </div>
                            ))}
                        </div>
                    </div>
                </section>
            </div>
        </MainLayout>
    );
}
