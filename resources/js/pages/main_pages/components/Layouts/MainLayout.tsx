import { usePage } from '@inertiajs/react';
import type { ReactNode } from 'react';
import Footer from '../navigation/Footer';
import Navbar from '../navigation/Navbar';
import NavbarStudies from '../navigation/NavbarStudies';
import TailwindConfig from '../TailwindConfig';

interface MainLayoutProps {
    children: ReactNode;
}

export default function MainLayout({ children }: MainLayoutProps) {
    const { url } = usePage();
    const isStudiesPage = url.startsWith('/studies');

    return (
        <TailwindConfig>
            <div
                className="relative flex min-h-screen w-full flex-col overflow-x-hidden bg-background-dark text-slate-900 dark:text-slate-100 font-display antialiased"
                style={{ backgroundColor: '#12201e', direction: 'rtl' }}
            >
                {isStudiesPage ? <NavbarStudies /> : <Navbar />}
                <main className="flex-1 w-full">{children}</main>
                <Footer />
            </div>
        </TailwindConfig>
    );
}
