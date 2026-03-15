import { Link } from '@inertiajs/react';

export default function Navbar() {
    return (
        <header className="sticky top-0 z-50 w-full border-b border-primary/20 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md">
            <div className="container mx-auto px-6 py-4 flex items-center justify-between">
                <div className="flex items-center gap-3">
                    <div className="text-primary dark:text-slate-100">
                        <svg className="size-8" fill="currentColor" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 6H42L36 24L42 42H6L12 24L6 6Z" />
                        </svg>
                    </div>
                    <h2 className="text-xl font-bold tracking-tight text-primary dark:text-white">???? ???????</h2>
                </div>

                <nav className="hidden md:flex items-center gap-8">
                    <Link href="/" className="text-sm font-semibold hover:text-primary dark:hover:text-primary transition-colors">????????</Link>
                    <Link href="/building-strengthening" className="text-sm font-semibold hover:text-primary dark:hover:text-primary transition-colors">????? ??????? ?????????</Link>
                    <Link href="/legal-consultations" className="text-sm font-semibold hover:text-primary dark:hover:text-primary transition-colors">?????????? ?????????</Link>
                    <Link href="/projects" className="text-sm font-semibold hover:text-primary dark:hover:text-primary transition-colors">????????</Link>
                    <Link href="/studies" className="text-sm font-semibold hover:text-primary dark:hover:text-primary transition-colors">???????? ???????</Link>
                    <Link href="/about" className="text-sm font-semibold hover:text-primary dark:hover:text-primary transition-colors">?? ??????</Link>
                    <Link href="/#contact" className="text-sm font-semibold hover:text-primary dark:hover:text-primary transition-colors">???? ???</Link>
                </nav>

                <div className="flex items-center gap-4">
                    <button className="flex items-center justify-center rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:bg-opacity-90 transition-all">
                        <span>English</span>
                    </button>
                    <div className="hidden sm:block size-10 rounded-full border border-primary/20 overflow-hidden">
                        <img
                            className="w-full h-full object-cover"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuC93w3iUBmnpjlY9XbF3FyrERffuyGUlVEf7C8YuA2gA8CDJ0MQqoVlyOKLYOJS9YDYxC_kus6inLQgcSPT8GTA6n1WA9QIK5VMZedyBqrFuccZ6cCyXJYH92JKmGx2OTcKVMBLgH1alzZB5coidtvxl2C-4yzw7v4xb095f_rqaXtd1mpFq6gAdrZ6xnPS0ApdwUrkPC7eoinWxR1jVTb54b-goSKaNRf2LRvt7tYvgNtRYfTudtQRzr0XolDu5S8Cj-oUQ2J0bohq"
                            alt="Profile picture"
                        />
                    </div>
                </div>
            </div>
        </header>
    );
}
