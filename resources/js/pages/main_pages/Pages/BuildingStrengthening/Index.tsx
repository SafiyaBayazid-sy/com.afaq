import { Head } from '@inertiajs/react';
import MainLayout from '../../components/Layouts/MainLayout';

const stages = [
    {
        title: 'المرحلة الأولى: التقييم الإنشائي للمبنى',
        description:
            'يقوم فريقنا الهندسي بإجراء فحص شامل للمبنى لتحديد حالة الهيكل الإنشائي وتقييم الأضرار الموجودة مثل التشققات أو هبوط الأساسات أو ضعف العناصر الخرسانية.',
    },
    {
        title: 'المرحلة الثانية: الدراسة والتصميم الهندسي',
        description:
            'بعد التقييم، نقوم بإعداد دراسة إنشائية متكاملة تتضمن حلول التدعيم والترميم المناسبة باستخدام برامج هندسية حديثة لضمان دقة الحسابات.',
    },
    {
        title: 'المرحلة الثالثة: التنفيذ باستخدام تقنيات حديثة',
        description:
            'يتم تنفيذ أعمال التدعيم والترميم وفق معايير هندسية دقيقة وبإشراف مهندسين متخصصين لضمان الجودة والسلامة في كل مرحلة من مراحل العمل.',
    },
];

const highlights = ['تدعيم الأعمدة الخرسانية', 'إصلاح التشققات الإنشائية', 'تقوية الأساسات', 'إعادة تأهيل المباني المتضررة'];

export default function BuildingStrengthening() {
    return (
        <MainLayout>
            <Head title="تدعيم وترميم المباني" />

            <div dir="rtl">
                <section className="relative min-h-[60vh] overflow-hidden">
                    <div className="absolute inset-0 z-0 bg-cover bg-center" style={{ backgroundImage: "url('https://lh3.googleusercontent.com/aida-public/AB6AXuA96Y6KivullwrJ_oTpwgpMlv9JuaVBlKFKVt0B8RJdwZTJ6KF45gBOrzzDBPnlrlV1ooU7p5ZUcEpfZC-2lMWXG3LxkJV1PJ_pEXYtldMU1yXpypx110aPQC4xsANyIOWVoywxbWrSmvhGdvr67GP43i7Ykolg7NJKZ8zWX6ANp2DxKUPBF6yPautmgUtIlEKIfiXh8_E7znkVc1ZlIzQQZNDV33YG5bxKeylJRVEnIUm1R0yvYmy_drDcvxoo8Xdrjbu16Yc60p1e')" }} />
                    <div className="absolute inset-0 z-10 bg-primary/90" />

                    <div className="relative z-20 container mx-auto px-6 py-24 text-right text-white">
                        <h1 className="mb-6 text-4xl font-black leading-tight md:text-6xl">
                            تدعيم وترميم المباني
                            <br />
                            <span className="text-emerald-300">بأساليب هندسية حديثة وآمنة</span>
                        </h1>
                        <p className="max-w-3xl text-lg leading-relaxed text-slate-100">
                            في ظل الظروف التي مرت بها العديد من المدن في سوريا، أصبحت الكثير من الأبنية بحاجة إلى تقييم هندسي دقيق أو أعمال تدعيم
                            وترميم لضمان سلامتها وإمكانية استخدامها من جديد.
                        </p>
                        <div className="mt-8 flex flex-col gap-4 sm:flex-row">
                            <a className="rounded-lg bg-white px-6 py-3 text-center font-bold text-primary hover:bg-slate-100" href="#contact">
                                استشارة هندسية مجانية
                            </a>
                            <a className="rounded-lg border border-white/30 bg-white/10 px-6 py-3 text-center font-bold text-white hover:bg-white/20" href="/projects">
                                تصفح مشاريع التدعيم
                            </a>
                        </div>
                    </div>
                </section>

                <section className="bg-background-light py-20 dark:bg-background-dark">
                    <div className="mx-auto max-w-6xl px-6 text-right">
                        <h2 className="mb-4 text-3xl font-bold text-slate-900 dark:text-white">كيف نقوم بتدعيم وإعادة تأهيل المباني</h2>
                        <p className="mb-10 leading-relaxed text-slate-600 dark:text-slate-400">
                            نعتمد منهجية عمل واضحة تبدأ بالفحص الهندسي الدقيق للمبنى، ثم إعداد الدراسة المناسبة للحالة الإنشائية، وصولًا إلى التنفيذ
                            باستخدام تقنيات حديثة تضمن سلامة الهيكل الإنشائي.
                        </p>
                        <div className="grid gap-6 md:grid-cols-3">
                            {stages.map((stage) => (
                                <article key={stage.title} className="rounded-xl border border-primary/15 bg-white p-6 shadow-sm dark:bg-primary/10">
                                    <h3 className="mb-3 text-lg font-bold text-slate-900 dark:text-white">{stage.title}</h3>
                                    <p className="text-sm leading-relaxed text-slate-600 dark:text-slate-300">{stage.description}</p>
                                </article>
                            ))}
                        </div>
                    </div>
                </section>

                <section className="py-20">
                    <div className="mx-auto max-w-6xl px-6 text-right">
                        <h2 className="mb-4 text-3xl font-bold text-white">نماذج من أعمال التدعيم والترميم</h2>
                        <p className="mb-8 text-slate-300">
                            نمتلك خبرة في تنفيذ مشاريع تقييم وتدعيم المباني المتضررة باستخدام حلول هندسية متطورة تناسب كل حالة إنشائية.
                        </p>
                        <div className="grid gap-4 md:grid-cols-2">
                            {highlights.map((item) => (
                                <div key={item} className="rounded-xl border border-primary/20 bg-primary/10 p-5 text-slate-100">
                                    {item}
                                </div>
                            ))}
                        </div>
                    </div>
                </section>

                <section className="relative overflow-hidden py-20">
                    <div className="absolute inset-0 bg-primary" />
                    <div className="relative z-10 mx-auto max-w-5xl px-6 text-right text-white">
                        <h2 className="mb-4 text-3xl font-bold md:text-4xl">احمِ استثمارك العقاري من أي مخاطر إنشائية</h2>
                        <p className="mb-6 text-slate-100">
                            سواء كنت مغتربًا وتريد ترميم منزلك، أو مستثمرًا في عقار يحتاج تدعيمًا، نحن في آفاق العمران نوفر لك حلولًا قانونية واضحة،
                            وتقييمًا هندسيًا دقيقًا، وتنفيذًا بأحدث التقنيات العالمية.
                        </p>
                        <p className="mb-8 text-slate-100">دعنا نساعدك على استعادة قوة المبنى أو تطويره بطريقة آمنة وذكية حتى وأنت خارج البلد.</p>
                        <div className="flex flex-col gap-4 sm:flex-row">
                            <a className="rounded-lg bg-white px-6 py-3 text-center font-bold text-primary hover:bg-slate-100" href="#contact">
                                طلب استشارة هندسية مجانية
                            </a>
                            <a className="rounded-lg border border-white/30 px-6 py-3 text-center font-bold text-white hover:bg-white/10" href="tel:+9669200123456">
                                اتصل بنا الآن
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </MainLayout>
    );
}
