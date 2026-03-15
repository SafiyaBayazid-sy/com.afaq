interface TeamMember {
    name: string;
    position: string;
    image: string;
}

const team: TeamMember[] = [
    {
        name: 'م. خالد القحطاني',
        position: 'الرئيس التنفيذي',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuC93BDEXHW-n7q_MZCR2_5ZV2gX_dcy1rzb_r9rMRgyz4AqLd_tPE1q_p9qxzXQ1qWmcfYEOri5BXvcg6iJcsSJukzfiX54umpYx2leEXS-Db1mwqeeUmzRX7OV-a5uWX6SNuHLehdZv1kWAARQ9XvYz5TCEPuS3B1fbXluweCeSzKQg0nrJyxtnUi9_nFWiuaDSnUulVS9-XoWZ20yJwW7g9kH4UMbY_ahD4mrA0o33phYVRFKDrwTbXHTsWJIcYNDm0VJrVzoGWiY'
    },
    {
        name: 'م. سارة المهنا',
        position: 'مديرة العمليات الهندسية',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuD6Oca7tliTCxXRjmJgYV4MYY-ZDQ3oD4zUXk4gCWMg9w0k7b-apjKnDUvvDQFsfpScCTYcePVmcFEWk-RReqdbsJnaRaHRZdS17a2WeJL_Olk9lHONtYmLr5yNBlcVZvAo7T6MFnHDQnf0VHeyHYUVUa0-D72rBIf28XDBGIVfTXvJgXGFU4vYVRW2d1p0muxvpCvRmgCeDMxocbmwWoj_Efn0i5RBsBtG9kkWxvaXwhgDk_AfcaCZGkdJXMTCvhOKP1-Ig7pfyJas'
    },
    {
        name: 'م. عمر الزهراني',
        position: 'كبير المهندسين المعماريين',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBJJ0tMR9XDScE6IIqjpju0E_clCz9QKLqu-gNtO-L9BBWB4ybbkDZHDr34l3ASpwQM7LuMocGCgc866Za7rZez9LIcDiXlntseXT6-QIghe43D-AhsxQHlhh6JSCRsQUCsltEhRS8hdU1KIhjT_izcsTWUreFdVGe45Sjeogpf6Toy-o1ZFmPE3QCRI3iPgEUE1JeJegHWvD0K7JhQa8ViUuKiR7B1XQaB455P8b9VDYa3VJib2JMNS890GsK6Jn1Mb-K-heIaAyHH'
    },
    {
        name: 'أ. فهد التميمي',
        position: 'مدير الشؤون المالية',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCV2E0IzBeLK-6BRFX4V1OpyMay3E7bP-6HwqCAvQIwT9EtvpNytTU29dEvOM14DhROg6XM3DaFbP8SxZnPu5I4NMrGZwX4EaE6x2GYHI27hFVZsk5iF35ySzbr1B0OeVU4EAoNZ_8nGxeBvG_yRdrCENbgrBv-0u9NKbA916-oXOGbqOUea0QuDZ12tzKu-VLZ0FAve2nkFgeIJczOE7147xe0rcgycDX1rlW8HVQ24NCwsP9QBDA2tdAthdbuT1Dd-Ox7kXBOsK-j'
    }
];

export default function LeadershipTeam() {
    return (
        <section className="py-20 max-w-[1200px] mx-auto px-6 lg:px-40">
            <div className="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div className="max-w-xl">
                    <h2 className="text-3xl font-bold text-slate-900 dark:text-white mb-4">فريق القيادة</h2>
                    <p className="text-slate-600 dark:text-slate-400">
                        نخبة من المهندسين والإداريين ذوي الخبرة الطويلة يقودون آفاق العمران نحو آفاق جديدة من النجاح.
                    </p>
                </div>
                <div className="hidden md:block">
                    <button className="flex items-center gap-2 text-primary font-bold group">
                        عرض الهيكل التنظيمي
                        <span className="material-symbols-outlined group-hover:translate-x-[-4px] transition-transform">
                            arrow_back
                        </span>
                    </button>
                </div>
            </div>
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                {team.map((member, index) => (
                    <div key={index} className="group">
                        <div className="aspect-[3/4] rounded-xl overflow-hidden mb-4 relative">
                            <img
                                src={member.image}
                                alt={member.name}
                                className="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500"
                            />
                            <div className="absolute inset-0 bg-gradient-to-t from-primary/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
                                <div className="flex gap-3">
                                    <a href="#" className="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/40 transition-colors">
                                        <span className="material-symbols-outlined text-white text-sm">link</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <h3 className="text-lg font-bold text-slate-900 dark:text-white">{member.name}</h3>
                        <p className="text-primary font-medium text-sm">{member.position}</p>
                    </div>
                ))}
            </div>
        </section>
    );
}
