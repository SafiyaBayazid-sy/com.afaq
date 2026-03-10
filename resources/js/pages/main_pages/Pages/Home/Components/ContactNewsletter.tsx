import React from 'react';

export default function ContactNewsletter() {
    return (
        <section className="py-20 bg-primary text-white" dir="rtl">
            <div className="container mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div className="space-y-6 text-right">
                    <h2 className="text-4xl font-black">كن أول من يعرف عن مشاريعنا الجديدة</h2>
                    <p className="text-lg opacity-80 leading-relaxed">
                        اشترك في نشرتنا الإخبارية للحصول على آخر التحديثات والعروض الحصرية مباشرة في بريدك الإلكتروني.
                    </p>
                    <form className="flex flex-col sm:flex-row gap-3 justify-end">
                        <input
                            className="flex-1 rounded-lg bg-white/10 border-white/20 text-white placeholder:text-white/50 focus:ring-white focus:border-white h-14 px-6"
                            placeholder="البريد الإلكتروني"
                            type="email"
                        />
                        <button className="h-14 px-10 bg-white text-primary font-black rounded-lg hover:bg-slate-100 transition-colors">
                            اشترك الآن
                        </button>
                    </form>
                </div>
                    <div className="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <div className="flex items-start gap-4">
                        <div className="size-12 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" className="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M22 16.92V21a1 1 0 0 1-1.11 1 19.86 19.86 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.86 19.86 0 0 1 2 3.11 1 1 0 0 1 3 2h4.09a1 1 0 0 1 1 .75c.12.7.36 1.37.7 2.01a1 1 0 0 1-.24 1.05L7.91 8.09a16 16 0 0 0 6 6l1.28-1.28a1 1 0 0 1 1.05-.24c.64.34 1.31.58 2.01.7a1 1 0 0 1 .75 1V21z" />
                            </svg>
                        </div>
                        <div>
                            <p className="font-bold">اتصل بنا</p>
                            <p className="opacity-70 text-sm">9200 123 456</p>
                        </div>
                    </div>
                    <div className="flex items-start gap-4">
                        <div className="size-12 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" className="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 8l7.89 5.26a2 2 0 0 0 2.22 0L21 8" />
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 8v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8" />
                            </svg>
                        </div>
                        <div>
                            <p className="font-bold">البريد الإلكتروني</p>
                            <p className="opacity-70 text-sm">info@afaqomran.com</p>
                        </div>
                    </div>
                    <div className="flex items-start gap-4">
                        <div className="size-12 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" className="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 10c0 6-9 13-9 13S3 16 3 10a9 9 0 1 1 18 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                        </div>
                        <div>
                            <p className="font-bold">المقر الرئيسي</p>
                            <p className="opacity-70 text-sm">طريق الملك فهد، الرياض، المملكة العربية السعودية</p>
                        </div>
                    </div>
                    <div className="flex items-start gap-4">
                        <div className="size-12 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" className="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 8v4l3 3" />
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 12A9 9 0 1 1 3 12a9 9 0 0 1 18 0z" />
                            </svg>
                        </div>
                        <div>
                            <p className="font-bold">ساعات العمل</p>
                            <p className="opacity-70 text-sm">الأحد - الخميس: 9ص - 5م</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
