import { Link } from '@inertiajs/react';

export default function Footer() {
    return (
        <footer className="bg-background-dark pt-20 pb-10 border-t border-primary/20" id="contact" dir="rtl">
            <div className="container mx-auto px-6">
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                    
                    {/* Column 1: Company Info */}
                    <div className="space-y-6">
                        <div className="flex items-center gap-3 text-white">
                            <div className="size-8">
                                <svg fill="currentColor" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 6H42L36 24L42 42H6L12 24L6 6Z" />
                                </svg>
                            </div>
                            <h2 className="text-xl font-bold text-white">آفاق العمران</h2>
                        </div>
                        <p className="text-slate-400 text-sm leading-relaxed">
                            نحن شركة متخصصة في التطوير العقاري، نسعى لتحويل الرؤى الطموحة إلى واقع ملموس من خلال مشاريع نوعية تعيد صياغة مفهوم العيش الحديث.
                        </p>
                        <div className="flex gap-4">
                            <a className="size-10 rounded-full bg-primary/20 border border-primary/40 flex items-center justify-center text-white hover:bg-primary transition-colors" href="#">
                                <span className="material-symbols-outlined text-sm">share</span>
                            </a>
                            <a className="size-10 rounded-full bg-primary/20 border border-primary/40 flex items-center justify-center text-white hover:bg-primary transition-colors" href="#">
                                <span className="material-symbols-outlined text-sm">language</span>
                            </a>
                        </div>
                    </div>

                    {/* Column 2: Quick Links */}
                    <div className="space-y-6">
                        <h4 className="text-white font-bold">روابط سريعة</h4>
                        <ul className="space-y-4 text-slate-400 text-sm">
                            <li><Link className="hover:text-white transition-colors" href="/">الرئيسية</Link></li>
                            <li><Link className="hover:text-white transition-colors" href="/#about">عن آفاق العمران</Link></li>
                            <li><Link className="hover:text-white transition-colors" href="/#projects">مشاريعنا الجارية</Link></li>
                            <li><Link className="hover:text-white transition-colors" href="/partners">شركاء النجاح</Link></li>
                        </ul>
                    </div>

                    {/* Column 3: Services */}
                    <div className="space-y-6">
                        <h4 className="text-white font-bold">خدماتنا</h4>
                        <ul className="space-y-4 text-slate-400 text-sm">
                            <li><Link className="hover:text-white transition-colors" href="/services">التطوير العقاري</Link></li>
                            <li><Link className="hover:text-white transition-colors" href="/services">إدارة المشاريع</Link></li>
                            <li><Link className="hover:text-white transition-colors" href="/services">الاستشارات الهندسية</Link></li>
                            <li><Link className="hover:text-white transition-colors" href="/services">التسويق العقاري</Link></li>
                        </ul>
                    </div>

                    {/* Column 4: Location Map */}
                    <div className="space-y-6">
                        <h4 className="text-white font-bold">الموقع</h4>
                        <div className="rounded-xl overflow-hidden h-48 border border-primary/30 grayscale contrast-125 opacity-70">
                            <img className="w-full h-full object-cover" alt="Stylized map showing business district location" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBMHbkfJafdbnFaLhl1hegPtCEvf395EbKG4GElVdzxnGa5B4O5DC-duxVLJyiQw3mY_T84BF2aFuDZrl__BRE19oPSM908Iz7_CNi1VlRr1C6wMm3I66ClLA079-xU-bz-HWxAoh-FmZNZaxqzmirGdViPqOr6StD6YqMjdxJUONsCIKdmecp1HpJPLYat5FAzLxziLMu5FNDH1tDT70d-h-xsX1B8EiyTJu622BKbiS-OmPe_JDV3T1MK4NnrnrDMwKJhmb2UF8ao"/>
                        </div>
                    </div>
                </div>

                {/* Bottom Bar */}
                <div className="pt-8 border-t border-primary/20 flex flex-col md:flex-row justify-between items-center gap-4 text-slate-500 text-xs">
                    <p>© 2024 آفاق العمران للتطوير العقاري. جميع الحقوق محفوظة.</p>
                    <div className="flex gap-6">
                        <Link className="hover:text-white transition-colors" href="/privacy">سياسة الخصوصية</Link>
                        <Link className="hover:text-white transition-colors" href="/terms">الشروط والأحكام</Link>
                    </div>
                </div>
            </div>
        </footer>
    );
}