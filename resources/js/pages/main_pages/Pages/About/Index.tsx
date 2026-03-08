import MainLayout from '../../components/Layouts/MainLayout';
import CTA from './Components/CTA';
import Hero from './Components/Hero';
import LeadershipTeam from './Components/LeadershipTeam';
import Story from './Components/Story';
import VisionMission from './Components/VisionMission';


export default function About() {
    return (
        <MainLayout>

<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&amp;family=Noto+Sans+Arabic:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>


            <Hero />
            <Story />
            <VisionMission />
            <LeadershipTeam />
            <CTA />
        </MainLayout>

    );
}
