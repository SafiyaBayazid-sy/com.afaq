export default function Hero() {
    return (
        <section className="relative h-[400px] w-full overflow-hidden">
            <div
                className="absolute inset-0 bg-cover bg-center"
                style={{
                    backgroundImage: `linear-gradient(to bottom, rgba(10, 51, 46, 0.8), rgba(18, 32, 30, 0.95)), url("https://lh3.googleusercontent.com/aida-public/AB6AXuADg0WTj7s3eLhaoIqpYls8xtDyuvhMsGSZm14BCuKd2mlhB0eGYdHvRmjmcIFmt_OT6FmcW9CWK15-uZnQHFoOjBIaM85teEPDGh39FrWf1hb3RskquJrc3lxEQy2vtbhgOoxKftk2weEXMMPyeqDJ4aZgBOmvbez4jQbbwmQKyq9cUhYNyBIA30chFdYh7lHw-wHX9wby9VPC0axLxo8NvZESii_DdQtslWv4jiDu4538XjZuTZZXMFw2tSJ2xr-MuYPDsr8uLCCd")`
                }}
            />
            <div className="relative z-10 h-full max-w-[1200px] mx-auto px-6 lg:px-40 flex flex-col justify-center items-start text-right">
                <span className="bg-primary/30 text-white px-4 py-1 rounded-full text-xs font-semibold mb-4 border border-primary/50">
                    تأسست عام 2005
                </span>
                <h1 className="text-4xl md:text-6xl font-black text-white mb-6 leading-tight">
                    نبني المستقبل <br/>
                    <span className="opacity-90">برؤية هندسية متطورة</span>
                </h1>
                <p className="text-slate-300 text-lg max-w-2xl leading-relaxed">
                    نحن في آفاق العمران نجمع بين الأصالة المعمارية وأحدث التقنيات الهندسية لنقدم حلولاً إنشائية تفوق التوقعات.
                </p>
            </div>
        </section>
    );
}
