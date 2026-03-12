import { Link } from '@inertiajs/react';

export default function CTA() {
    return (
        <section className="pb-20">
            <div className="container mx-auto px-6">
            <div className="bg-primary rounded-3xl p-12 text-center text-white relative overflow-hidden">
                <div className="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-32 -mt-32"></div>
                <div className="absolute bottom-0 left-0 w-32 h-32 bg-white/5 rounded-full -ml-16 -mb-16"></div>
                <h2 className="text-3xl font-bold mb-6">هل أنت مستعد لبدء مشروعك القادم؟</h2>
                <p className="text-slate-300 mb-8 max-w-xl mx-auto">
                    دعنا نساعدك في تحويل رؤيتك إلى واقع ملموس بدقة واحترافية عالية.
                </p>
                <div className="flex flex-col sm:flex-row justify-center gap-4">
                    <button className="bg-white text-primary px-8 py-3 rounded-lg font-bold hover:bg-slate-100 transition-colors">
                        تواصل معنا الآن
                    </button>
                    <Link href="/projects" className="border border-white/30 text-white px-8 py-3 rounded-lg font-bold hover:bg-white/10 transition-colors">
                        تصفح مشاريعنا
                    </Link>
                </div>
            </div>
            </div>
        </section>
    );
}
