import { Head } from '@inertiajs/react';
import React from 'react';
import MainLayout from '../../components/Layouts/MainLayout';
import Hero from './Components/Hero';
import LatestStudies from './Components/LatestStudies';
import ResearchPapers from './Components/ResearchPapers';

export default function Studies() {
    return (
        <>
            <Head title="الدراسات والبحوث - آفاق العمران" />

            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0,1" />
            <MainLayout>
                <Hero />
                <LatestStudies />
                <ResearchPapers />
            </MainLayout>
        </>
    );
}