import { Link } from '@inertiajs/react';

export default function Hero() {
    return (
        <section className="relative h-[85vh] w-full overflow-hidden" dir="rtl" id="home">
            <div className="absolute inset-0">
                <img
                    alt="Modern high-quality architectural skyscraper render"
                    className="h-full w-full object-cover"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuC4MLsz5h-k-vOi-RlKONbuJNKkIRVyvTgANjrgKp2-eb0RPx91-9qon9iXrcx42pDBhfxrvvoRjfVW4mr4fdE2f-RMuT5efIFtR8F4wdgmKJDwGBRGIV1Z7Rd8gRKCdQXzmBxM7M4F5KDj_TAzh4Y3xHTI2CdgsauqakdRIc1NR-CE50XUFTJe4eHEYwrcIxCTbQI-SudaQCJxphPYBY46AJ_wMbKaZVi9l3-WDntE3WQialA12UJKwOBWm2AhPGFB_cShRS8C6eVz"
                />
                <div className="absolute inset-0 bg-gradient-to-l from-background-dark/80 via-background-dark/40 to-transparent" />
            </div>

            <div className="relative z-10 container mx-auto flex h-full flex-col items-start justify-center px-6">
                <div className="max-w-2xl space-y-6 text-right">
                    <h1 className="text-5xl font-black leading-tight text-white drop-shadow-lg md:text-7xl">
                        نبني مستقبلك العقاري بثقة…{' '}
                        <span className="text-primary underline decoration-primary dark:text-white">
                            حتى لو كنت خارج البلد
                        </span>{' '}
                    </h1>
                    <p className="max-w-xl text-lg leading-relaxed text-slate-100 md:text-xl">
                        في آفاق العمران نساعد المغتربين على بناء أو تطوير عقاراتهم في سوريا بطريقة آمنة واحترافية، بدءًا من التحقق القانوني للعقار،
                        ثم إعداد الدراسات الهندسية الحديثة، وصولًا إلى التنفيذ بأحدث تقنيات البناء والمعايير العالمية.
                    </p>
                    <div className="flex flex-wrap gap-4 pt-4">
                        <a
                            className="flex h-14 min-w-[180px] items-center justify-center gap-2 rounded-lg border border-white/20 bg-white/10 px-8 text-lg font-bold text-white transition-all hover:bg-white/20"
                            href="#contact"
                        >
                            <span>تواصل معنا</span>
                        </a>
                        <Link
                            className="flex h-14 min-w-[180px] items-center justify-center gap-2 rounded-lg bg-primary px-8 text-lg font-bold text-white transition-transform hover:scale-105"
                            href="/projects"
                        >
                            <span>اكتشف مشاريعنا</span>
                            <span className="material-symbols-outlined">arrow_back</span>
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    );
}
