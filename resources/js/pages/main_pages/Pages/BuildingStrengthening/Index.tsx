import { Head } from '@inertiajs/react';
import React from 'react';
import MainLayout from '../../components/Layouts/MainLayout';

export default function BuildingStrengthening() {
    return (
        <MainLayout>
            <Head title="خدمات الهندسة الإنشائية" />
            <div>
                <section className="relative min-h-[60vh] flex items-center justify-center overflow-hidden" dir="rtl">
                    <div className="absolute inset-0 bg-primary/90 z-10" />
                    <div
                        className="absolute inset-0 z-0 opacity-30"
                        style={{
                            backgroundImage:
                                'linear-gradient(rgba(255,255,255,0.08) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.08) 1px, transparent 1px)',
                            backgroundSize: '42px 42px',
                        }}
                    />
                    <div className="absolute inset-0 z-0 bg-cover bg-center" style={{backgroundImage: `url('https://lh3.googleusercontent.com/aida-public/AB6AXuA96Y6KivullwrJ_oTpwgpMlv9JuaVBlKFKVt0B8RJdwZTJ6KF45gBOrzzDBPnlrlV1ooU7p5ZUcEpfZC-2lMWXG3LxkJV1PJ_pEXYtldMU1yXpypx110aPQC4xsANyIOWVoywxbWrSmvhGdvr67GP43i7Ykolg7NJKZ8zWX6ANp2DxKUPBF6yPautmgUtIlEKIfiXh8_E7znkVc1ZlIzQQZNDV33YG5bxKeylJRVEnIUm1R0yvYmy_drDcvxoo8Xdrjbu16Yc60p1e')`}} />

                    <div className="relative z-20 container mx-auto px-4 text-center">
                        <span className="inline-block px-4 py-1.5 mb-6 rounded-full bg-emerald-500/20 text-emerald-400 text-sm font-bold border border-emerald-500/30">
                            خدمات الهندسة الإنشائية
                        </span>
                        <h1 className="text-4xl md:text-6xl lg:text-7xl font-black text-white mb-6 leading-tight">
                            تدعيم المباني <br/><span className="text-emerald-400">والهياكل الخرسانية</span>
                        </h1>
                        <p className="max-w-2xl mx-auto text-slate-300 text-lg md:text-xl mb-10 leading-relaxed">
                            نقدم حلولاً هندسية متطورة لتقوية الأساسات والأعمدة والجسور باستخدام أحدث تقنيات ألياف الكربون والقمصان الخرسانية.
                        </p>
                        <div className="flex flex-col sm:flex-row gap-4 justify-center">
                            <button className="bg-emerald-500 hover:bg-emerald-600 text-primary font-bold px-8 py-4 rounded-xl transition-all flex items-center justify-center gap-2">
                                <span className="material-symbols-outlined">description</span>
                                استشارة فنية مجانية
                            </button>
                            <button className="bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white border border-white/30 font-bold px-8 py-4 rounded-xl transition-all">
                                تصفح المشاريع السابقة
                            </button>
                        </div>
                    </div>
                </section>

                <section className="bg-background-light py-24 dark:bg-background-dark" dir="rtl">
                    <div className="mx-auto max-w-7xl px-4">
                        <div className="mb-16 text-center">
                            <h2 className="mb-4 text-3xl font-bold text-primary dark:text-white md:text-4xl">آلية العمل والتدعيم</h2>
                            <div className="mx-auto h-1.5 w-24 rounded-full bg-primary"></div>
                            <p className="mx-auto mt-6 max-w-xl text-slate-600 dark:text-slate-400">نتبع منهجية علمية دقيقة تبدأ بالتشخيص وتنتهي بضمان استدامة المبنى</p>
                        </div>
                        <div className="grid grid-cols-1 gap-12 md:grid-cols-3">
                            <div className="text-center">
                                <div className="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-500/20 text-emerald-400">
                                    <span className="material-symbols-outlined text-4xl">search_check</span>
                                </div>
                                <h3 className="mb-3 text-xl font-bold text-white">التقييم الشامل</h3>
                                <p className="leading-relaxed text-slate-400">فحص إنشائي مخبري للخرسانة وحديد التسليح وتحديد الأسباب الجذرية للهبوط أو التصدعات.</p>
                                <div className="mt-6 flex items-center justify-center text-sm font-bold text-emerald-400">
                                    <span className="material-symbols-outlined ml-1">arrow_back</span>
                                    المرحلة الأولى
                                </div>
                            </div>
                            <div className="text-center">
                                <div className="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-500/20 text-emerald-400">
                                    <span className="material-symbols-outlined text-4xl">architecture</span>
                                </div>
                                <h3 className="mb-3 text-xl font-bold text-white">التصميم الهندسي</h3>
                                <p className="leading-relaxed text-slate-400">إعداد مخططات تفصيلية وحسابات إنشائية دقيقة لاختيار نوع التدعيم الأمثل.</p>
                                <div className="mt-6 flex items-center justify-center text-sm font-bold text-emerald-400">
                                    <span className="material-symbols-outlined ml-1">arrow_back</span>
                                    المرحلة الثانية
                                </div>
                            </div>
                            <div className="text-center">
                                <div className="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-500/20 text-emerald-400">
                                    <span className="material-symbols-outlined text-4xl">construction</span>
                                </div>
                                <h3 className="mb-3 text-xl font-bold text-white">التنفيذ والتركيب</h3>
                                <p className="leading-relaxed text-slate-400">تطبيق الحلول المعتمدة من قبل طواقم فنية متخصصة وتحت إشراف هندسي صارم لضمان الجودة.</p>
                                <div className="mt-6 flex items-center justify-center text-sm font-bold text-emerald-400">
                                    <span className="material-symbols-outlined ml-1">verified</span>
                                    المرحلة النهائية
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section className="bg-primary/5 py-24 dark:bg-black/20" dir="rtl">
                    <div className="mx-auto max-w-7xl px-4">
                        <div className="mb-12 flex flex-col items-end justify-between gap-6 md:flex-row">
                            <div>
                                <h2 className="text-3xl font-bold text-white">سجل الإنجازات</h2>
                                <p className="mt-2 text-slate-400">لنكتشف كيف أسهمت مشاريع التدعيم في إنقاذ مبانٍ حيوية.</p>
                            </div>
                            <div className="flex gap-3">
                                <button className="rounded-lg bg-primary px-5 py-2 text-sm font-bold text-white">الكل</button>
                                <button className="rounded-lg border border-primary/20 bg-primary/20 px-5 py-2 text-sm font-bold">سكني</button>
                                <button className="rounded-lg border border-primary/20 bg-primary/20 px-5 py-2 text-sm font-bold">تجاري</button>
                            </div>
                        </div>

                        <div className="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">
                            <article className="overflow-hidden rounded-xl border border-primary/20 bg-background-dark/40">
                                <div className="relative h-64 overflow-hidden">
                                    <img className="h-full w-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD_M7aQMfLE2KuPlh03fnj_9YVW5nW7vbf2RNCsNy1M3aDAUgyJ7sa0l_m3O1wF_7_BdE4dEUIBmJHS_Ki_Q5EnRx1vxUd-bcdOcQJ5IbGJtsNqKmceEzsxXJ9FQJQcNK2CN57-vSMhkxzVMNnvfMKYPVoh2KyKMDGhloWOmrQF7i3NyhKho26SQEcV7xxRD0h8kEsvsKFAgTayrsIlpKX70UGOGtfJDaEWMBr_i8uaE4eAz8KFwi6oRANIsq4KNP4ieADmKDNzqRw4" alt="before-1" />
                                    <span className="absolute right-3 top-3 rounded bg-red-600 px-2 py-1 text-xs font-bold text-white">قبل التدعيم</span>
                                </div>
                                <div className="p-4">
                                    <h4 className="font-bold text-white">تدعيم أعمدة تجاري - الرياض</h4>
                                    <p className="mt-1 text-xs text-slate-400">استخدام القمصان الحديدية لرفع القدرة التحميلية.</p>
                                </div>
                            </article>
                            <article className="overflow-hidden rounded-xl border border-primary/20 bg-background-dark/40">
                                <div className="relative h-64 overflow-hidden">
                                    <img className="h-full w-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDJyd15H5JNDer9m0sJtk4uq2jJGp9eYLgGw5EPJ898FhkQKdTDreZtIdeXJSE8UCl30l6JMUFv1JmbjbW1lsT0BoBkA9Q_Jrv1ZUkycUtQB9I4cd50fNj_2HWWpiwBpImM5uoUKpJ64KK6mjqWWnKzF46zYdnkEZlTEf99BrPGHDuHsfqDBadsmChqCMqSzYKXlcaZm2WLk3PnfhoM1mCUcw01Lnz4ONzN1CyFjJWxeK3Fx0ITliNj9tVieAm7qaadTtm6U_-hFmQQ" alt="after-1" />
                                    <span className="absolute right-3 top-3 rounded bg-emerald-600 px-2 py-1 text-xs font-bold text-white">بعد التدعيم</span>
                                </div>
                                <div className="p-4">
                                    <h4 className="font-bold text-white">نتيجة بعد التدعيم - الرياض</h4>
                                    <p className="mt-1 text-xs text-slate-400">رفع كفاءة الهيكل وضمان السلامة التشغيلية.</p>
                                </div>
                            </article>
                            <article className="overflow-hidden rounded-xl border border-primary/20 bg-background-dark/40">
                                <div className="relative h-64 overflow-hidden">
                                    <img className="h-full w-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDnrQ8QJLXNseIHZyYUKJWjBK7BCVOivb3C-Ut8mqvavmC9E8R-NzL-iVSSCTRRQhdq64Xofl8LIuMOwTPplMgYch14_-F-WgeAWTKPP7g-U1-i-BIs_6XY0BkYmi_jdvh25ZWG1kANWVOmYGcsx7alULdMkD10d3rXCTgnO2wp1hN7GlfkisS-Ca3aPgdVCMfKAWTsGB_TBKdCNvwvEqm3RQdUL45nymk4ic6f5qtSsEwM-K6c5S0FF0DH5XmnvyT-dEwFJjilWcMg" alt="before-2" />
                                    <span className="absolute right-3 top-3 rounded bg-red-600 px-2 py-1 text-xs font-bold text-white">قبل التدعيم</span>
                                </div>
                                <div className="p-4">
                                    <h4 className="font-bold text-white">هبوط أساسات فيلا - جدة</h4>
                                    <p className="mt-1 text-xs text-slate-400">رصد هبوط في الأساسات وشروخ ممتدة.</p>
                                </div>
                            </article>
                            <article className="overflow-hidden rounded-xl border border-primary/20 bg-background-dark/40">
                                <div className="relative h-64 overflow-hidden">
                                    <img className="h-full w-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA7w1Tr_3o1tiKG0jZH-qtjGWSutH627EiTanp1Qcyj8WI-9EwP1ePzzutALBc8Rkx6g6WbM-d6ZOtGtEcwACvVe4ZZdwt5ICH0fZ0MruD1eKKmRgTtkMnkTgFSS12AVQNO33qGW83Qi9RSfSKqRRrA0KYfUTnPdj98DSJ1-78NdrBYXEbWgtcMpTpLlf4ERHNWEdDly66JjWWy5vGwsbInX9Dcm41P8Gxk-Tt-jriqvpoI3oW0KsgmS8OzQw2HbArM3y8fvhruWMdn" alt="after-2" />
                                    <span className="absolute right-3 top-3 rounded bg-emerald-600 px-2 py-1 text-xs font-bold text-white">بعد التدعيم</span>
                                </div>
                                <div className="p-4">
                                    <h4 className="font-bold text-white">معالجة الهبوط - جدة</h4>
                                    <p className="mt-1 text-xs text-slate-400">حقن التربة وتدعيم القواعد بالمايكروبايل.</p>
                                </div>
                            </article>
                        </div>
                    </div>
                </section>

                <section className="py-20 relative overflow-hidden">
                    <div className="absolute inset-0 bg-primary z-0"></div>
                    <div className="relative z-10 max-w-5xl mx-auto px-4 text-center">
                        <h2 className="text-3xl md:text-5xl font-bold text-white mb-8">هل يحتاج مبناك إلى فحص إنشائي؟</h2>
                        <p className="text-slate-300 text-lg mb-12 max-w-2xl mx-auto">لا تتردد في طلب الاستشارة إذا لاحظت أي تصدعات أو شروخ في هيكل المبنى. فريقنا جاهز للتقييم الفوري.</p>
                        <div className="flex flex-wrap justify-center gap-6">
                            <a className="flex items-center gap-3 bg-white text-primary px-8 py-4 rounded-xl font-bold text-lg hover:bg-emerald-50 transition-colors" href="tel:+966500000000">
                                <span className="material-symbols-outlined">call</span>
                                اتصل بنا الآن
                            </a>
                            <a className="flex items-center gap-3 bg-emerald-500 text-primary px-8 py-4 rounded-xl font-bold text-lg hover:bg-emerald-400 transition-colors" href="#">
                                <span className="material-symbols-outlined">mail</span>
                                طلب عرض سعر
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </MainLayout>
    );
}
