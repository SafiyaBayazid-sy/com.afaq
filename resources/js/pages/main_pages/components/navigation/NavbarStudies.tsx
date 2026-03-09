import { Link } from '@inertiajs/react';
import React from 'react';

export default function NavbarStudies() {
    return (
        <header className="sticky top-0 z-50 w-full border-b border-primary/20 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md px-6 lg:px-20 py-4">
            <div className="max-w-7xl mx-auto flex items-center justify-between">
                <div className="flex items-center gap-10">
                    <div className="flex items-center gap-3">
                        <div className="size-8 bg-primary rounded-lg flex items-center justify-center text-white">
                            <span className="material-symbols-outlined text-2xl">architecture</span>
                        </div>
                        <h2 className="text-xl font-bold tracking-tight">آفاق العمران</h2>
                    </div>
                    
                    <nav className="hidden md:flex items-center gap-8">
                        <Link href="/" className="text-sm font-medium hover:text-primary transition-colors">
                            الرئيسية
                        </Link>
                        <Link href="/projects" className="text-sm font-medium hover:text-primary transition-colors">
                            المشاريع
                        </Link>
                        <Link href="/studies" className="text-sm font-medium text-primary border-b-2 border-primary">
                            الدراسات والبحوث
                        </Link>
                        <Link href="/about" className="text-sm font-medium hover:text-primary transition-colors">
                            من نحن
                        </Link>
                        <Link href="/contact" className="text-sm font-medium hover:text-primary transition-colors">
                            اتصل بنا
                        </Link>
                    </nav>
                </div>
                
                <div className="flex items-center gap-4">
                    <div className="relative hidden sm:block">
                        <span className="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">
                            search
                        </span>
                        <input 
                            className="bg-primary/10 border-none rounded-lg pr-10 pl-4 py-2 text-sm focus:ring-2 focus:ring-primary w-64" 
                            placeholder="بحث في البحوث..." 
                            type="text"
                        />
                    </div>
                    <div className="size-10 rounded-full bg-primary/20 flex items-center justify-center border border-primary/30">
                        <span className="material-symbols-outlined text-primary">person</span>
                    </div>
                </div>
            </div>
        </header>
    );
}