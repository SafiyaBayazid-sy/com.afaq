import { ReactNode } from 'react';
import Footer from '../navigation/Footer'; 
import Navbar from '../navigation/Navbar';
import TailwindConfig from '../TailwindConfig';
 // Adjust path

interface MainLayoutProps {
    children: ReactNode;
}

export default function MainLayout({ children }: MainLayoutProps) {
    return (
        <TailwindConfig>
            {/* We add a hardcoded background color style as a fallback to prevent the white flash */}
            <div 
                className="relative flex min-h-screen w-full flex-col overflow-x-hidden bg-background-dark text-slate-900 dark:text-slate-100 font-display antialiased"
                style={{ backgroundColor: '#12201e' }} 
            >
                <Navbar />
                <main className="flex-1 w-full">
                    {children}
                </main>
                <Footer />
            </div>
        </TailwindConfig>
    );
}