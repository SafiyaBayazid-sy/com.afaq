import { Head } from '@inertiajs/react';
import MainLayout from '../../components/Layouts/MainLayout';
import TailwindConfig from '../../components/TailwindConfig';
import CTA from './Components/CTA';
import Hero from './Components/Hero';
import LeadershipTeam from './Components/LeadershipTeam';
import Story from './Components/Story';
import VisionMission from './Components/VisionMission';


export default function About() {
    return (
        <MainLayout>
            <TailwindConfig>
                <Head title="About" />

                <Hero />
            <Story />
            <VisionMission />
            <LeadershipTeam />
            <CTA />
            </TailwindConfig>
        </MainLayout>

    );
}
