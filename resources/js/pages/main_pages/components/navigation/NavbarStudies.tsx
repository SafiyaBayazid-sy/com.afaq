import { Link, usePage } from '@inertiajs/react';
import { usePublicLanguage } from '../../hooks/use-public-language';

export default function NavbarStudies() {
    const { url } = usePage();
    const path = url.split('?')[0].split('#')[0];
    const { dir, homeHref, isEnglish, isHomePage, langToggleHref } =
        usePublicLanguage();
    const navItems = [
        {
            href: homeHref,
            label: isEnglish ? 'Home' : 'الرئيسية',
            match: (currentPath: string) => currentPath === '/',
        },
        {
            href: `${homeHref}#projects`,
            label: isEnglish ? 'Projects' : 'مشاريعنا',
            match: (currentPath: string) =>
                currentPath.startsWith('/projects') || currentPath === '/',
        },
        {
            href: '/about',
            label: isEnglish ? 'About' : 'عن الشركة',
            match: (currentPath: string) => currentPath.startsWith('/about'),
        },
        {
            href: '/legal-consultations',
            label: isEnglish ? 'Contact Us' : 'اتصل بنا',
            match: (currentPath: string) =>
                currentPath.startsWith('/legal-consultations'),
        },
    ];

    return (
        <header
            className="sticky top-0 z-50 w-full border-b border-white/10 bg-[#111b1a]/95 backdrop-blur-sm"
            dir={dir}
        >
            <div className="container mx-auto flex items-center justify-between gap-4 px-6 py-4">
                <Link className="flex items-center gap-4 text-white" href={homeHref}>
                    <h2 className="text-lg font-bold tracking-[0.02em] text-white md:text-xl">
                        {isEnglish ? 'Afaq Omran' : 'آفاق العمران'}
                    </h2>
                    <img
                        src="/images/Adobe%20Express%20-%20file.png"
                        alt="Afaq logo"
                        className="h-12 w-auto object-contain md:h-14"
                    />
                </Link>

                <nav className="hidden items-center gap-2 rounded-full border border-white/10 bg-white/[0.03] px-3 py-2 md:flex">
                    {navItems.map((item) => {
                        const isActive = item.match(path);

                        return (
                            <a
                                key={item.href}
                                aria-current={isActive ? 'page' : undefined}
                                className={`rounded-full px-4 py-2 text-sm font-medium transition-all ${
                                    isActive
                                        ? 'bg-[#0f4d45] text-white shadow-[0_10px_30px_rgba(12,107,92,0.18)]'
                                        : 'text-slate-300 hover:bg-white/5 hover:text-white'
                                }`}
                                href={item.href}
                            >
                                {item.label}
                            </a>
                        );
                    })}
                </nav>

                <div className="flex items-center">
                    <Link
                        className="rounded-full border border-[#1b6e61] bg-[#0f4d45] px-5 py-2 text-sm font-bold text-white shadow-[0_10px_30px_rgba(12,107,92,0.18)] transition-all hover:bg-[#11584f] hover:shadow-[0_14px_34px_rgba(12,107,92,0.24)]"
                        href={langToggleHref}
                        preserveScroll={isHomePage}
                    >
                        {isEnglish ? 'العربية' : 'English'}
                    </Link>
                </div>
            </div>
        </header>
    );
}
