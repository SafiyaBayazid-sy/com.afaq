import { Head } from '@inertiajs/react';
import React from 'react';
import MainLayout from '../../components/Layouts/MainLayout';

export default function ProjectDetail() {
    // extract last segment as slug for title fallback
    const slug = typeof window !== 'undefined' ? window.location.pathname.split('/').filter(Boolean).pop() : '';
    const title = slug ? decodeURIComponent(slug).replace(/[-_]/g, ' ') : 'تفاصيل المشروع';

    return (
        <MainLayout>
            <Head title={title} />
            <div className="flex-grow" dir="rtl">
                {/* Hero */}
                <section className="relative h-[60vh] lg:h-[75vh] w-full overflow-hidden">
                    <div className="absolute inset-0 bg-cover bg-center" style={{backgroundImage: "url('https://lh3.googleusercontent.com/aida-public/AB6AXuD5jDuiJBlskbivgC-WcwwfZBNtsiNNUBkcUdouUabP9QkcfQJSNhDdO2Ub86iGZ0qW_VYeVqLToWAygzDdcX8tR3Z6jkIxesZ-kssKpZJl5P_mV3tZ__u8it4bXPLW-Knvwciy2LTMIDgKTjcIRSs6wTLphbJfgdF6KbzvkxJnmno3aaTfywyPxi-bxTtF2SaGiVXhP1MONcG972bxFu5iglBixPNWk4TcJYTcybX23JKDFMysb6fOAfIwXy-_LkO8dRykqUfFL4LN')"}}>
                        <div className="absolute inset-0 bg-gradient-to-t from-background-dark/80 via-transparent to-transparent"></div>
                    </div>
                    <div className="relative h-full max-w-7xl mx-auto px-6 lg:px-20 flex flex-col justify-end pb-12">
                        <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary text-white text-xs font-bold mb-4 w-fit">
                            <span className="material-symbols-outlined text-sm">verified</span>
                            مشروع متاح للبيع
                        </div>
                        <h2 className="text-4xl lg:text-6xl font-black text-white mb-4 leading-tight">مشروع {title}</h2>
                        <p className="text-slate-200 text-lg lg:text-xl max-w-2xl">تجربة سكنية فاخرة تجمع بين التصميم العصري والطبيعة الغناء في قلب العاصمة.</p>
                    </div>
                </section>

                {/* Gallery + details simplified version from reference */}
                <section className="max-w-7xl mx-auto px-6 lg:px-20 py-8">
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-4 aspect-[21/9]">
                        <div className="col-span-1 row-span-1 rounded-xl overflow-hidden bg-primary/5">
                            <img className="w-full h-full object-cover hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDFD23aLHZZgV1Ys4NNcXumNwb_4lrrMRyFatQhy_yhjbLCA51LpuzUOQtvrJ4P7t1JV5D4gI1lgbIbwKHOXFtWqoix_fLiqmzAUIJIgnRItugz7NmXTCSuE9ydBYW-TEKBbdUajcrVNZRspaLp4eAATcGBzAd2MJtgRbDl82MreB0SZFtpx0tzIYc5uLHYe9QLI0aClPd540Qem7vYtkZu4xXAST1qLhLs3O8D7wG4k9V1j2TCeJyk1vnYelLaWhcqL2IveJrJLgPI" alt="" />
                        </div>
                        <div className="col-span-1 row-span-1 rounded-xl overflow-hidden bg-primary/5">
                            <img className="w-full h-full object-cover hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAGCochuO5Kh0ydrVOHRRgU2NyFqgWWGehGIaDjQdPq0Bb16zttaBLCyf-A9z5uKhEC4MmfZQ0AXWHqYOCxrH43dy-zCFDpKWCWy_XlEkLDndaIBG1UlGOYbWvlLwhRUlTrsNveRf8MJCpNVPucxDp-QgxKCor3ibSnMf7v085Yywcmvs_gicfmAoYpPyxj_RH7Dr2CK5rLrgt9SInCJJbpks6J8RQijmuDg1JgUwTHB5FZTbT2z6jIlZOPJ6GKsYrT3eh1zz7nVeC7" alt="" />
                        </div>
                        <div className="col-span-2 row-span-2 rounded-xl overflow-hidden bg-primary/5">
                            <img className="w-full h-full object-cover hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC6Xi03g68G_Kd8pESsbT5W1S6sAmGk2QKdb3G15uN_lsiZdut93PBjwVa1Nkjq_Gpjqykp5pQe8GSuUQCzeRX1fgQxaYR6ce1IvYyfbiRQj8W7M_1VL8_8xhzrUSNz5jiO1g_ZkZP0yOV72B82LRm5Lws1Z1XvmYWxtwwtJmtP1ZFzVji143TLo6ylJf0UcIbi8Q74RSj-6cDYgf2TzFqRGwWka1nBovyLuI6LQOvSI5Q97vMOuobHaV5LGMJdFk2_2TwcJXHfdB2F" alt="" />
                        </div>
                        <div className="col-span-2 row-span-1 rounded-xl overflow-hidden bg-primary/5">
                            <img className="w-full h-full object-cover hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDr3Ed5iScPcPfRx85w0xdxgEp1o2waS91xLTIE6dT4D3a89KtCtoJafizYw5Dbvhf6tIMeN4tBieia1SjKqRP746j75oMbdofHndj-VegAVVSymeavrprmLElnZZTmOukHyAImmIjW8f0QTqVjqSVrdKtQounzmFpK1cfrBLbwC-7S5bqFxGJ3MjYkFf4NSqTsg8q_rkn0MXueKtOo2WvWeMGZusJEaSOjzTFEIqLzaM9fLg6SM4aMPC9tqipp76TjVjvJt3_1Og9Y" alt="" />
                        </div>
                    </div>
                </section>

                {/* Details & CTA simplified */}
                <section className="max-w-7xl mx-auto px-6 lg:px-20 py-12 grid grid-cols-1 lg:grid-cols-3 gap-12">
                    <div className="lg:col-span-2 space-y-12">
                        <div>
                            <h3 className="text-2xl font-bold mb-6 flex items-center gap-2">
                                <span className="w-8 h-1 bg-primary rounded-full"></span>
                                مواصفات المشروع
                            </h3>
                            <div className="grid grid-cols-2 sm:grid-cols-3 gap-6">
                                <div className="p-4 rounded-xl bg-primary/5 border border-primary/10 text-center">
                                    <span className="material-symbols-outlined text-primary text-3xl mb-2">square_foot</span>
                                    <p className="text-xs text-slate-500 dark:text-slate-400">المساحة الإجمالية</p>
                                    <p className="text-lg font-bold">450 م²</p>
                                </div>
                                <div className="p-4 rounded-xl bg-primary/5 border border-primary/10 text-center">
                                    <span className="material-symbols-outlined text-primary text-3xl mb-2">location_on</span>
                                    <p className="text-xs text-slate-500 dark:text-slate-400">الموقع</p>
                                    <p className="text-lg font-bold">الرياض، حي النرجس</p>
                                </div>
                                <div className="p-4 rounded-xl bg-primary/5 border border-primary/10 text-center">
                                    <span className="material-symbols-outlined text-primary text-3xl mb-2">bed</span>
                                    <p className="text-xs text-slate-500 dark:text-slate-400">عدد الغرف</p>
                                    <p className="text-lg font-bold">5 غرف نوم</p>
                                </div>
                                <div className="p-4 rounded-xl bg-primary/5 border border-primary/10 text-center">
                                    <span className="material-symbols-outlined text-primary text-3xl mb-2">bathtub</span>
                                    <p className="text-xs text-slate-500 dark:text-slate-400">دورات المياه</p>
                                    <p className="text-lg font-bold">6 دورات مياه</p>
                                </div>
                                <div className="p-4 rounded-xl bg-primary/5 border border-primary/10 text-center">
                                    <span className="material-symbols-outlined text-primary text-3xl mb-2">directions_car</span>
                                    <p className="text-xs text-slate-500 dark:text-slate-400">مواقف السيارات</p>
                                    <p className="text-lg font-bold">3 مواقف</p>
                                </div>
                                <div className="p-4 rounded-xl bg-primary/5 border border-primary/10 text-center">
                                    <span className="material-symbols-outlined text-primary text-3xl mb-2">event_available</span>
                                    <p className="text-xs text-slate-500 dark:text-slate-400">حالة التسليم</p>
                                    <p className="text-lg font-bold">جاهز للسكن</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 className="text-2xl font-bold mb-6 flex items-center gap-2">
                                <span className="w-8 h-1 bg-primary rounded-full"></span>
                                المرافق والخدمات
                            </h3>
                            <div className="flex flex-wrap gap-3">
                                {['مسبح خاص', 'نظام ذكي للمنزل', 'حديقة خلفية واسعة', 'تكييف مركزي', 'غرفة خادمة', 'مراقبة أمنية 24/7', 'نادي صحي'].map((item) => (
                                    <span key={item} className="rounded-full bg-slate-100 px-4 py-2 text-sm font-medium dark:bg-primary/20">
                                        {item}
                                    </span>
                                ))}
                            </div>
                        </div>

                        {/* Map */}
                        <div>
                            <h3 className="text-2xl font-bold mb-6 flex items-center gap-2">
                                <span className="w-8 h-1 bg-primary rounded-full"></span>
                                الموقع على الخريطة
                            </h3>
                            <div className="w-full h-80 rounded-2xl overflow-hidden bg-slate-200 dark:bg-slate-800 relative group">
                                <div
                                    className="absolute inset-0 grayscale opacity-70 group-hover:grayscale-0 transition-all"
                                    data-alt="Satellite map view of the city area"
                                    style={{
                                        backgroundImage:
                                            "url('https://lh3.googleusercontent.com/aida-public/AB6AXuBLv7d24J0rj1ZIcUB53scKSTWft3lU2wlYCjZF04HQHbfHy2L5Roq64R6rwqSNcdn3madzkGckGqDt6m1un88HdT_ynkyBU4xEpvhpyMY-0NFC_rET_G0TEzVJq1KswNkvG0shjfZk4HUxkpOXQiGyiCOYvxqcirpwAuf22tS-l5rFOHCKeJkpAxmZrMIMDrfPOPPpOnL-HnmUJLd2MpIUdRtf9VheqjSKAw4Z7YNBGRHnP4LKvmCV6q2mFi16jATm02MAyw63tVQ3')",
                                        backgroundSize: 'cover',
                                        backgroundPosition: 'center',
                                    }}
                                />
                                <div className="absolute inset-0 flex items-center justify-center">
                                    <div className="relative">
                                        <div className="absolute inset-0 animate-ping bg-primary rounded-full scale-150 opacity-20"></div>
                                        <div className="bg-primary text-white size-12 rounded-full flex items-center justify-center relative shadow-xl">
                                            <span className="material-symbols-outlined">location_on</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="lg:col-span-1">
                        <div className="sticky top-32 space-y-6">
                            <div className="p-6 rounded-2xl bg-white dark:bg-primary/10 border border-slate-200 dark:border-primary/20 shadow-xl shadow-primary/5">
                                <div className="mb-6">
                                    <p className="text-sm text-slate-500 dark:text-slate-400">يبدأ السعر من</p>
                                    <div className="flex items-baseline gap-2">
                                        <span className="text-3xl font-black text-primary">3,500,000</span>
                                        <span className="text-lg font-bold">ر.س</span>
                                    </div>
                                </div>
                                <form className="space-y-4">
                                    <div className="space-y-2">
                                        <label className="text-sm font-bold">الاسم الكامل</label>
                                        <input className="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-background-dark border-slate-200 dark:border-primary/30 focus:ring-2 focus:ring-primary/50 outline-none transition-all" placeholder="أدخل اسمك الكريم" type="text" />
                                    </div>
                                    <div className="space-y-2">
                                        <label className="text-sm font-bold">رقم الجوال</label>
                                        <input className="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-background-dark border-slate-200 dark:border-primary/30 focus:ring-2 focus:ring-primary/50 outline-none transition-all text-left" dir="ltr" placeholder="05xxxxxxxx" type="tel" />
                                    </div>
                                    <button className="w-full bg-primary text-white py-4 rounded-xl font-bold text-lg hover:shadow-lg hover:shadow-primary/30 transition-all flex items-center justify-center gap-2" type="button">
                                        <span className="material-symbols-outlined">chat_bubble</span>
                                        استفسر الآن
                                    </button>
                                    <button className="w-full border-2 border-primary bg-transparent py-4 rounded-xl font-bold text-lg text-primary transition-all hover:bg-primary hover:text-white flex items-center justify-center gap-2" type="button">
                                        <span className="material-symbols-outlined">calendar_month</span>
                                        حجز موعد زيارة
                                    </button>
                                </form>
                                <hr className="my-6 border-slate-200 dark:border-primary/20" />
                                <div className="flex items-center gap-4">
                                    <img className="size-12 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBhiay5_IVUMdTMBsTNm65Sr0C3DoZcH6TS5ed3MdoBzSwIEfua4Kp2iUumPB12fxaa7XoVMJlBk1yb9ZmBfzM-G4idGePIvHuKvaAif7Yq9fdl0l0cdiXmTeDL6whq0F90QXmTNOlwBOJPXEGxtaqAHPQN9qds95yged8mlChlXH6nOBVI0i-EIg7EFpfEMRc8b99bYENuaI5zKU6JTVX_2W6_q8cCJ_2wQxiWN6-A3K9LR9S1oUrhvtkqRjLAs_eWcdKE_itgPqtK" alt="consultant" />
                                    <div>
                                        <p className="text-sm font-bold">أحمد المنصور</p>
                                        <p className="text-xs text-slate-500">مستشار عقاري معتمد</p>
                                    </div>
                                    <div className="mr-auto flex gap-2">
                                        <div className="flex size-8 cursor-pointer items-center justify-center rounded-full bg-green-500/10 text-green-500">
                                            <span className="material-symbols-outlined text-lg">call</span>
                                        </div>
                                        <div className="flex size-8 cursor-pointer items-center justify-center rounded-full bg-blue-500/10 text-blue-500">
                                            <span className="material-symbols-outlined text-lg">mail</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div className="rounded-2xl border border-primary/10 bg-primary/5 p-6">
                                <h4 className="mb-3 flex items-center gap-2 font-bold">
                                    <span className="material-symbols-outlined text-primary">info</span>
                                    ملاحظة هامة
                                </h4>
                                <p className="text-sm leading-relaxed text-slate-600 dark:text-slate-400">
                                    الأسعار المذكورة هي أسعار استرشادية وقد تتغير بناءً على توفر الوحدات والمواصفات الإضافية المطلوبة. يرجى التواصل مع فريق المبيعات للحصول على عرض سعر دقيق.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </MainLayout>
    );
}
