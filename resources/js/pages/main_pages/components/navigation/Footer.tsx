import { Link } from '@inertiajs/react';
import BrandMark from './BrandMark';

export default function Footer() {
    return (
        <footer className="border-t border-primary/20 bg-background-dark pb-10 pt-20" dir="rtl">
            <div className="container mx-auto px-6">
                <div className="mb-16 grid grid-cols-1 gap-12 md:grid-cols-2 lg:grid-cols-4">
                    <div className="space-y-6">
                        <div className="flex items-center gap-3 text-white">
                            <BrandMark />
                            <h2 className="text-xl font-bold text-white">آفاق العمران</h2>
                        </div>
                        <p className="text-sm leading-relaxed text-slate-400">
                            شركة متخصصة في التطوير والتنفيذ العقاري تقدم حلولًا متكاملة تشمل الدراسة القانونية للعقارات، والتصميم الهندسي الحديث، وتنفيذ
                            المشاريع وفق معايير عالمية، وبناء المنازل الذكية، وترميم وإعادة تأهيل المباني المتضررة.
                        </p>
                        <p className="text-sm leading-relaxed text-slate-400">
                            نهدف إلى مساعدة المغتربين والمستثمرين على تنفيذ مشاريعهم العقارية بأمان وثقة حتى لو كانوا خارج البلد.
                        </p>
                        <div className="flex gap-4">
                            <a
                                className="flex size-10 items-center justify-center rounded-full border border-primary/40 bg-primary/20 text-white transition-colors hover:bg-primary"
                                href="mailto:info@afaqomran.com"
                            >
                                <span className="material-symbols-outlined text-sm">mail</span>
                            </a>
                            <a
                                className="flex size-10 items-center justify-center rounded-full border border-primary/40 bg-primary/20 text-white transition-colors hover:bg-primary"
                                href="tel:+9669200123456"
                            >
                                <span className="material-symbols-outlined text-sm">call</span>
                            </a>
                        </div>
                    </div>

                    <div className="space-y-6">
                        <h4 className="font-bold text-white">روابط سريعة</h4>
                        <ul className="space-y-4 text-sm text-slate-400">
                            <li><Link className="transition-colors hover:text-white" href="/">الرئيسية</Link></li>
                            <li><Link className="transition-colors hover:text-white" href="/about">عن آفاق العمران</Link></li>
                            <li><Link className="transition-colors hover:text-white" href="/projects">مشاريعنا</Link></li>
                            <li><Link className="transition-colors hover:text-white" href="/studies">الدراسات والبحوث</Link></li>
                        </ul>
                    </div>

                    <div className="space-y-6">
                        <h4 className="font-bold text-white">خدماتنا</h4>
                        <ul className="space-y-4 text-sm text-slate-400">
                            <li><Link className="transition-colors hover:text-white" href="/building-strengthening">الهندسة الإنشائية</Link></li>
                            <li><Link className="transition-colors hover:text-white" href="/legal-consultations">الاستشارات القانونية</Link></li>
                            <li><Link className="transition-colors hover:text-white" href="/studies">الدراسات والبحوث</Link></li>
                            <li><a className="transition-colors hover:text-white" href="#contact">نموذج البريد الموحد</a></li>
                        </ul>
                    </div>

                    <div className="space-y-6">
                        <h4 className="font-bold text-white">الموقع</h4>
                        <div className="h-48 overflow-hidden rounded-xl border border-primary/30 grayscale contrast-125 opacity-70">
                            <img
                                alt="Stylized map showing business district location"
                                className="h-full w-full object-cover"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBMHbkfJafdbnFaLhl1hegPtCEvf395EbKG4GElVdzxnGa5B4O5DC-duxVLJyiQw3mY_T84BF2aFuDZrl__BRE19oPSM908Iz7_CNi1VlRr1C6wMm3I66ClLA079-xU-bz-HWxAoh-FmZNZaxqzmirGdViPqOr6StD6YqMjdxJUONsCIKdmecp1HpJPLYat5FAzLxziLMu5FNDH1tDT70d-h-xsX1B8EiyTJu622BKbiS-OmPe_JDV3T1MK4NnrnrDMwKJhmb2UF8ao"
                            />
                        </div>
                    </div>
                </div>

                <div className="flex flex-col items-center justify-between gap-4 border-t border-primary/20 pt-8 text-xs text-slate-500 md:flex-row">
                    <p>© 2024 آفاق العمران للتطوير العقاري. جميع الحقوق محفوظة.</p>
                    <div className="flex gap-6">
                        <a className="transition-colors hover:text-white" href="#contact">تواصل معنا</a>
                        <Link className="transition-colors hover:text-white" href="/about">عن الشركة</Link>
                    </div>
                </div>
            </div>
        </footer>
    );
}
