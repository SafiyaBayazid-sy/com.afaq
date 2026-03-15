interface VisionMissionItem {
    icon: string;
    title: string;
    description: string;
}

export default function VisionMission() {
    const items: VisionMissionItem[] = [
        {
            icon: 'visibility',
            title: 'رؤيتنا',
            description: 'أن نكون الشريك المفضل والأول في قطاع التشييد والبناء، من خلال تقديم حلول ذكية ومستدامة تشكل مستقبل العمارة في المنطقة.'
        },
        {
            icon: 'track_changes',
            title: 'رسالتنا',
            description: 'الالتزام بتنفيذ مشاريعنا بأعلى معايير الجودة والسلامة، مع التركيز على الابتكار الهندسي وتطوير الكوادر الوطنية لخدمة المجتمع.'
        },
        {
            icon: 'diamond',
            title: 'قيمنا',
            description: 'النزاهة في التعامل، الجودة في التنفيذ، الالتزام بالمواعيد، والمسؤولية تجاه البيئة والمجتمع هي الركائز التي نقوم عليها.'
        }
    ];

    return (
        <section className="bg-primary/5 dark:bg-primary/10 py-20">
            <div className="max-w-[1200px] mx-auto px-6 lg:px-40">
                <div className="text-center mb-16">
                    <h2 className="text-3xl font-bold text-slate-900 dark:text-white mb-4">هويتنا ومبادئنا</h2>
                    <div className="w-20 h-1 bg-primary mx-auto"></div>
                </div>
                <div className="grid md:grid-cols-3 gap-8">
                    {items.map((item, index) => (
                        <div key={index} className="bg-white dark:bg-background-dark p-8 rounded-xl border border-primary/10 shadow-sm hover:shadow-md transition-shadow">
                            <div className="bg-primary/10 w-16 h-16 rounded-lg flex items-center justify-center mb-6">
                                <span className="material-symbols-outlined text-primary text-3xl">{item.icon}</span>
                            </div>
                            <h3 className="text-xl font-bold text-slate-900 dark:text-white mb-3">{item.title}</h3>
                            <p className="text-slate-600 dark:text-slate-400 leading-relaxed">
                                {item.description}
                            </p>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
}
