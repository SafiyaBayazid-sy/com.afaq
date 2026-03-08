import { ReactNode } from 'react';
import Footer from '@/pages/main_pages/components/navigation/Footer';
import Navbar from '@/pages/main_pages/components/navigation/Navbar';
interface MainLayoutProps {
    children: ReactNode;
}

export default function MainLayout({ children }: MainLayoutProps) {
    return (
        <div className="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 antialiased">
           
            <Navbar />
            <main className="flex-1">
                {children}
            </main>
            <Footer />
            </div>
    );
}
