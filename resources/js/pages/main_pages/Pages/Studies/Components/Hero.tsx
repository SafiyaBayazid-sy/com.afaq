import React from 'react';

export default function Hero() {
    return (
        <section className="relative h-[450px] w-full flex items-center justify-center overflow-hidden">
            <div className="absolute inset-0 bg-gradient-to-b from-primary/80 to-background-dark/95 z-10"></div>
            <div 
                className="absolute inset-0 bg-cover bg-center"
                style={{
                    backgroundImage: "url('https://images.unsplash.com/photo-1541888946425-d81bb19480c5?auto=format&fit=crop&q=80')"
                }}
            ></div>
            
            <div className="relative z-20 text-center px-4 max-w-3xl">
                <h1 className="text-4xl md:text-6xl font-black text-white mb-6 leading-tight">
                    مركز الدراسات والبحوث
                </h1>
                <p className="text-lg md:text-xl text-slate-200 mb-8 font-light">
                    منصة معرفية متكاملة تقدم تحليلات معمقة وتقارير دورية حول اتجاهات سوق العقارات والإنشاءات في المنطقة
                </p>
                
                <div className="flex flex-wrap gap-4 justify-center">
                    <button className="bg-white text-primary px-8 py-3 rounded-lg font-bold hover:bg-slate-100 transition-all flex items-center gap-2">
                        <span className="material-symbols-outlined">auto_graph</span>
                        استكشف التقارير
                    </button>
                    <button className="bg-primary/40 text-white backdrop-blur-md border border-white/20 px-8 py-3 rounded-lg font-bold hover:bg-primary/60 transition-all">
                        الاشتراك في النشرة
                    </button>
                </div>
            </div>
        </section>
    );
}