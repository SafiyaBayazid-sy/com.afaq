export default function Story() {
    return (
        <section className="py-20" dir="rtl">
            <div className="container mx-auto px-6">
                <div className="grid items-center gap-16 lg:grid-cols-2">
                    <div className="space-y-6 text-right">
                        <div className="inline-flex items-center gap-2 text-sm font-bold tracking-wider text-primary uppercase">
                            <span className="h-[2px] w-8 bg-primary"></span>
                            عقدان من الخبرة في تنفيذ المشاريع
                        </div>
                        <h2 className="text-3xl font-bold text-slate-900 dark:text-white md:text-4xl">
                            إدارة متكاملة للمشروع من التحقق القانوني حتى التسليم
                        </h2>
                        <p className="text-lg leading-relaxed text-slate-600 dark:text-slate-400">
                            منذ تأسيسها، عملت آفاق العمران على تطوير منهج عمل متكامل يجمع بين الدراسة القانونية، والتخطيط الهندسي، والتنفيذ الاحترافي،
                            وإدارة المشروع بشكل كامل. نحن لا نقدم خدمة بناء فقط، بل نقدم إدارة متكاملة للمشروع العقاري من البداية حتى التسليم.
                        </p>
                        <p className="text-lg leading-relaxed text-slate-600 dark:text-slate-400">
                            خدماتنا موجهة بشكل خاص إلى المغتربين السوريين الذين يرغبون في بناء منزل حديث، أو ترميم منازلهم المتضررة، أو تطوير عقار
                            قائم، أو تنفيذ مشروع استثماري عقاري بثقة وشفافية كاملة.
                        </p>
                        <div className="grid grid-cols-2 gap-8 pt-6">
                            <div className="border-r-4 border-primary pr-4">
                                <div className="text-3xl font-black text-primary">+50</div>
                                <div className="text-sm text-slate-500 dark:text-slate-400">مشروع مكتمل</div>
                            </div>
                            <div className="border-r-4 border-primary pr-4">
                                <div className="text-3xl font-black text-primary">+15</div>
                                <div className="text-sm text-slate-500 dark:text-slate-400">سنة من الخبرة</div>
                            </div>
                        </div>
                    </div>

                    <div className="relative">
                        <div className="aspect-square overflow-hidden rounded-2xl shadow-2xl">
                            <img
                                alt="Engineering team reviewing architectural plans"
                                className="h-full w-full object-cover"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuA4OKaGt_wYAQdCB0HUXVTj09qLNZMp_he3yOZUOR40fetlAFvpAO29no5dJSktJSzwRddMhb1YFG5GRUlMwUY-83QEZDd85U8Uqz2q7mlTM_jMVbwoLNTgJ-hEwVoW1HDqczzCxW9a43dT61M0sTeMo9gFKz8qOgUu9JeWv0K7VTLzdn_fXJstm-gaAakgvJHkfqe-an16BPVEYT4T0iVl2Gjf1ymDUDM_Oo-JNFBpEa26vkxZOkmg0eloks8wNBxZlsSje8k3gXTU"
                            />
                        </div>
                        <div className="absolute -bottom-6 -right-6 hidden rounded-2xl bg-primary p-8 text-white md:block">
                            <div className="text-4xl font-bold">20</div>
                            <div className="text-sm tracking-widest opacity-80 uppercase">عامًا من الخبرة</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
