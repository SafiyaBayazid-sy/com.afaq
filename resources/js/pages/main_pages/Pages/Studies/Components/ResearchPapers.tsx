import React from 'react';
import ResearchPaperCard from './ResearchPaperCard';

export default function ResearchPapers() {
    const papers = [
        {
            title: "تقرير الابتكار والتكنولوجيا 2024",
            date: "مارس 2024",
            size: "4.2 MB"
        },
        {
            title: "معايير التصميم الحضري المعاصر",
            date: "فبراير 2024",
            size: "8.7 MB"
        },
        {
            title: "دليل كفاءة الطاقة في المباني",
            date: "يناير 2024",
            size: "5.1 MB"
        },
        {
            title: "مستقبل التطوير العقاري الذكي",
            date: "ديسمبر 2023",
            size: "12.4 MB"
        }
    ];

    return (
        <section className="py-16 bg-primary/5 border-y border-primary/10 px-6 lg:px-20">
            <div className="max-w-7xl mx-auto">
                <div className="flex items-center gap-3 mb-10">
                    <span className="material-symbols-outlined text-primary text-3xl">download</span>
                    <h2 className="text-2xl md:text-3xl font-bold">أوراق بحثية قابلة للتحميل</h2>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {papers.map((paper, index) => (
                        <ResearchPaperCard key={index} {...paper} />
                    ))}
                </div>
            </div>
        </section>
    );
}