import { Head } from '@inertiajs/react';
import React from 'react';
import MainLayout from '../../components/Layouts/MainLayout';

export default function StudiesResearch() {
    return (
        <MainLayout>
            <Head title="الدراسات والبحوث" />

            <main className="flex-grow">
                <section className="relative w-full px-4 py-14 lg:px-20" dir="rtl">
                    <div className="absolute inset-0 bg-primary/90 z-10" />
                    <div
                        className="absolute inset-0 bg-cover bg-center z-0 opacity-30"
                        style={{
                            backgroundImage:
                                "url('https://lh3.googleusercontent.com/aida-public/AB6AXuBTyHOZGX0YcV0XSgGDLqV1vXHjAVt-e3jG6Fi8FTzgaLbK4stFM5dU3VTb2L6fExlcSxwEI6M1x0jLqp3N1YJ6lGLP0MSPiKqC9cWsfA_2F6g2f9plwykMKcC9g4qYdzF4I4wboXbMgdM0LpSngoO2SBoE7TFUWCbRLOMdsmQVKvdFEWJ-wkqkRgVqg5uI3s9jPj8nNw_lO7NqGxIp3R_jf5E6g8d4YsEw5p7uJbN0YQw-sIcgxH4a2k3xV9uWlIWHcGiYi5Ud3H9K9rh5lIGh7Y?size=2048')",
                        }}
                    />
                    <div className="relative z-20 flex flex-col items-center justify-center text-center">
                        <span className="inline-block px-4 py-1.5 mb-6 rounded-full bg-emerald-500/20 text-emerald-400 text-sm font-bold border border-emerald-500/30">
                            الدراسات المتخصصة
                        </span>
                        <h1 className="text-4xl md:text-6xl lg:text-7xl font-black text-white leading-tight mb-6">
                            أبحاث هندسية دقيقة لمعالجة التحديات العمرانية
                        </h1>
                        <p className="max-w-3xl text-slate-200 text-lg md:text-xl mb-10 leading-relaxed">
                            نقدم تقارير فنية مستندة إلى بيانات حقيقية وتحليلات متعمقة لدعم اتخاذ القرار في المشاريع الإنشائية والعمرانية.
                        </p>
                        <div className="flex flex-col sm:flex-row gap-4 justify-center">
                            <a
                                href="#services"
                                className="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-8 py-4 font-bold text-white shadow-lg hover:shadow-primary/30 transition-all"
                            >
                                شاهد خدماتنا
                            </a>
                            <a
                                href="#contact"
                                className="inline-flex items-center justify-center gap-2 rounded-xl bg-white/15 text-white border border-white/30 px-8 py-4 font-bold hover:bg-white/25 transition-all"
                            >
                                تواصل معنا
                            </a>
                        </div>
                    </div>
                </section>

                <section className="container mx-auto px-6 py-16 lg:px-20" dir="rtl" id="services">
                    <div className="mb-12 text-center">
                        <h2 className="text-3xl md:text-4xl font-bold text-primary">خدمات البحث والدراسات</h2>
                        <div className="mt-4 h-1 w-24 bg-primary mx-auto rounded-full" />
                        <p className="mt-6 text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                            نغطي كافة احتياجات المنشآت من دراسات فنية وتنموية، بدءًا من تقييم السلامة الإنشائية وحتى دراسات الجدوى الاقتصادية.
                        </p>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div className="group rounded-2xl bg-white dark:bg-primary/10 border border-primary/10 hover:border-primary/30 transition-all p-8">
                            <div className="flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10 text-primary mb-5 group-hover:bg-primary/20">
                                <span className="material-symbols-outlined text-3xl">insights</span>
                            </div>
                            <h3 className="text-xl font-bold mb-3">دراسة السلامة الإنشائية</h3>
                            <p className="text-slate-600 dark:text-slate-400 leading-relaxed">
                                تقييم شامل للمباني للتحقق من القدرة التحميلية وتحليل المخاطر الناتجة عن العوامل البيئية والتصميمية.
                            </p>
                        </div>
                        <div className="group rounded-2xl bg-white dark:bg-primary/10 border border-primary/10 hover:border-primary/30 transition-all p-8">
                            <div className="flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10 text-primary mb-5 group-hover:bg-primary/20">
                                <span className="material-symbols-outlined text-3xl">analytics</span>
                            </div>
                            <h3 className="text-xl font-bold mb-3">دراسة جدوى اقتصادية</h3>
                            <p className="text-slate-600 dark:text-slate-400 leading-relaxed">
                                تحليل تكاليف وفوائد المشاريع الإنشائية مع توصيات ذكية لتقليل التكلفة وزيادة العائد الاستثماري.
                            </p>
                        </div>
                        <div className="group rounded-2xl bg-white dark:bg-primary/10 border border-primary/10 hover:border-primary/30 transition-all p-8">
                            <div className="flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10 text-primary mb-5 group-hover:bg-primary/20">
                                <span className="material-symbols-outlined text-3xl">engineering</span>
                            </div>
                            <h3 className="text-xl font-bold mb-3">دراسة المواد والهياكل</h3>
                            <p className="text-slate-600 dark:text-slate-400 leading-relaxed">
                                اختبار المواد وتحليل أداء الهياكل لضمان اختيار الحلول الأمثل من حيث المتانة والاستدامة.
                            </p>
                        </div>
                        <div className="group rounded-2xl bg-white dark:bg-primary/10 border border-primary/10 hover:border-primary/30 transition-all p-8">
                            <div className="flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10 text-primary mb-5 group-hover:bg-primary/20">
                                <span className="material-symbols-outlined text-3xl">timeline</span>
                            </div>
                            <h3 className="text-xl font-bold mb-3">تحليل السوق والعرض</h3>
                            <p className="text-slate-600 dark:text-slate-400 leading-relaxed">
                                دراسات عن احتياجات السوق ومعدلات الطلب، لمساعدة مطوري العقارات على تحديد المواقع المناسبة والمواصفات المطلوبة.
                            </p>
                        </div>
                        <div className="group rounded-2xl bg-white dark:bg-primary/10 border border-primary/10 hover:border-primary/30 transition-all p-8">
                            <div className="flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10 text-primary mb-5 group-hover:bg-primary/20">
                                <span className="material-symbols-outlined text-3xl">support_agent</span>
                            </div>
                            <h3 className="text-xl font-bold mb-3">تقديم الاستشارات الفنية</h3>
                            <p className="text-slate-600 dark:text-slate-400 leading-relaxed">
                                ندعم فرق العمل بتوصيات فنية واستشارات ميدانية لضمان توافق التنفيذ مع المعايير الهندسية.
                            </p>
                        </div>
                        <div className="group rounded-2xl bg-white dark:bg-primary/10 border border-primary/10 hover:border-primary/30 transition-all p-8">
                            <div className="flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10 text-primary mb-5 group-hover:bg-primary/20">
                                <span className="material-symbols-outlined text-3xl">task_alt</span>
                            </div>
                            <h3 className="text-xl font-bold mb-3">تدقيق المواصفات والمعايير</h3>
                            <p className="text-slate-600 dark:text-slate-400 leading-relaxed">
                                مراجع فنية للتأكد من مطابقة المشاريع للمعايير الدولية والمحلية، مع تقارير قابلة للتنفيذ.
                            </p>
                        </div>
                    </div>
                </section>

                <section className="bg-primary/5 py-24" dir="rtl">
                    <div className="max-w-6xl mx-auto px-6 lg:px-20">
                        <div className="grid gap-10 lg:grid-cols-2 lg:items-center">
                            <div>
                                <h2 className="text-3xl md:text-4xl font-bold text-primary">نتائج متميزة مدعومة بالبيانات</h2>
                                <p className="mt-6 text-slate-600 dark:text-slate-400">
                                    نعتمد على منهجيات قياس دقيقة وتقارير مفصلة تساعدك على اتخاذ قرارات واضحة وسريعة خلال مراحل التصميم والتنفيذ.
                                </p>
                                <ul className="mt-8 grid gap-4">
                                    <li className="flex items-start gap-3">
                                        <span className="material-symbols-outlined text-primary">check_circle</span>
                                        <span className="text-slate-600 dark:text-slate-400">تقارير تحليلية قابلة للمراجعة والتحديث.</span>
                                    </li>
                                    <li className="flex items-start gap-3">
                                        <span className="material-symbols-outlined text-primary">check_circle</span>
                                        <span className="text-slate-600 dark:text-slate-400">استشارات فنية متواصلة حتى إغلاق المشروع.</span>
                                    </li>
                                    <li className="flex items-start gap-3">
                                        <span className="material-symbols-outlined text-primary">check_circle</span>
                                        <span className="text-slate-600 dark:text-slate-400">فريق متعدد التخصصات لضمان دقة النتائج.</span>
                                    </li>
                                </ul>
                            </div>
                            <div className="rounded-2xl bg-white dark:bg-primary/10 border border-primary/10 p-10 shadow-xl">
                                <h3 className="text-2xl font-bold mb-4">احجز استشارة بحثية</h3>
                                <p className="text-slate-600 dark:text-slate-400 mb-8">
                                    املأ النموذج وسيتواصل معك أحد خبرائنا لتحديد نطاق الدراسة والجدول الزمني.
                                </p>
                                <form className="space-y-5">
                                    <div className="grid gap-4 sm:grid-cols-2">
                                        <label className="flex flex-col gap-2 text-sm font-semibold">
                                            الاسم الكامل
                                            <input className="rounded-xl border border-border-muted bg-background-dark/50 px-4 py-3 text-slate-900 dark:text-white focus:border-primary focus:ring-primary" placeholder="الاسم" type="text" />
                                        </label>
                                        <label className="flex flex-col gap-2 text-sm font-semibold">
                                            البريد الإلكتروني
                                            <input className="rounded-xl border border-border-muted bg-background-dark/50 px-4 py-3 text-slate-900 dark:text-white focus:border-primary focus:ring-primary" placeholder="example@mail.com" type="email" />
                                        </label>
                                    </div>
                                    <label className="flex flex-col gap-2 text-sm font-semibold">
                                        الجوال
                                        <input className="rounded-xl border border-border-muted bg-background-dark/50 px-4 py-3 text-slate-900 dark:text-white focus:border-primary focus:ring-primary" placeholder="05xxxxxxxx" type="tel" />
                                    </label>
                                    <label className="flex flex-col gap-2 text-sm font-semibold">
                                        نوع الدراسة
                                        <select className="rounded-xl border border-border-muted bg-background-dark/50 px-4 py-3 text-slate-900 dark:text-white focus:border-primary focus:ring-primary">
                                            <option>سلامة إنشائية</option>
                                            <option>جدوى اقتصادية</option>
                                            <option>دراسة مواد</option>
                                            <option>تدقيق مواصفات</option>
                                        </select>
                                    </label>
                                    <label className="flex flex-col gap-2 text-sm font-semibold">
                                        رسالة إضافية
                                        <textarea className="h-28 resize-none rounded-xl border border-border-muted bg-background-dark/50 px-4 py-3 text-slate-900 dark:text-white focus:border-primary focus:ring-primary" placeholder="أخبرنا عن احتياجك" />
                                    </label>
                                    <button className="w-full rounded-xl bg-primary py-4 text-white font-bold shadow-lg hover:bg-primary/90 transition-all" type="submit">
                                        إرسال الطلب
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>

                <section className="bg-slate-50 dark:bg-slate-950 py-24" dir="rtl">
                    <div className="max-w-7xl mx-auto px-6 lg:px-20">
                        <div className="text-center mb-12">
                            <h2 className="text-3xl font-bold text-primary">شركاؤنا في النجاح</h2>
                            <p className="mt-4 text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                                نعمل مع شركات رائدة لتقديم حلول متكاملة تعتمد على أحدث المعايير الهندسية.
                            </p>
                        </div>
                        <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-6 items-center">
                            {Array.from({ length: 6 }).map((_, idx) => (
                                <div
                                    key={idx}
                                    className="flex items-center justify-center rounded-2xl bg-white dark:bg-primary/10 border border-primary/10 p-6 shadow-sm"
                                >
                                    <div className="h-16 w-16 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center">
                                        <span className="text-2xl font-bold text-slate-500">{idx + 1}</span>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </section>
            </main>
        </MainLayout>
    );
}
