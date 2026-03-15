import React from 'react';

export default function ContactNewsletter() {
    return (
        <section className="py-20 bg-primary text-white" dir="rtl">
            <div className="container mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div className="space-y-6">
                    <h2 className="text-4xl font-black">كن أول من يعرف عن مشاريعنا الجديدة</h2>
                    <p className="text-lg opacity-80 leading-relaxed">
                        اشترك في نشرتنا الإخبارية للحصول على آخر التحديثات والعروض الحصرية مباشرة في بريدك الإلكتروني.
                    </p>
                    <form className="flex flex-col sm:flex-row gap-3">
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
                            <span className="material-symbols-outlined">call</span>
                        </div>
                        <div>
                            <p className="font-bold">اتصل بنا</p>
                            <p className="opacity-70 text-sm">9200 123 456</p>
                        </div>
                    </div>
                    <div className="flex items-start gap-4">
                        <div className="size-12 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                            <span className="material-symbols-outlined">mail</span>
                        </div>
                        <div>
                            <p className="font-bold">البريد الإلكتروني</p>
                            <p className="opacity-70 text-sm">info@afaqomran.com</p>
                        </div>
                    </div>
                    <div className="flex items-start gap-4">
                        <div className="size-12 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                            <span className="material-symbols-outlined">location_on</span>
                        </div>
                        <div>
                            <p className="font-bold">المقر الرئيسي</p>
                            <p className="opacity-70 text-sm">طريق الملك فهد، الرياض، المملكة العربية السعودية</p>
                        </div>
                    </div>
                    <div className="flex items-start gap-4">
                        <div className="size-12 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                            <span className="material-symbols-outlined">schedule</span>
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