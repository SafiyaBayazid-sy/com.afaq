import { usePublicLanguage } from '../../../hooks/use-public-language';

export default function AboutSummary() {
    const { dir, isEnglish } = usePublicLanguage();
    const content = isEnglish
        ? {
              experience: 'Years of experience',
              projects: 'Completed projects',
              eyebrow: 'About Afaq Omran',
              title: 'We build real estate projects to international standards',
              description:
                  'At Afaq Omran, we believe every successful property project starts with a strong foundation that combines legal safety, engineering planning, and professional execution. That is why we follow a clear process that begins with studying the legal status of the property, continues through modern designs and technical studies, and ends with high-quality materials and modern construction methods.',
              features: [
                  {
                      icon: 'verified',
                      title: 'Quality',
                      description:
                          'We commit to the highest standards to deliver strong, safe buildings that last for years.',
                  },
                  {
                      icon: 'lightbulb',
                      title: 'Innovation',
                      description:
                          'We use modern engineering practices and smart-home solutions where they add real value.',
                  },
                  {
                      icon: 'handshake',
                      title: 'Trust',
                      description:
                          'We start with clear legal due diligence and stay transparent through every stage.',
                  },
              ],
              textAlign: 'text-left',
          }
        : {
              experience: 'سنة من الخبرة',
              projects: 'مشروع مكتمل',
              eyebrow: 'عن آفاق العمران',
              title: 'نبني مشاريع عقارية بمعايير عالمية',
              description:
                  'في آفاق العمران نؤمن أن نجاح أي مشروع عقاري يبدأ من أساس قوي يجمع بين الأمان القانوني والتخطيط الهندسي والتنفيذ الاحترافي. لهذا نعتمد منهج عمل واضح يبدأ بدراسة الوضع القانوني للعقار، ثم إعداد الدراسات والتصاميم الحديثة، وصولًا إلى التنفيذ بمواد عالية الجودة وتقنيات بناء حديثة.',
              features: [
                  {
                      icon: 'verified',
                      title: 'الجودة',
                      description:
                          'نلتزم بأعلى المعايير لضمان مبانٍ قوية وآمنة تدوم لسنوات.',
                  },
                  {
                      icon: 'lightbulb',
                      title: 'الابتكار',
                      description:
                          'نعتمد أحدث التقنيات الهندسية وحلول المنازل الذكية.',
                  },
                  {
                      icon: 'handshake',
                      title: 'الموثوقية',
                      description:
                          'نبدأ بدراسة قانونية واضحة ونلتزم بالشفافية في كل المراحل.',
                  },
              ],
              textAlign: 'text-right',
          };

    return (
        <section
            className="bg-background-light py-24 dark:bg-background-dark"
            id="about"
            dir={dir}
        >
            <div className="container mx-auto px-6">
                <div className="flex flex-col items-center gap-16 lg:flex-row">
                    <div className="grid grid-cols-2 gap-4 lg:w-1/2">
                        <div className="space-y-4">
                            <img
                                className="aspect-[4/5] rounded-xl object-cover shadow-2xl"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAgzWk4JAUY91y_9_UbOpPbI09sKrrjQK-HAkp-F6yQdxHJ9X5it4-_gcyM5FxOoKQcgwmVcLw_KcFe2v9fKlh5GhiZWTmrY75tQLudqmQg_wZNLAeeDshhtsL0VsfBovC0b7l8Y3b5sKZRBn6oXwoXbU9FqJSYvQLJr4O7iUs50YxzDPc7wEoTYVZsmWsoNOk2qlJSihajMUyOkrimgrAbYwslq7JqrcFnGdNdA0FhRFkk05RDpztmALfnwvaHHfF9rB64s0jDqa22"
                                alt="Construction site detailing quality standards"
                            />
                            <div className="rounded-xl bg-primary p-6 text-white">
                                <p className="text-3xl font-bold">15+</p>
                                <p className="text-sm opacity-80">
                                    {content.experience}
                                </p>
                            </div>
                        </div>
                        <div className="space-y-4 pt-12">
                            <div className="rounded-xl border border-primary/20 bg-primary/10 p-6">
                                <p className="text-3xl font-bold text-primary dark:text-white">
                                    50+
                                </p>
                                <p className="text-sm text-slate-600 dark:text-slate-400">
                                    {content.projects}
                                </p>
                            </div>
                            <img
                                className="aspect-[4/5] rounded-xl object-cover shadow-2xl"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuD9zqMKnscNvQXVqMB2vqaeoC4dZRa2IxUxMCJkZyABqutqzFAWfD3tBUG8NXHeyrBqBZxMiN9qgaVXRbZ405L6aLqxCDAHO83JbNk7Dfrqq19MZcv3Nl9szpX8odXrDtggaLarWqz6DvP53KQcT1O9h3qAN2y4nGh4A7PpexDAN64-XOe52bCkVleqS2kxXSZEh1iXPhMu5raUlSjdK-K1_1EeMYMx2OC60Mnmd1MnmlpHO7pGNFpV0VqH8c6uHYOWFs2A8MqlJ_ZE"
                                alt="Modern interior design project"
                            />
                        </div>
                    </div>
                    <div className="space-y-8 lg:w-1/2">
                        <div className="space-y-4">
                            <h3
                                className={`text-sm font-bold tracking-widest text-primary ${
                                    isEnglish ? 'uppercase' : ''
                                } ${content.textAlign}`}
                            >
                                {content.eyebrow}
                            </h3>
                            <h2
                                className={`text-4xl font-black leading-tight text-slate-900 dark:text-white md:text-5xl ${content.textAlign}`}
                            >
                                {content.title}
                            </h2>
                            <p
                                className={`text-lg leading-relaxed text-slate-600 dark:text-slate-400 ${content.textAlign}`}
                            >
                                {content.description}
                            </p>
                        </div>
                        <div className="grid grid-cols-1 gap-6 md:grid-cols-3">
                            {content.features.map((feature) => (
                                <div
                                    key={feature.title}
                                    className={`space-y-2 ${content.textAlign}`}
                                >
                                    <span className="material-symbols-outlined text-4xl text-primary">
                                        {feature.icon}
                                    </span>
                                    <h4 className="text-lg font-bold">
                                        {feature.title}
                                    </h4>
                                    <p className="text-sm text-slate-500">
                                        {feature.description}
                                    </p>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
