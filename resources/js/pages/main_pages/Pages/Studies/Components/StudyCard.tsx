import React from 'react';

interface StudyCardProps {
    badge: string;
    imageUrl: string;
    title: string;
    description: string;
    date: string;
}

export default function StudyCard({ badge, imageUrl, title, description, date }: StudyCardProps) {
    return (
        <div className="group bg-white dark:bg-primary/5 rounded-xl overflow-hidden border border-primary/10 hover:border-primary/30 transition-all shadow-sm hover:shadow-xl">
            <div className="h-56 w-full overflow-hidden relative">
                <div className="absolute top-4 right-4 bg-primary text-white text-xs font-bold px-3 py-1 rounded-full z-10">
                    {badge}
                </div>
                <img 
                    src={imageUrl}
                    alt={title}
                    className="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                />
            </div>
            
            <div className="p-6">
                <h3 className="text-xl font-bold mb-3 group-hover:text-primary transition-colors">
                    {title}
                </h3>
                <p className="text-slate-600 dark:text-slate-400 text-sm mb-6 leading-relaxed">
                    {description}
                </p>
                
                <div className="flex items-center justify-between">
                    <span className="text-xs text-slate-400 flex items-center gap-1">
                        <span className="material-symbols-outlined text-sm">calendar_today</span>
                        {date}
                    </span>
                    <button className="text-primary font-bold text-sm flex items-center gap-1">
                        قراءة المزيد
                        <span className="material-symbols-outlined text-sm">arrow_back</span>
                    </button>
                </div>
            </div>
        </div>
    );
}