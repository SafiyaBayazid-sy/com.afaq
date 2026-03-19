import { Head } from '@inertiajs/react';
import MainLayout from '../../components/Layouts/MainLayout';

const services = [
    {
        icon: 'description',
        title: 'مراجعة العقود',
        description:
            'نقوم بمراجعة وصياغة العقود العقارية لضمان أن جميع الاتفاقيات قانونية وواضحة وتحفظ حقوق جميع الأطراف مع تقليل أي مخاطر مستقبلية.',
    },
    {
        icon: 'gavel',
        title: 'فض النزاعات',
        description:
            'في حال وجود أي خلافات مرتبطة بالعقار، يعمل فريقنا القانوني على تقديم الحلول المناسبة واتباع الإجراءات القانونية لحل النزاع بأفضل طريقة.',
    },
    {
        icon: 'verified_user',
        title: 'الامتثال التنظيمي',
        description:
            'نتأكد من توافق المشروع مع الأنظمة والقوانين التنظيمية المتعلقة بالبناء والعقارات لضمان تنفيذ المشروع بشكل قانوني دون عوائق.',
    },
];

const whyImportant = ['التأكد من سلامة الملكية', 'تجنب النزاعات القانونية', 'تنظيم العقود بطريقة تحفظ الحقوق', 'البدء بالمشروع بثقة وأمان'];

