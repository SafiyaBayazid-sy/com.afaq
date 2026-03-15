import { Link } from '@inertiajs/react';
import { useState } from 'react';


export default function Navbar() {
    const [isMenuOpen, setIsMenuOpen] = useState<boolean>(false);

    return (
        <header className="sticky top-0 z-50 w-full border-b border-primary/20 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md px-6 lg:px-40 py-4">
          
            <div className="max-w-[1200px] mx-auto flex items-center justify-between">
                {/* Logo */}
                <div className="flex items-center gap-3">
                    <div className="bg-primary p-2 rounded-lg">
                        <svg className="size-6 text-white" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 6H42L36 24L42 42H6L12 24L6 6Z" fill="currentColor" />
                        </svg>
                    </div>
                    <h2 className="text-primary dark:text-white text-xl font-bold tracking-tight">آفاق العمران</h2>
                </div>

                {/* Desktop Navigation */}
                <nav className="hidden md:flex items-center gap-10">
                    <Link href="/" className="text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-white transition-colors text-sm font-medium">
                        الرئيسية
                    </Link>
                    <Link href="/about" className="text-primary dark:text-white border-b-2 border-primary font-bold text-sm">
                        من نحن
                    </Link>
                    <Link href="/services" className="text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-white transition-colors text-sm font-medium">
                        خدماتنا
                    </Link>
                    <Link href="/projects" className="text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-white transition-colors text-sm font-medium">
                        مشاريعنا
                    </Link>
                    <Link href="/studies" className="text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-white transition-colors text-sm font-medium">
                        الدراسات والبحوث
                    </Link>
                    <Link href="/contact" className="text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-white transition-colors text-sm font-medium">
                        اتصل بنا
                    </Link>
                </nav>

                {/* CTA Button */}
                <button className="bg-primary text-white px-6 py-2 rounded-lg text-sm font-bold hover:bg-opacity-90 transition-all">
                    اطلب استشارة
                </button>

                {/* Mobile Menu Button */}
                <button
                    onClick={() => setIsMenuOpen(!isMenuOpen)}
                    className="md:hidden p-2 text-primary"
                >
                    <span className="material-symbols-outlined">
                        {isMenuOpen ? 'close' : 'menu'}
                    </span>
                </button>
            </div>

            {/* Mobile Navigation */}
            {isMenuOpen && (
                <nav className="md:hidden mt-4 pb-4 flex flex-col gap-4">
                    <Link href="/" className="text-slate-600 dark:text-slate-300 py-2">الرئيسية</Link>
                    <Link href="/about" className="text-primary font-bold py-2">من نحن</Link>
                    <Link href="/services" className="text-slate-600 dark:text-slate-300 py-2">خدماتنا</Link>
                    <Link href="/projects" className="text-slate-600 dark:text-slate-300 py-2">مشاريعنا</Link>
                    <Link href="/contact" className="text-slate-600 dark:text-slate-300 py-2">اتصل بنا</Link>
                </nav>
            )}
        </header>
    );
}
