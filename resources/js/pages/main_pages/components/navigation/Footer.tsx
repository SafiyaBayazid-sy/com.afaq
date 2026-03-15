import { Link } from '@inertiajs/react';

export default function Footer() {
    return (
        <footer className="bg-primary text-white pt-16 pb-8 px-6 lg:px-40 border-t border-white/10">
            <div className="max-w-[1200px] mx-auto grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                {/* Company Info */}
                <div className="col-span-1 md:col-span-1">
                    <div className="flex items-center gap-3 mb-6">
                        <div className="bg-white/10 p-2 rounded-lg">
                            <svg className="size-6 text-white" fill="none" viewBox="0 0 48 48">
                                <path d="M6 6H42L36 24L42 42H6L12 24L6 6Z" fill="currentColor" />
                            </svg>
                        </div>
                        <h2 className="text-white text-xl font-bold">آفاق العمران</h2>
                    </div>
                    <p className="text-slate-400 text-sm leading-relaxed">
                        شركة رائدة في مجال المقاولات والإنشاءات، نلتزم بالتميز في كل مشروع نقدمه لعملائنا.
                    </p>
                </div>

                {/* Quick Links */}
                <div>
                    <h4 className="font-bold mb-6">روابط سريعة</h4>
                    <ul className="space-y-3 text-slate-400 text-sm">
                        <li><Link href="/about" className="hover:text-white transition-colors">عن الشركة</Link></li>
                        <li><Link href="/services" className="hover:text-white transition-colors">خدماتنا</Link></li>
                        <li><Link href="/projects" className="hover:text-white transition-colors">المشاريع</Link></li>
                        <li><Link href="/careers" className="hover:text-white transition-colors">الوظائف</Link></li>
                    </ul>
                </div>

                {/* Services */}
                <div>
                    <h4 className="font-bold mb-6">خدماتنا</h4>
                    <ul className="space-y-3 text-slate-400 text-sm">
                        <li><Link href="/services/general-contracting" className="hover:text-white transition-colors">المقاولات العامة</Link></li>
                        <li><Link href="/services/engineering-design" className="hover:text-white transition-colors">التصميم الهندسي</Link></li>
                        <li><Link href="/services/project-management" className="hover:text-white transition-colors">إدارة المشاريع</Link></li>
                        <li><Link href="/services/finishing" className="hover:text-white transition-colors">أعمال التشطيبات</Link></li>
                    </ul>
                </div>

                {/* Contact */}
                <div>
                    <h4 className="font-bold mb-6">تواصل معنا</h4>
                    <ul className="space-y-4 text-slate-400 text-sm">
                        <li className="flex items-center gap-3">
                            <span className="material-symbols-outlined text-lg">location_on</span>
                            الرياض، حي المروج، طريق الملك فهد
                        </li>
                        <li className="flex items-center gap-3">
                            <span className="material-symbols-outlined text-lg">call</span>
                            920000000
                        </li>
                        <li className="flex items-center gap-3">
                            <span className="material-symbols-outlined text-lg">mail</span>
                            info@afaqalomran.com
                        </li>
                    </ul>
                </div>
            </div>

            {/* Bottom Bar */}
            <div className="max-w-[1200px] mx-auto pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4 text-slate-500 text-xs">
                <p>© 2024 آفاق العمران للمقاولات. جميع الحقوق محفوظة.</p>
                <div className="flex gap-6">
                    <Link href="/privacy" className="hover:text-white transition-colors">سياسة الخصوصية</Link>
                    <Link href="/terms" className="hover:text-white transition-colors">الشروط والأحكام</Link>
                </div>
            </div>
        </footer>
    );
}
