import React from 'react';

export default function AboutSummary() {
    return (
        <section className="py-24 bg-background-light dark:bg-background-dark" id="about" dir="rtl">
            <div className="container mx-auto px-6">
                <div className="flex flex-col lg:flex-row items-center gap-16">
                    <div className="lg:w-1/2 grid grid-cols-2 gap-4">
                        <div className="space-y-4">
                            <img
                                className="rounded-xl aspect-[4/5] object-cover shadow-2xl"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAgzWk4JAUY91y_9_UbOpPbI09sKrrjQK-HAkp-F6yQdxHJ9X5it4-_gcyM5FxOoKQcgwmVcLw_KcFe2v9fKlh5GhiZWTmrY75tQLudqmQg_wZNLAeeDshhtsL0VsfBovC0b7l8Y3b5sKZRBn6oXwoXbU9FqJSYvQLJr4O7iUs50YxzDPc7wEoTYVZsmWsoNOk2qlJSihajMUyOkrimgrAbYwslq7JqrcFnGdNdA0FhRFkk05RDpztmALfnwvaHHfF9rB64s0jDqa22"
                                alt="Construction site detailing quality standards"
                            />
                            <div className="bg-primary p-6 rounded-xl text-white">
                                <p className="text-3xl font-bold">15+</p>
                                <p className="text-sm opacity-80">سنة من الخبرة</p>
                            </div>
                        </div>
                        <div className="space-y-4 pt-12">
                            <div className="bg-primary/10 p-6 rounded-xl border border-primary/20">
                                <p className="text-3xl font-bold text-primary dark:text-white">50+</p>
                                <p className="text-sm text-slate-600 dark:text-slate-400">مشروع مكتمل</p>
                            </div>
                            <img
                                className="rounded-xl aspect-[4/5] object-cover shadow-2xl"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuD9zqMKnscNvQXVqMB2vqaeoC4dZRa2IxUxMCJkZyABqutqzFAWfD3tBUG8NXHeyrBqBZxMiN9qgaVXRbZ405L6aLqxCDAHO83JbNk7Dfrqq19MZcv3Nl9szpX8odXrDtggaLarWqz6DvP53KQcT1O9h3qAN2y4nGh4A7PpexDAN64-XOe52bCkVleqS2kxXSZEh1iXPhMu5raUlSjdK-K1_1EeMYMx2OC60Mnmd1MnmlpHO7pGNFpV0VqH8c6uHYOWFs2A8MqlJ_ZE"
                                alt="Modern interior design project"
                            />
                        </div>
                    </div>
                    <div className="lg:w-1/2 space-y-8">
                        <div className="space-y-4">
                            <h3 className="text-primary font-bold tracking-widest uppercase text-sm">عن آفاق العمران</h3>
                            <h2 className="text-4xl md:text-5xl font-black leading-tight text-slate-900 dark:text-white">
                                نبني مشاريع عقارية بمعايير عالمية
                            </h2>
                            <p className="text-lg text-slate-600 dark:text-slate-400 leading-relaxed">
                                في آفاق العمران نؤمن أن نجاح أي مشروع عقاري يبدأ من أساس قوي يجمع بين الأمان القانوني والتخطيط الهندسي والتنفيذ
                                الاحترافي. لهذا نعتمد منهج عمل واضح يبدأ بدراسة الوضع القانوني للعقار، ثم إعداد الدراسات والتصاميم الحديثة، وصولًا إلى
                                التنفيذ بمواد عالية الجودة وتقنيات بناء حديثة.
                            </p>
                        </div>
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div className="space-y-2">
                                <span className="material-symbols-outlined text-primary text-4xl">verified</span>
                                <h4 className="font-bold text-lg">الجودة</h4>
                                <p className="text-sm text-slate-500">نلتزم بأعلى المعايير لضمان مبانٍ قوية وآمنة تدوم لسنوات.</p>
                            </div>
                            <div className="space-y-2">
                                <span className="material-symbols-outlined text-primary text-4xl">lightbulb</span>
                                <h4 className="font-bold text-lg">الابتكار</h4>
                                <p className="text-sm text-slate-500">نعتمد أحدث التقنيات الهندسية وحلول المنازل الذكية.</p>
                            </div>
                            <div className="space-y-2">
                                <span className="material-symbols-outlined text-primary text-4xl">handshake</span>
                                <h4 className="font-bold text-lg">الموثوقية</h4>
                                <p className="text-sm text-slate-500">نبدأ بدراسة قانونية واضحة ونلتزم بالشفافية في كل المراحل.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
