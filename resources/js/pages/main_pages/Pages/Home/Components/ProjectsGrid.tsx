import React from 'react';

export default function ProjectsGrid() {
    return (
        <section className="py-24 bg-slate-50 dark:bg-primary/5" id="projects" dir="rtl">
            <div className="container mx-auto px-6">
                <div className="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                    <div className="max-w-xl space-y-4 text-right">
                        <h2 className="text-4xl font-black text-slate-900 dark:text-white">مشاريعنا المميزة</h2>
                        <p className="text-slate-600 dark:text-slate-400">
                            نستعرض لكم نخبة من مشاريعنا التي تجسد رؤيتنا في التطوير العمراني الحديث.
                        </p>
                    </div>
                    <a
                        className="text-primary font-bold flex items-center gap-2 hover:underline transition-all"
                        href="#"
                    >
                        عرض جميع المشاريع
                        <span className="material-symbols-outlined">west</span>
                    </a>
                </div>
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    {/* Project 1 */}
                    <div className="group relative overflow-hidden rounded-2xl bg-white dark:bg-background-dark shadow-lg hover:shadow-2xl transition-all border border-slate-100 dark:border-primary/20 flex flex-col text-right">
                        <div className="aspect-[16/10] overflow-hidden">
                            <img
                                className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCYqavgjO6WUWWiQ4eCHT_bHpOFcmmlzGVldvu_h7p9koPGfRwD9W1LUXRPYAZcE8MmoyjTyaLerJvmVpDTe4ma6xB6PsM_ywUr4QBEd5wDxm1Ykzsvy7jMyGHTP7vbr2zk0qbWAMaM5UlitWPate8-KRSLTo7z25CcZvo28ZHWiC4tcEwe-AazhMJ2dz-6l5omiNyvw6wkPL_RmyjJJRUCBsJwXDP_9-VlEgeNvlztEAbXLWdgtFdT_S6dz7y9V6ISjaUbWgZrFQkn"
                                alt="Luxury villa with modern glass facade"
                            />
                        </div>
                        <div className="p-6">
                            <span className="text-xs font-bold text-primary bg-primary/10 px-3 py-1 rounded-full uppercase tracking-wider">سكني</span>
                            <h3 className="text-xl font-bold mt-3 mb-2">ضاحية النخيل</h3>
                            <p className="text-slate-500 text-sm mb-4 line-clamp-2">
                                فلل سكنية فاخرة بتصاميم عصرية توفر أقصى درجات الخصوصية والراحة لعائلتك.
                            </p>
                            <div className="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-primary/10">
                                <div className="flex items-center gap-2 text-slate-400 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" className="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 10c0 6-9 13-9 13S3 16 3 10a9 9 0 1 1 18 0z" />
                                            <circle cx="12" cy="10" r="3" />
                                        </svg>
                                        <span data-location="الرياض">الرياض</span>
                                    </div>
                                <button className="text-primary font-bold text-sm">التفاصيل</button>
                            </div>
                        </div>
                    </div>
                    {/* Project 2 */}
                    <div className="group relative overflow-hidden rounded-2xl bg-white dark:bg-background-dark shadow-lg hover:shadow-2xl transition-all border border-slate-100 dark:border-primary/20 flex flex-col text-right">
                        <div className="aspect-[16/10] overflow-hidden">
                            <img
                                className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuC79yWwCyln0Dvuti9-0V_wmxOEBgCcdy7sf9s02pUwMbhH0br3viIOTGqcZbBhxZfquyZVepqZJ7R1GbN9uD6g_cWGjNqw47DqDZhajz-Ap0MItMhO0tReqhOZdpEzvb6AAlbfzN_TktSz6rqUWBrFk5xk123Of8g4ZL88Qwv8P8pmBpTPkKbzgtxm9oE83hnxWc79mHcj2hVoBudVeQobWv9w_GjrWKI88TGK5KYHSOLFQl0Qkt3sHSQMUe87VdyzvnSGDhA0NU6H"
                                alt="Modern commercial office building interior"
                            />
                        </div>
                        <div className="p-6">
                            <span className="text-xs font-bold text-primary bg-primary/10 px-3 py-1 rounded-full uppercase tracking-wider">تجاري</span>
                            <h3 className="text-xl font-bold mt-3 mb-2">مركز آفاق التجاري</h3>
                            <p className="text-slate-500 text-sm mb-4 line-clamp-2">
                                بيئة عمل متكاملة للمكاتب والشركات الناشئة في قلب المنطقة المركزية.
                            </p>
                            <div className="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-primary/10">
                                <div className="flex items-center gap-2 text-slate-400 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" className="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 10c0 6-9 13-9 13S3 16 3 10a9 9 0 1 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    <span data-location="جدة">جدة</span>
                                </div>
                                <button className="text-primary font-bold text-sm">التفاصيل</button>
                            </div>
                        </div>
                    </div>
                    {/* Project 3 */}
                    <div className="group relative overflow-hidden rounded-2xl bg-white dark:bg-background-dark shadow-lg hover:shadow-2xl transition-all border border-slate-100 dark:border-primary/20 flex flex-col text-right">
                        <div className="aspect-[16/10] overflow-hidden">
                            <img
                                className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAUgSSg-7rKt8xbGt-r3ZM7C8R6TfwwQrThzjqGSf_BBCOAIgAfe9SJygjIdbHtN5ffpzFBVF4fRuS_2gZIRiRIAt45o8o9MPQw9So1KTiBAfjNBM3k4ghoqHVxDT_tOHgMn02KaWHuiwr8vbl4q9SY19hCfh2pxK5-kAfIhBQ5J1KvV9ydfg32dtGHjMiE3fO6LBpBmlzmutqETT9zAKrufNGIvJPt7ADeHT5TCxXsCl2DWg0C_e2n5OAEPxeJEDmik4HYPYkHe4KY"
                                alt="Resort style residential complex with pool"
                            />
                        </div>
                        <div className="p-6">
                            <span className="text-xs font-bold text-primary bg-primary/10 px-3 py-1 rounded-full uppercase tracking-wider">متعدد الاستخدام</span>
                            <h3 className="text-xl font-bold mt-3 mb-2">مجمع الواحة السكني</h3>
                            <p className="text-slate-500 text-sm mb-4 line-clamp-2">
                                تجربة حياة فريدة تجمع بين الرفاهية والمرافق الترفيهية المتكاملة.
                            </p>
                            <div className="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-primary/10">
                                <div className="flex items-center gap-2 text-slate-400 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" className="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 10c0 6-9 13-9 13S3 16 3 10a9 9 0 1 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    <span data-location="الدمام">الدمام</span>
                                </div>
                                <button className="text-primary font-bold text-sm">التفاصيل</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
