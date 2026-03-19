import { Link } from '@inertiajs/react';
import React from 'react';

export default function ProjectsGrid() {
    const projects = [
        {
            slug: 'dhahiat-al-nakheel',
            category: 'سكني',
            title: 'ضاحية النخيل',
            description: 'فلل سكنية فاخرة بتصاميم عصرية توفر أقصى درجات الخصوصية والراحة لعائلتك.',
            location: 'الرياض',
            image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCYqavgjO6WUWWiQ4eCHT_bHpOFcmmlzGVldvu_h7p9koPGfRwD9W1LUXRPYAZcE8MmoyjTyaLerJvmVpDTe4ma6xB6PsM_ywUr4QBEd5wDxm1Ykzsvy7jMyGHTP7vbr2zk0qbWAMaM5UlitWPate8-KRSLTo7z25CcZvo28ZHWiC4tcEwe-AazhMJ2dz-6l5omiNyvw6wkPL_RmyjJJRUCBsJwXDP_9-VlEgeNvlztEAbXLWdgtFdT_S6dz7y9V6ISjaUbWgZrFQkn',
        },
        {
            slug: 'afaq-commercial-center',
            category: 'تجاري',
            title: 'مركز آفاق التجاري',
            description: 'بيئة عمل متكاملة للمكاتب والشركات الناشئة في قلب المنطقة المركزية.',
            location: 'جدة',
            image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuC79yWwCyln0Dvuti9-0V_wmxOEBgCcdy7sf9s02pUwMbhH0br3viIOTGqcZbBhxZfquyZVepqZJ7R1GbN9uD6g_cWGjNqw47DqDZhajz-Ap0MItMhO0tReqhOZdpEzvb6AAlbfzN_TktSz6rqUWBrFk5xk123Of8g4ZL88Qwv8P8pmBpTPkKbzgtxm9oE83hnxWc79mHcj2hVoBudVeQobWv9w_GjrWKI88TGK5KYHSOLFQl0Qkt3sHSQMUe87VdyzvnSGDhA0NU6H',
        },
        {
            slug: 'oasis-residential-complex',
            category: 'متعدد الاستخدام',
            title: 'مجمع الواحة السكني',
            description: 'تجربة حياة فريدة تجمع بين الرفاهية والمرافق الترفيهية المتكاملة.',
            location: 'الدمام',
            image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuAUgSSg-7rKt8xbGt-r3ZM7C8R6TfwwQrThzjqGSf_BBCOAIgAfe9SJygjIdbHtN5ffpzFBVF4fRuS_2gZIRiRIAt45o8o9MPQw9So1KTiBAfjNBM3k4ghoqHVxDT_tOHgMn02KaWHuiwr8vbl4q9SY19hCfh2pxK5-kAfIhBQ5J1KvV9ydfg32dtGHjMiE3fO6LBpBmlzmutqETT9zAKrufNGIvJPt7ADeHT5TCxXsCl2DWg0C_e2n5OAEPxeJEDmik4HYPYkHe4KY',
        },
    ];

    return (
        <section className="py-24 bg-slate-50 dark:bg-primary/5" id="projects" dir="rtl">
            <div className="container mx-auto px-6">
                <div className="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                    <div className="max-w-xl space-y-4 text-right">
                        <h2 className="text-4xl font-black text-slate-900 dark:text-white">مشاريعنا المميزة</h2>
                        <p className="text-slate-600 dark:text-slate-300">
                            استكشف مجموعة من المشاريع التي قمنا بتصميمها وتنفيذها وفق أحدث المعايير الهندسية، والتي تجمع بين الجودة المعمارية
                            والتصميم الحديث والاستدامة.
                        </p>
                    </div>
                    <Link className="text-primary font-bold flex items-center gap-2 hover:underline transition-all" href="/projects">
                        عرض جميع المشاريع
                        <span className="material-symbols-outlined">west</span>
                    </Link>
                </div>
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    {projects.map((project) => (
                        <div
                            key={project.slug}
                            className="group relative flex h-full flex-col overflow-hidden rounded-2xl border border-primary/20 bg-background-dark/60 text-right shadow-lg shadow-black/20 backdrop-blur-sm transition-all duration-300 hover:border-primary/40 hover:shadow-2xl hover:shadow-black/30"
                        >
                            <div className="aspect-[16/10] overflow-hidden">
                                <img
                                    className="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                    src={project.image}
                                    alt={project.title}
                                />
                            </div>
                            <div className="p-6">
                                <span className="text-xs font-semibold tracking-wide text-primary">{project.category}</span>
                                <h3 className="mt-3 mb-2 text-xl font-bold text-white">{project.title}</h3>
                                <p className="mb-4 line-clamp-2 text-sm leading-relaxed text-slate-400">{project.description}</p>
                                <div className="flex items-center justify-between border-t border-primary/10 pt-4">
                                    <div className="flex items-center gap-2 text-sm text-slate-400">
                                        <span className="material-symbols-outlined text-sm">location_on</span>
                                        <span>{project.location}</span>
                                    </div>
                                    <Link href={`/projects/${project.slug}`} className="text-sm font-bold text-primary transition-colors hover:text-white">
                                        التفاصيل
                                    </Link>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
}
