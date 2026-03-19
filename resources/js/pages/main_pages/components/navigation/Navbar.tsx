import { Link, usePage } from '@inertiajs/react';
import BrandMark from './BrandMark';

const navItems = [
    { href: '/', label: 'الرئيسية', match: (path: string) => path === '/' },
    { href: '/#projects', label: 'مشاريعنا', match: (path: string) => path.startsWith('/projects') || path === '/' },
    { href: '/about', label: 'عن الشركة', match: (path: string) => path.startsWith('/about') },
    { href: '/legal-consultations', label: 'اتصل بنا', match: (path: string) => path.startsWith('/legal-consultations') },
];

export default function Navbar() {
    const { url } = usePage();
    const path = url.split('?')[0].split('#')[0];

    return (
        <header className="sticky top-0 z-50 w-full border-b border-white/8 bg-[#111b1a]">
            <div className="container mx-auto flex items-center justify-between px-6 py-3.5">
                <Link className="flex items-center gap-3 text-white" href="/">
                    <h2 className="text-xl font-bold tracking-tight text-white">آفاق العمران</h2>
                    <BrandMark />
                </Link>

                <nav className="hidden items-center gap-8 md:flex">
                    {navItems.map((item) => {
                        const isActive = item.match(path);

                        return (
                            <a
                                key={item.href}
                                aria-current={isActive ? 'page' : undefined}
                                className={`relative pb-2 text-sm font-medium transition-colors ${
                                    isActive ? 'text-white' : 'text-slate-300 hover:text-white'
                                }`}
                                href={item.href}
                            >
                                {item.label}
                                <span
                                    className={`absolute inset-x-0 -bottom-0.5 h-px bg-[#0c6b5c] transition-opacity ${
                                        isActive ? 'opacity-100' : 'opacity-0'
                                    }`}
                                />
                            </a>
                        );
                    })}
                </nav>

                <div className="flex items-center gap-3">
                    <div className="size-8 overflow-hidden rounded-full border border-white/20">
                        <img
                            alt="Profile"
                            className="h-full w-full object-cover"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuC93w3iUBmnpjlY9XbF3FyrERffuyGUlVEf7C8YuA2gA8CDJ0MQqoVlyOKLYOJS9YDYxC_kus6inLQgcSPT8GTA6n1WA9QIK5VMZedyBqrFuccZ6cCyXJYH92JKmGx2OTcKVMBLgH1alzZB5coidtvxl2C-4yzw7v4xb095f_rqaXtd1mpFq6gAdrZ6xnPS0ApdwUrkPC7eoinWxR1jVTb54b-goSKaNRf2LRvt7tYvgNtRYfTudtQRzr0XolDu5S8Cj-oUQ2J0bohq"
                        />
                    </div>
                    <button className="rounded-lg border border-[#14554b] bg-[#0f4d45] px-4 py-1.5 text-sm font-bold text-white transition-colors hover:bg-[#11584f]">
                        English
                    </button>
                </div>
            </div>
        </header>
    );
}
