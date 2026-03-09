import React from 'react';

interface ResearchPaperCardProps {
    title: string;
    date: string;
    size: string;
}

export default function ResearchPaperCard({ title, date, size }: ResearchPaperCardProps) {
    return (
        <div className="flex items-center justify-between p-6 bg-white dark:bg-background-dark border border-primary/10 rounded-xl hover:shadow-md transition-shadow">
            <div className="flex items-center gap-4">
                <div className="size-12 rounded-lg bg-red-100 dark:bg-red-900/20 flex items-center justify-center text-red-600">
                    <span className="material-symbols-outlined text-3xl">picture_as_pdf</span>
                </div>
                <div>
                    <h4 className="font-bold text-lg">{title}</h4>
                    <p className="text-sm text-slate-500">PDF • {size} • نُشر في {date}</p>
                </div>
            </div>
            <button className="bg-primary text-white p-2 rounded-lg hover:opacity-90 transition-opacity">
                <span className="material-symbols-outlined">download</span>
            </button>
        </div>
    );
}