interface VisionMissionItem {
    icon: string;
    title: string;
    description: string;
}

const items: VisionMissionItem[] = [
    {
        icon: 'visibility',
        title: 'رؤيتنا',
        description:
            'أن نكون من الشركات الرائدة في تطوير وتنفيذ المشاريع العقارية في سوريا من خلال تقديم حلول هندسية حديثة تعتمد على التقنيات المتطورة والمعايير العالمية في البناء.',
    },
    {
        icon: 'track_changes',
        title: 'رسالتنا',
        description:
            'نهدف إلى تقديم مشاريع عقارية آمنة ومستدامة من خلال الجمع بين الدراسة القانونية الدقيقة والتخطيط الهندسي المتطور والتنفيذ الاحترافي لضمان حماية استثمارات عملائنا.',
    },
    {
        icon: 'diamond',
        title: 'قيمنا',
        description:
            'الأمان القانوني، الجودة الهندسية، الشفافية، الابتكار، والاستدامة هي المبادئ التي نعتمد عليها في كل مشروع.',
    },
];

export default function VisionMission() {
    return (
        <section className="bg-primary/5 py-20 dark:bg-primary/10" dir="rtl">
            <div className="container mx-auto px-6">
                <div className="mb-16 text-center">
                    <h2 className="mb-4 text-3xl font-bold text-slate-900 dark:text-white">هويتنا ومبادئنا</h2>
                    <div className="mx-auto h-1 w-20 bg-primary"></div>
                </div>
                <div className="grid gap-8 md:grid-cols-3">
                    {items.map((item) => (
                        <div key={item.title} className="p-4 text-right">
                            <div className="mb-6 flex h-16 w-16 items-center justify-center rounded-lg bg-primary/10">
                                <span className="material-symbols-outlined text-3xl text-primary">{item.icon}</span>
                            </div>
                            <h3 className="mb-3 text-xl font-bold text-slate-900 dark:text-white">{item.title}</h3>
                            <p className="leading-relaxed text-slate-600 dark:text-slate-400">{item.description}</p>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
}
