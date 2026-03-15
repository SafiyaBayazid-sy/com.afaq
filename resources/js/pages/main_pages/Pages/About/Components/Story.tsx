export default function Story() {
    return (
        <section className="py-20">
            <div className="container mx-auto px-6">
            <div className="grid lg:grid-cols-2 gap-16 items-center">
                <div className="space-y-6">
                    <div className="inline-flex items-center gap-2 text-primary font-bold tracking-wider uppercase text-sm">
                        <span className="w-8 h-[2px] bg-primary"></span>
                        قصتنا ومسيرتنا
                    </div>
                    <h2 className="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white">
                        عقدان من التميز في سماء المقاولات
                    </h2>
                    <p className="text-slate-600 dark:text-slate-400 text-lg leading-relaxed">
                        بدأت رحلة آفاق العمران كفكرة طموحة لتحويل المشهد العمراني في المنطقة. على مر السنين، تطورنا من مكتب هندسي صغير إلى شركة مقاولات رائدة تنفذ أضخم المشاريع الحيوية والسكنية.
                    </p>
                    <p className="text-slate-600 dark:text-slate-400 text-lg leading-relaxed">
                        نفتخر بسجلنا الحافل بالإنجازات الذي يضم أكثر من 500 مشروع ناجح، حيث نضع الجودة والابتكار في قلب كل حجر نضعه.
                    </p>
                    <div className="grid grid-cols-2 gap-8 pt-6">
                        <div className="border-r-4 border-primary pr-4">
                            <div className="text-3xl font-black text-primary">+500</div>
                            <div className="text-sm text-slate-500 dark:text-slate-400">مشروع مكتمل</div>
                        </div>
                        <div className="border-r-4 border-primary pr-4">
                            <div className="text-3xl font-black text-primary">+150</div>
                            <div className="text-sm text-slate-500 dark:text-slate-400">خبير ومهندس</div>
                        </div>
                    </div>
                </div>
                <div className="relative">
                    <div className="aspect-square rounded-2xl overflow-hidden shadow-2xl">
                        <img
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuA4OKaGt_wYAQdCB0HUXVTj09qLNZMp_he3yOZUOR40fetlAFvpAO29no5dJSktJSzwRddMhb1YFG5GRUlMwUY-83QEZDd85U8Uqz2q7mlTM_jMVbwoLNTgJ-hEwVoW1HDqczzCxW9a43dT61M0sTeMo9gFKz8qOgUu9JeWv0K7VTLzdn_fXJstm-gaAakgvJHkfqe-an16BPVEYT4T0iVl2Gjf1ymDUDM_Oo-JNFBpEa26vkxZOkmg0eloks8wNBxZlsSje8k3gXTU"
                            alt="Construction site with engineers discussing blueprints"
                            className="w-full h-full object-cover"
                        />
                    </div>
                    <div className="absolute -bottom-6 -right-6 bg-primary p-8 rounded-2xl text-white hidden md:block">
                        <div className="text-4xl font-bold">18</div>
                        <div className="text-sm opacity-80 uppercase tracking-widest">عاماً من الخبرة</div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    );
}
