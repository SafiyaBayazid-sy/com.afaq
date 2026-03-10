import { Head } from '@inertiajs/react';
import MainLayout from '../../components/Layouts/MainLayout';
import AboutSummary from './Components/AboutSummary';
import ContactNewsletter from './Components/ContactNewsletter';
import Hero from './Components/Hero';
import ProjectsGrid from './Components/ProjectsGrid';

export default function Home() {
    return (
        <MainLayout>
            <Head title="Home" />
            <Hero />
            <AboutSummary />
            <ProjectsGrid />
            <ContactNewsletter />
        </MainLayout>
    );
}