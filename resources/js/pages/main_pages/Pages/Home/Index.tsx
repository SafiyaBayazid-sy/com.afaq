// resources/js/main_pages/Pages/Home/Index.tsx
import { Head } from '@inertiajs/react';
import MainLayout from '../../components/Layouts/MainLayout';
import TailwindConfig from '../../components/TailwindConfig';
import AboutSummary from './Components/AboutSummary';
import ContactNewsletter from './Components/ContactNewsletter';
import Hero from './Components/Hero';
import ProjectsGrid from './Components/ProjectsGrid';

// default export required for Inertia
export default function Home() {
    return (
        <MainLayout>
            <TailwindConfig>
                <Head title="Home" />
                <div className="min-h-screen bg-background-dark">
                    <Hero />
                    <AboutSummary />
                    <ProjectsGrid />
                    <ContactNewsletter />
                </div>
            </TailwindConfig>
        </MainLayout>
    );
}
