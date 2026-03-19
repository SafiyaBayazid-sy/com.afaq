import { usePage } from '@inertiajs/react';
import type { CSSProperties, ReactNode } from 'react';
import Footer from '../navigation/Footer';
import Navbar from '../navigation/Navbar';
import NavbarStudies from '../navigation/NavbarStudies';
import PublicEmailCapture from '../PublicEmailCapture';

interface MainLayoutProps {
    children: ReactNode;
}

export default function MainLayout({ children }: MainLayoutProps) {
    const { url } = usePage();
    const isStudiesPage = url.startsWith('/studies');
    const publicTheme = {
        '--background': '#10201d',
        '--background-light': '#f6f8f8',
        '--background-dark': '#10201d',
        '--foreground': '#f8fafc',
        '--card': '#162522',
        '--card-foreground': '#f8fafc',
        '--popover': '#162522',
        '--popover-foreground': '#f8fafc',
        '--primary': '#0d4c43',
        '--primary-foreground': '#f8fafc',
        '--secondary': '#16312d',
        '--secondary-foreground': '#f8fafc',
        '--muted': '#16312d',
        '--muted-foreground': '#94a3b8',
        '--accent': '#16312d',
        '--accent-foreground': '#f8fafc',
        '--border': 'rgba(255, 255, 255, 0.12)',
        '--input': 'rgba(255, 255, 255, 0.12)',
        '--ring': 'rgba(255, 255, 255, 0.18)',
    } as CSSProperties;

    return (
        <div
            className="dark relative flex min-h-screen w-full flex-col overflow-x-hidden bg-background-dark font-display text-slate-100 antialiased"
            dir="rtl"
            style={{
                ...publicTheme,
                backgroundImage:
                    'radial-gradient(circle at top, rgba(15, 93, 81, 0.12), transparent 28%), linear-gradient(180deg, #10201d 0%, #0f1b19 100%)',
            }}
        >
            {isStudiesPage ? <NavbarStudies /> : <Navbar />}
            <main className="relative z-10 w-full flex-1">{children}</main>
            <PublicEmailCapture />
            <Footer />
        </div>
    );
}
