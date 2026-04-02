import { Link } from '@inertiajs/react';
import { usePublicLanguage } from '../../hooks/use-public-language';
import BrandMark from './BrandMark';

export default function Footer() {
    const { dir, homeHref, isEnglish } = usePublicLanguage();
    const content = isEnglish
        ? {
              companyName: 'Afaq Omran',
              paragraphOne:
                  'A specialized real estate development and delivery company offering integrated solutions that include legal due diligence, modern engineering design, project execution to international standards, smart-home implementation, and restoration of damaged buildings.',
              paragraphTwo:
                  'We aim to help expatriates and investors execute their real estate projects safely and with confidence, even when they are outside the country.',
              quickLinks: 'Quick Links',
              services: 'Our Services',
              location: 'Location',
              links: [
                  { href: homeHref, label: 'Home' },
                  { href: '/about', label: 'About Afaq Omran' },
                  { href: '/projects', label: 'Projects' },
                  { href: '/studies', label: 'Studies & Research' },
              ],
              serviceLinks: [
                  {
                      href: '/building-strengthening',
                      label: 'Structural Engineering',
                  },
                  {
                      href: '/legal-consultations',
                      label: 'Legal Consultations',
                  },
                  { href: '/studies', label: 'Studies & Research' },
                  { href: '#contact', label: 'Unified Email Form' },
              ],
              copyright:
                  '© 2024 Afaq Omran Real Estate Development. All rights reserved.',
              contactUs: 'Contact us',
              aboutCompany: 'About the company',
          }
        : {
              companyName: 'آفاق العمران',
              paragraphOne:
                  'شركة متخصصة في التطوير والتنفيذ العقاري تقدم حلولًا متكاملة تشمل الدراسة القانونية للعقارات، والتصميم الهندسي الحديث، وتنفيذ المشاريع وفق معايير عالمية، وبناء المنازل الذكية، وترميم وإعادة تأهيل المباني المتضررة.',
              paragraphTwo:
                  'نهدف إلى مساعدة المغتربين والمستثمرين على تنفيذ مشاريعهم العقارية بأمان وثقة حتى لو كانوا خارج البلد.',
              quickLinks: 'روابط سريعة',
              services: 'خدماتنا',
              location: 'الموقع',
              links: [
                  { href: homeHref, label: 'الرئيسية' },
                  { href: '/about', label: 'عن آفاق العمران' },
                  { href: '/projects', label: 'مشاريعنا' },
                  { href: '/studies', label: 'الدراسات والبحوث' },
              ],
              serviceLinks: [
                  { href: '/building-strengthening', label: 'الهندسة الإنشائية' },
                  {
                      href: '/legal-consultations',
                      label: 'الاستشارات القانونية',
                  },
                  { href: '/studies', label: 'الدراسات والبحوث' },
                  { href: '#contact', label: 'نموذج البريد الموحد' },
              ],
              copyright:
                  '© 2024 آفاق العمران للتطوير العقاري. جميع الحقوق محفوظة.',
              contactUs: 'تواصل معنا',
              aboutCompany: 'عن الشركة',
          };

    return (
        <footer
            className="border-t border-primary/20 bg-background-dark pb-10 pt-20"
            dir={dir}
        >
            <div className="container mx-auto px-6">
                <div className="mb-16 grid grid-cols-1 gap-12 md:grid-cols-2 lg:grid-cols-4">
                    <div className="space-y-6">
                        <div className="flex items-center gap-3 text-white">
                            <BrandMark />
                            <h2 className="text-xl font-bold text-white">
                                {content.companyName}
                            </h2>
                        </div>
                        <p className="text-sm leading-relaxed text-slate-400">
                            {content.paragraphOne}
                        </p>
                        <p className="text-sm leading-relaxed text-slate-400">
                            {content.paragraphTwo}
                        </p>
                        <div className="flex gap-4">
                            <a
                                className="flex size-10 items-center justify-center rounded-full border border-primary/40 bg-primary/20 text-white transition-colors hover:bg-primary"
                                href="mailto:info@afaqomran.com"
                            >
                                <span className="material-symbols-outlined text-sm">
                                    mail
                                </span>
                            </a>
                            <a
                                className="flex size-10 items-center justify-center rounded-full border border-primary/40 bg-primary/20 text-white transition-colors hover:bg-primary"
                                href="tel:+9669200123456"
                            >
                                <span className="material-symbols-outlined text-sm">
                                    call
                                </span>
                            </a>
                        </div>
                    </div>

                    <div className="space-y-6">
                        <h4 className="font-bold text-white">
                            {content.quickLinks}
                        </h4>
                        <ul className="space-y-4 text-sm text-slate-400">
                            {content.links.map((link) => (
                                <li key={link.href}>
                                    <Link
                                        className="transition-colors hover:text-white"
                                        href={link.href}
                                    >
                                        {link.label}
                                    </Link>
                                </li>
                            ))}
                        </ul>
                    </div>

                    <div className="space-y-6">
                        <h4 className="font-bold text-white">
                            {content.services}
                        </h4>
                        <ul className="space-y-4 text-sm text-slate-400">
                            {content.serviceLinks.map((link) => (
                                <li key={link.href}>
                                    {link.href.startsWith('/') ? (
                                        <Link
                                            className="transition-colors hover:text-white"
                                            href={link.href}
                                        >
                                            {link.label}
                                        </Link>
                                    ) : (
                                        <a
                                            className="transition-colors hover:text-white"
                                            href={link.href}
                                        >
                                            {link.label}
                                        </a>
                                    )}
                                </li>
                            ))}
                        </ul>
                    </div>

                    <div className="space-y-6">
                        <h4 className="font-bold text-white">
                            {content.location}
                        </h4>
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
                    <p>{content.copyright}</p>
                    <div className="flex gap-6">
                        <a
                            className="transition-colors hover:text-white"
                            href="#contact"
                        >
                            {content.contactUs}
                        </a>
                        <Link
                            className="transition-colors hover:text-white"
                            href="/about"
                        >
                            {content.aboutCompany}
                        </Link>
                    </div>
                </div>
            </div>
        </footer>
    );
}
