import { Head, Link } from '@inertiajs/react';
import React from 'react';
import MainLayout from '../../components/Layouts/MainLayout';

export default function Projects() {
    const projects = [
        {
            slug: 'dhahiat-al-nakheel',
            title: 'ضاحية النخيل',
            category: 'سكني',
            location: 'الرياض',
            description: 'فلل سكنية فاخرة بتصاميم عصرية توفر أقصى درجات الخصوصية والراحة لعائلتك.',
            image:
                'https://lh3.googleusercontent.com/aida-public/AB6AXuCYqavgjO6WUWWiQ4eCHT_bHpOFcmmlzGVldvu_h7p9koPGfRwD9W1LUXRPYAZcE8MmoyjTyaLerJvmVpDTe4ma6xB6PsM_ywUr4QBEd5wDxm1Ykzsvy7jMyGHTP7vbr2zk0qbWAMaM5UlitWPate8-KRSLTo7z25CcZvo28ZHWiC4tcEwe-AazhMJ2dz-6l5omiNyvw6wkPL_RmyjJJRUCBsJwXDP_9-VlEgeNvlztEAbXLWdgtFdT_S6dz7y9V6ISjaUbWgZrFQkn',
        },
        {
            slug: 'afaq-commercial-center',
            title: 'مركز آفاق التجاري',
            category: 'تجاري',
            location: 'جدة',
            description: 'بيئة عمل متكاملة للمكاتب والشركات الناشئة في قلب المنطقة المركزية.',
            image:
                'https://lh3.googleusercontent.com/aida-public/AB6AXuC79yWwCyln0Dvuti9-0V_wmxOEBgCcdy7sf9s02pUwMbhH0br3viIOTGqcZbBhxZfquyZVepqZJ7R1GbN9uD6g_cWGjNqw47DqDZhajz-Ap0MItMhO0tReqhOZdpEzvb6AAlbfzN_TktSz6rqUWBrFk5xk123Of8g4ZL88Qwv8P8pmBpTPkKbzgtxm9oE83hnxWc79mHcj2hVoBudVeQobWv9w_GjrWKI88TGK5KYHSOLFQl0Qkt3sHSQMUe87VdyzvnSGDhA0NU6H',
        },
        {
            slug: 'oasis-residential-complex',
            title: 'مجمع الواحة السكني',
            category: 'متعدد الاستخدام',
            location: 'الدمام',
            description: 'تجربة حياة فريدة تجمع بين الرفاهية والمرافق الترفيهية المتكاملة.',
            image:
                'https://lh3.googleusercontent.com/aida-public/AB6AXuAUgSSg-7rKt8xbGt-r3ZM7C8R6TfwwQrThzjqGSf_BBCOAIgAfe9SJygjIdbHtN5ffpzFBVF4fRuS_2gZIRiRIAt45o8o9MPQw9So1KTiBAfjNBM3k4ghoqHVxDT_tOHgMn02KaWHuiwr8vbl4q9SY19hCfh2pxK5-kAfIhBQ5J1KvV9ydfg32dtGHjMiE3fO6LBpBmlzmutqETT9zAKrufNGIvJPt7ADeHT5TCxXsCl2DWg0C_e2n5OAEPxeJEDmik4HYPYkHe4KY',
        },
    ];

    return (
        <MainLayout>
            <Head title="المشاريع" />

            <div className="flex-grow">
                <section className="relative w-full px-4 py-14 lg:px-20" dir="rtl">
                    <div className="absolute inset-0 bg-primary/90" />
                    <div
                        className="absolute inset-0 bg-cover bg-center opacity-30"
                        style={{
                            backgroundImage:
                                "url('https://lh3.googleusercontent.com/aida-public/AB6AXuBNLsLXpVbgwE5qPKvF53XjX6fEcoWYxCppdX3ZgU9mTdrB0ZfCxPGsr5aS-7bB6ZMnn4fHZ48v3nb5m7McvigA5RrGreen47yzSEx2E4m33P0kUBsUHOGKxiBOTQSYgFrxbZvhTZvrqQCMHhr6OF1aZlQFvKc-Qm0sOkEugwrHChLOQ6N6tpxinG1dY5M17dHd7n_HGR0xn9dKP6q5cdV1t-8owWkzSHR3m_xrJNr-lW3e3aI9mtSBu4v1KmG1')",
                        }}
                    />
                    <div className="relative z-10 text-center">
                        <h1 className="text-4xl md:text-6xl lg:text-7xl font-black text-white leading-tight mb-6">
                            مشاريعنا
                        </h1>
                        <p className="max-w-3xl mx-auto text-slate-200 text-lg md:text-xl leading-relaxed">
                            استكشف مجموعة مشاريعنا المتميزة، من الوحدات السكنية الفاخرة حتى المرافق التجارية الديناميكية.
                        </p>
                    </div>
                </section>

                <section className="container mx-auto px-6 py-16 lg:px-20" dir="rtl">
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        {projects.map((project) => (
                            <div key={project.slug} className="group relative flex cursor-pointer flex-col overflow-hidden rounded-2xl border border-slate-100 bg-white text-right shadow-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl dark:border-primary/20 dark:bg-background-dark">
                                <div className="aspect-[16/10] overflow-hidden">
                                    <img
                                        className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                        src={project.image}
                                        alt={project.title}
                                    />
                                </div>
                                <div className="p-6">
                                    <span className="text-xs font-bold text-primary bg-primary/10 px-3 py-1 rounded-full uppercase tracking-wider">
                                        {project.category}
                                    </span>
                                    <h3 className="text-xl font-bold mt-3 mb-2">{project.title}</h3>
                                    <p className="text-slate-500 text-sm mb-4 line-clamp-2">{project.description}</p>
                                    <div className="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-primary/10">
                                        <div className="flex items-center gap-2 text-slate-400 text-sm">
                                            <span className="material-symbols-outlined text-sm">location_on</span>
                                            <span>{project.location}</span>
                                        </div>
                                        <Link href={`/projects/${project.slug}`} className="text-primary font-bold text-sm">
                                            التفاصيل
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </section>
            </div>
        </MainLayout>
    );
}
