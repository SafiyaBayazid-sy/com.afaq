import React from 'react';

export default function Hero() {
    return (
        <section className="relative h-[85vh] w-full overflow-hidden" dir="rtl">
            <div className="absolute inset-0">
                <img
                    className="w-full h-full object-cover"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuC4MLsz5h-k-vOi-RlKONbuJNKkIRVyvTgANjrgKp2-eb0RPx91-9qon9iXrcx42pDBhfxrvvoRjfVW4mr4fdE2f-RMuT5efIFtR8F4wdgmKJDwGBRGIV1Z7Rd8gRKCdQXzmBxM7M4F5KDj_TAzh4Y3xHTI2CdgsauqakdRIc1NR-CE50XUFTJe4eHEYwrcIxCTbQI-SudaQCJxphPYBY46AJ_wMbKaZVi9l3-WDntE3WQialA12UJKwOBWm2AhPGFB_cShRS8C6eVz"
                    alt="Modern high-quality architectural skyscraper render"
                />
                <div className="absolute inset-0 bg-gradient-to-l from-background-dark/80 via-background-dark/40 to-transparent" />
            </div>
            <div className="container mx-auto px-6 h-full flex flex-col justify-center items-end relative z-10">
                <div className="max-w-2xl space-y-6 text-right">
                    <h1 className="text-5xl md:text-7xl font-black leading-tight text-white drop-shadow-lg">
                        نصنع مستقبلاً <span className="text-primary dark:text-white underline decoration-primary">عمرانياً</span> متميزاً
                    </h1>
                    <p className="text-lg md:text-xl text-slate-100 max-w-xl leading-relaxed">
                        شركة آفاق العمران للتطوير العقاري: جودة في التنفيذ وابتكار في التصميم لتلبية تطلعاتكم السكنية والتجارية في المملكة.
                    </p>
                    <div className="flex flex-wrap gap-4 pt-4 justify-end">
                        <button className="min-w-[180px] cursor-pointer rounded-lg h-14 px-8 bg-primary text-white text-lg font-bold hover:scale-105 transition-transform flex items-center justify-center gap-2">
                            <span className="text">اكتشف مشاريعنا</span>
                            <svg xmlns="http://www.w3.org/2000/svg" className="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M14 7l-5 5 5 5" />
                            </svg>
                        </button>
                        <button className="min-w-[180px] cursor-pointer rounded-lg h-14 px-8 bg-white/10 backdrop-blur-md border border-white/20 text-white text-lg font-bold hover:bg-white/20 transition-all flex items-center justify-center gap-2">
                            <span>تواصل معنا</span>
                            <svg xmlns="http://www.w3.org/2000/svg" className="w-4 h-4 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h4" />
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M7 11l5 5 5-5" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>
    );
}
