import { Head } from '@inertiajs/react';
import React from 'react';
import MainLayout from '../../components/Layouts/MainLayout';

export default function LegalConsultations() {
    return (
        <MainLayout>
            <Head title="الاستشارات القانونية" />

            <main className="flex-grow">
                <section className="relative w-full px-4 py-8 lg:px-20" dir="rtl">
                    <div className="relative overflow-hidden rounded-xl bg-slate-800">
                        <div className="absolute inset-0 z-0">
                            <div
                                className="h-full w-full bg-cover bg-center opacity-40"
                                data-alt="Law and real estate legal background with scales and buildings"
                                style={{
                                    backgroundImage: "linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.8)), url('https://lh3.googleusercontent.com/aida-public/AB6AXuAhQHqCItzOklEcna-m7QBKTvk0VhiebM-JHmA-6m1efreB7i75rC-AWHz45pcTOsQmEtSGPMUkIncaImBMEaywx8aE_H9P9X3yh3q6ogawCMGGDPCRPMekgNigNKhTp4HomY31dSgX-q1F-7I2aryARkj0uVkOTXXOrVFl3zlfS12pyBQJihWyQgf412_yxsZIvg2fU87bUP0z_1XPmDVtg4BYR8cq7uB0F8dspriuBpBZUWdbzxo_480frqbMfrXrdJwY0UnT--ph')"
                                }}
                            />
                        </div>
                        <div className="relative z-10 flex min-h-[400px] flex-col items-center justify-center gap-6 p-8 text-center lg:min-h-[500px]">
                            <h1 className="text-4xl font-black leading-tight tracking-tight text-white lg:text-6xl">الاستشارات القانونية</h1>
                            <p className="max-w-2xl text-lg font-normal text-slate-200 lg:text-xl">نقدم حلولاً قانونية متكاملة لضمان حقوقكم في القطاع العقاري من خلال فريق من الخبراء المتخصصين</p>
                            <button className="mt-4 flex items-center justify-center rounded-lg bg-primary px-8 py-4 text-base font-bold text-white shadow-lg hover:scale-105 transition-transform">
                                اطلب استشارة الآن
                            </button>
                        </div>
                    </div>
                </section>

                <section className="container mx-auto px-6 py-12 lg:px-20">
                    <div className="mb-10 flex flex-col items-start gap-2">
                        <h2 className="text-3xl font-bold tracking-tight text-slate-100">خدماتنا القانونية</h2>
                        <div className="h-1 w-20 bg-primary rounded-full"></div>
                    </div>
                    <div className="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                        <div className="group flex flex-col gap-4 rounded-xl border border-border-muted bg-accent p-8 transition-all hover:border-primary/50 hover:bg-primary/5">
                            <div className="flex h-12 w-12 items-center justify-center rounded-lg bg-primary/20 text-primary">
                                <span className="material-symbols-outlined text-3xl">description</span>
                            </div>
                            <h3 className="text-xl font-bold text-white">مراجعة العقود</h3>
                            <p className="text-slate-400 leading-relaxed">تدقيق شامل لكافة الاتفاقيات التعاقدية لضمان حقوقكم وتقليل المخاطر القانونية في المعاملات العقارية.</p>
                            <a className="mt-auto flex items-center gap-2 text-sm font-bold text-primary hover:underline" href="#">
                                اقرأ المزيد
                                <span className="material-symbols-outlined text-sm">arrow_back</span>
                            </a>
                        </div>

                        <div className="group flex flex-col gap-4 rounded-xl border border-border-muted bg-accent p-8 transition-all hover:border-primary/50 hover:bg-primary/5">
                            <div className="flex h-12 w-12 items-center justify-center rounded-lg bg-primary/20 text-primary">
                                <span className="material-symbols-outlined text-3xl">gavel</span>
                            </div>
                            <h3 className="text-xl font-bold text-white">فض النزاعات</h3>
                            <p className="text-slate-400 leading-relaxed">تمثيل قانوني احترافي لحل الخلافات العقارية والقانونية عبر الوساطة أو التحكيم أو التقاضي.</p>
                            <a className="mt-auto flex items-center gap-2 text-sm font-bold text-primary hover:underline" href="#">
                                اقرأ المزيد
                                <span className="material-symbols-outlined text-sm">arrow_back</span>
                            </a>
                        </div>

                        <div className="group flex flex-col gap-4 rounded-xl border border-border-muted bg-accent p-8 transition-all hover:border-primary/50 hover:bg-primary/5">
                            <div className="flex h-12 w-12 items-center justify-center rounded-lg bg-primary/20 text-primary">
                                <span className="material-symbols-outlined text-3xl">verified_user</span>
                            </div>
                            <h3 className="text-xl font-bold text-white">الامتثال التنظيمي</h3>
                            <p className="text-slate-400 leading-relaxed">التأكد من مطابقة كافة المشاريع للقوانين والأنظمة السائدة واللوائح العقارية المحدثة.</p>
                            <a className="mt-auto flex items-center gap-2 text-sm font-bold text-primary hover:underline" href="#">
                                اقرأ المزيد
                                <span className="material-symbols-outlined text-sm">arrow_back</span>
                            </a>
                        </div>
                    </div>
                </section>

                <section className="container mx-auto px-6 py-16 lg:px-20">
                    <div className="overflow-hidden rounded-2xl bg-accent border border-border-muted shadow-2xl">
                        <div className="grid grid-cols-1 lg:grid-cols-2">
                            <div className="p-8 lg:p-16">
                                <h2 className="text-3xl font-bold text-white mb-6">تواصل مع مستشارينا القانونيين</h2>
                                <p className="text-slate-400 mb-8 leading-relaxed">نحن هنا للإجابة على جميع استفساراتكم القانونية. يرجى ملء النموذج أدناه وسيقوم أحد خبرائنا بالتواصل معكم في أقرب وقت.</p>
                                <form className="space-y-4">
                                    <div className="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                        <div className="flex flex-col gap-1.5">
                                            <label className="text-sm font-medium text-slate-300">الاسم الكامل</label>
                                            <input className="w-full rounded-lg border-border-muted bg-background-dark/50 p-3 text-white focus:border-primary focus:ring-primary" placeholder="أدخل اسمك" type="text" />
                                        </div>
                                        <div className="flex flex-col gap-1.5">
                                            <label className="text-sm font-medium text-slate-300">البريد الإلكتروني</label>
                                            <input className="w-full rounded-lg border-border-muted bg-background-dark/50 p-3 text-white focus:border-primary focus:ring-primary" placeholder="example@mail.com" type="email" />
                                        </div>
                                    </div>
                                    <div className="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                        <div className="flex flex-col gap-1.5">
                                            <label className="text-sm font-medium text-slate-300">رقم الهاتف</label>
                                            <input className="w-full rounded-lg border-border-muted bg-background-dark/50 p-3 text-white focus:border-primary focus:ring-primary" placeholder="+966 50 000 0000" type="tel" />
                                        </div>
                                        <div className="flex flex-col gap-1.5">
                                            <label className="text-sm font-medium text-slate-300">نوع الاستشارة</label>
                                            <select className="w-full rounded-lg border-border-muted bg-background-dark/50 p-3 text-white focus:border-primary focus:ring-primary">
                                                <option>مراجعة عقود</option>
                                                <option>فض نزاعات</option>
                                                <option>امتثال تنظيمي</option>
                                                <option>أخرى</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div className="flex flex-col gap-1.5">
                                        <label className="text-sm font-medium text-slate-300">تفاصيل الاستفسار</label>
                                        <textarea className="w-full rounded-lg border-border-muted bg-background-dark/50 p-3 text-white focus:border-primary focus:ring-primary" placeholder="اكتب استفسارك هنا..." rows={4} />
                                    </div>
                                    <button className="w-full rounded-lg bg-primary py-4 font-bold text-white transition-all hover:bg-opacity-90" type="submit">إرسال الطلب</button>
                                </form>
                            </div>
                            <div className="relative hidden bg-primary/10 lg:block">
                                <div className="absolute inset-0 bg-cover bg-center mix-blend-overlay" data-alt="Lawyer hands signing legal documents on a desk" style={{ backgroundImage: "url('https://lh3.googleusercontent.com/aida-public/AB6AXuA25a-wGN0prUQM9XN9luJrB6inulhXQMBuMKzWfysyZUB96hvtmRhZXcK7dPrxTPF6vgRL1o-_1UOLYGUaagxUNCEx9AE7yTurS5fnxz54Lhoa5-5kp6c1SxBFia1Sr7at0w5osj8xTbG2LN-VyINaZpdiBd8XsMPzni14RF0QArQ676MaODZ1p8idkPKYlH5eajgo4fJUNbvLwl0L04Yk45zjdu9WZ-Zor8rtXyOFpvEw4-BzwyA8RGZF4vIXXjTKeFVbiZVw2Vm8')" }} />
                                <div className="relative flex h-full flex-col justify-end p-16 text-white">
                                    <div className="mb-8 space-y-4">
                                        <div className="flex items-center gap-4">
                                            <span className="material-symbols-outlined rounded-full bg-primary/40 p-2">call</span>
                                            <div>
                                                <p className="text-xs text-slate-300">اتصل بنا</p>
                                                <p className="font-bold">+966 9200 0000</p>
                                            </div>
                                        </div>
                                        <div className="flex items-center gap-4">
                                            <span className="material-symbols-outlined rounded-full bg-primary/40 p-2">mail</span>
                                            <div>
                                                <p className="text-xs text-slate-300">البريد الإلكتروني</p>
                                                <p className="font-bold">legal@afaq-omran.com</p>
                                            </div>
                                        </div>
                                        <div className="flex items-center gap-4">
                                            <span className="material-symbols-outlined rounded-full bg-primary/40 p-2">location_on</span>
                                            <div>
                                                <p className="text-xs text-slate-300">المقر الرئيسي</p>
                                                <p className="font-bold">الرياض، المملكة العربية السعودية</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </MainLayout>
    );
}
