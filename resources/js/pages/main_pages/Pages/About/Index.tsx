import { Head } from '@inertiajs/react';
import MainLayout from '../../components/Layouts/MainLayout';
import CTA from './Components/CTA';
import Hero from './Components/Hero';
import LeadershipTeam from './Components/LeadershipTeam';
import Story from './Components/Story';
import VisionMission from './Components/VisionMission';


export default function About() {
    return (
        <MainLayout>
            <Head title="من نحن" />
            <Hero />
            <Story />
            <VisionMission />
            <LeadershipTeam />
            <CTA />
        </MainLayout>

    );
}