export default function LegalConsultations() {
    return (
        <MainLayout>
            <Head title="الاستشارات القانونية للعقار" />

            <div dir="rtl">
                <section className="relative w-full px-4 py-8 lg:px-20">
                    <div className="relative overflow-hidden rounded-xl bg-slate-800">
                        <div className="absolute inset-0 z-0 bg-cover bg-center opacity-45" style={{ backgroundImage: "linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.8)), url('https://lh3.googleusercontent.com/aida-public/AB6AXuAhQHqCItzOklEcna-m7QBKTvk0VhiebM-JHmA-6m1efreB7i75rC-AWHz45pcTOsQmEtSGPMUkIncaImBMEaywx8aE_H9P9X3yh3q6ogawCMGGDPCRPMekgNigNKhTp4HomY31dSgX-q1F-7I2aryARkj0uVkOTXXOrVFl3zlfS12pyBQJihWyQgf412_yxsZIvg2fU87bUP0z_1XPmDVtg4BYR8cq7uB0F8dspriuBpBZUWdbzxo_480frqbMfrXrdJwY0UnT--ph')" }} />
                        <div className="relative z-10 flex min-h-[420px] flex-col items-start justify-center gap-6 p-8 text-right lg:min-h-[520px] lg:p-14">
                            <h1 className="text-4xl font-black leading-tight text-white lg:text-6xl">
                                الاستشارات القانونية للعقار
                                <br />
                                <span className="text-slate-200">أساس الأمان قبل أي مشروع</span>
                            </h1>
                            <p className="max-w-3xl text-lg leading-relaxed text-slate-200">
                                نؤمن أن أي مشروع عقاري ناجح يبدأ من السلامة القانونية للعقار. لذلك نقدم خدمات استشارية متخصصة للتأكد من أن الأرض أو
                                العقار خالٍ من أي مشاكل قانونية أو تنظيمية قبل البدء بأي عملية بناء أو استثمار.
                            </p>
                            <div className="flex flex-col gap-4 sm:flex-row">
                                <a className="rounded-lg bg-primary px-8 py-3 text-center font-bold text-white hover:bg-primary/90" href="#contact">
                                    طلب استشارة قانونية
                                </a>
                                <a className="rounded-lg border border-white/30 bg-white/10 px-8 py-3 text-center font-bold text-white hover:bg-white/20" href="#contact">
                                    تواصل معنا الآن
                                </a>
                            </div>
                        </div>
                    </div>
                </section>

                <section className="container mx-auto px-6 py-12 lg:px-20">
                    <div className="mb-10 text-right">
                        <h2 className="text-3xl font-bold tracking-tight text-slate-100">خدماتنا القانونية في القطاع العقاري</h2>
                        <div className="mt-3 h-1 w-20 rounded-full bg-primary"></div>
                    </div>
                    <div className="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                        {services.map((service) => (
                            <article
                                key={service.title}
                                className="flex flex-col gap-4 rounded-xl border border-slate-200 bg-white/95 p-8 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-primary/40 hover:shadow-xl dark:border-primary/20 dark:bg-primary/10"
                            >
                                <div className="flex h-12 w-12 items-center justify-center rounded-lg bg-primary/20 text-primary">
                                    <span className="material-symbols-outlined text-3xl">{service.icon}</span>
                                </div>
                                <h3 className="text-xl font-bold text-slate-900 dark:text-white">{service.title}</h3>
                                <p className="leading-relaxed text-slate-600 dark:text-slate-400">{service.description}</p>
                            </article>
                        ))}
                    </div>
                </section>

                <section className="container mx-auto px-6 py-4 lg:px-20">
                    <div className="rounded-2xl border border-primary/20 bg-primary/10 p-8 text-right">
                        <h3 className="mb-4 text-2xl font-bold text-white">لماذا الاستشارة القانونية مهمة؟</h3>
                        <p className="mb-5 leading-relaxed text-slate-200">
                            قبل شراء الأرض أو البدء بالبناء أو الاستثمار العقاري، من الضروري التأكد من سلامة الوضع القانوني للعقار. الكثير من المشاكل
                            التي يواجهها المستثمرون تبدأ من عدم التحقق القانوني الصحيح.
                        </p>
                        <div className="grid gap-3 sm:grid-cols-2">
                            {whyImportant.map((item) => (
                                <div key={item} className="rounded-lg bg-white/10 p-4 text-slate-100">
                                    {item}
                                </div>
                            ))}
                        </div>
                    </div>
                </section>

                <section className="container mx-auto px-6 py-16 lg:px-20">
                    <div className="overflow-hidden rounded-2xl border border-slate-200 bg-white/95 shadow-2xl dark:border-primary/20 dark:bg-primary/10">
                        <div className="grid grid-cols-1 lg:grid-cols-2">
                            <div className="p-8 text-right lg:p-14">
                                <h2 className="mb-4 text-3xl font-bold text-slate-900 dark:text-white">تواصل مع مستشارينا القانونيين</h2>
                                <p className="mb-6 leading-relaxed text-slate-600 dark:text-slate-300">
                                    إذا كنت تفكر في شراء أرض، ترميم عقار، أو تنفيذ مشروع استثماري، فإن الخطوة الأولى هي التأكد من سلامة الوضع القانوني.
                                    فريقنا القانوني مستعد لمساعدتك حتى لو كنت خارج البلد.
                                </p>
                                <p className="mb-6 text-sm text-slate-500 dark:text-slate-400">
                                    تم توحيد التواصل عبر نموذج البريد المختصر أسفل الموقع: أدخل بريدك الإلكتروني وسنرسل لك رابط التطبيق لإدارة جميع
                                    الخدمات.
                                </p>
                                <a className="inline-flex rounded-lg bg-primary px-8 py-3 font-bold text-white hover:bg-primary/90" href="#contact">
                                    الانتقال إلى نموذج البريد
                                </a>
                            </div>
                            <div className="relative hidden bg-primary/10 lg:block">
                                <div className="absolute inset-0 bg-cover bg-center mix-blend-overlay" style={{ backgroundImage: "url('https://lh3.googleusercontent.com/aida-public/AB6AXuA25a-wGN0prUQM9XN9luJrB6inulhXQMBuMKzWfysyZUB96hvtmRhZXcK7dPrxTPF6vgRL1o-_1UOLYGUaagxUNCEx9AE7yTurS5fnxz54Lhoa5-5kp6c1SxBFia1Sr7at0w5osj8xTbG2LN-VyINaZpdiBd8XsMPzni14RF0QArQ676MaODZ1p8idkPKYlH5eajgo4fJUNbvLwl0L04Yk45zjdu9WZ-Zor8rtXyOFpvEw4-BzwyA8RGZF4vIXXjTKeFVbiZVw2Vm8')" }} />
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </MainLayout>
    );
}
