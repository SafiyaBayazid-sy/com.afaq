import { Head } from '@inertiajs/react';
import { usePublicLanguage } from '../../hooks/use-public-language';
import MainLayout from '../../components/Layouts/MainLayout';
import AboutSummary from './Components/AboutSummary';
import Hero from './Components/Hero';
import ProjectsGrid from './Components/ProjectsGrid';

export default function Home() {
    const { isEnglish } = usePublicLanguage();

    return (
        <MainLayout>
            <Head title={isEnglish ? 'Home' : 'الرئيسية'} />
            <Hero />
            <AboutSummary />
            <ProjectsGrid />
        </MainLayout>
    );
}
