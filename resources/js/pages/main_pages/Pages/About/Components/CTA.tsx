import { Link } from '@inertiajs/react';

const ctaItems = ['بناء منزل حديث', 'ترميم عقار متضرر', 'تطوير مشروع استثماري'];

export default function CTA() {
    return (
        <section className="pb-20" dir="rtl">
            <div className="container mx-auto px-6">
                <div className="relative overflow-hidden rounded-3xl bg-primary p-12 text-right text-white">
                    <div className="absolute -right-32 -top-32 h-64 w-64 rounded-full bg-white/5" />
                    <div className="absolute -bottom-16 -left-16 h-32 w-32 rounded-full bg-white/5" />
                    <h2 className="mb-4 text-3xl font-bold">هل أنت مستعد لبدء مشروعك؟</h2>
                    <p className="mb-4 max-w-2xl text-slate-200">
                        سواء كنت ترغب في بناء منزل حديث أو ترميم عقار متضرر أو تطوير مشروع استثماري، فريق آفاق العمران جاهز لمساعدتك وفق أعلى
                        المعايير.
                    </p>
                    <ul className="mb-8 space-y-2 text-slate-100">
                        {ctaItems.map((item) => (
                            <li key={item}>● {item}</li>
                        ))}
                    </ul>
                    <div className="flex flex-col justify-start gap-4 sm:flex-row">
                        <a className="rounded-lg bg-white px-8 py-3 text-center font-bold text-primary transition-colors hover:bg-slate-100" href="#contact">
                            تواصل معنا الآن
                        </a>
                        <Link
                            className="rounded-lg border border-white/30 px-8 py-3 text-center font-bold text-white transition-colors hover:bg-white/10"
                            href="/projects"
                        >
                            تصفح مشاريعنا
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    );
}
