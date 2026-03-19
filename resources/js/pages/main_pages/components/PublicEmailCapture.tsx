import { useState } from 'react';
import type { FormEvent } from 'react';

type FeedbackState = {
    kind: 'idle' | 'success' | 'error';
    message: string;
};

export default function PublicEmailCapture() {
    const [email, setEmail] = useState('');
    const [isSubmitting, setIsSubmitting] = useState(false);
    const [feedback, setFeedback] = useState<FeedbackState>({
        kind: 'idle',
        message: 'أدخل بريدك الإلكتروني وسنرسل لك رابط تحميل التطبيق مباشرة.',
    });

    const handleSubmit = async (event: FormEvent<HTMLFormElement>) => {
        event.preventDefault();

        const normalizedEmail = email.trim();

        if (!normalizedEmail) {
            return;
        }

        setIsSubmitting(true);
        setFeedback({ kind: 'idle', message: 'جارٍ إرسال الرابط...' });

        try {
            const response = await fetch('/api/v1/app-link/request', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                },
                body: JSON.stringify({ email: normalizedEmail }),
            });

            if (!response.ok) {
                throw new Error('Failed to request app link.');
            }

            setFeedback({
                kind: 'success',
                message: `تم إرسال رابط تحميل التطبيق إلى ${normalizedEmail}.`,
            });
            setEmail('');
        } catch {
            setFeedback({
                kind: 'error',
                message: 'تعذر إرسال الرابط الآن. يرجى المحاولة مرة أخرى بعد قليل.',
            });
        } finally {
            setIsSubmitting(false);
        }
    };

    return (
        <section className="bg-primary py-16 text-white" dir="rtl" id="contact">
            <div className="container mx-auto max-w-3xl px-6 text-right">
                <h2 className="mb-4 text-3xl font-black">احصل على رابط تحميل التطبيق</h2>
                <p className="mb-8 text-base leading-relaxed text-white/85">
                    أدخل بريدك الإلكتروني وسنرسل لك رابط تحميل تطبيق آفاق العمران، ومن خلال التطبيق ستتمكن من إدارة كل الخدمات بسهولة.
                </p>

                <form className="flex flex-col gap-3 sm:flex-row" onSubmit={handleSubmit}>
                    <input
                        autoComplete="email"
                        className="h-12 flex-1 rounded-lg border border-white/25 bg-white/10 px-4 text-right text-white placeholder:text-white/60 focus:border-white focus:outline-none"
                        dir="ltr"
                        name="email"
                        onChange={(event) => setEmail(event.target.value)}
                        placeholder="example@email.com"
                        required
                        type="email"
                        value={email}
                    />
                    <button
                        className="h-12 rounded-lg bg-white px-6 font-bold text-primary transition-colors hover:bg-slate-100 disabled:cursor-not-allowed disabled:opacity-70"
                        disabled={isSubmitting}
                        type="submit"
                    >
                        {isSubmitting ? 'جارٍ الإرسال...' : 'إرسال الرابط'}
                    </button>
                </form>

                <p
                    className={`mt-4 text-sm ${
                        feedback.kind === 'error'
                            ? 'text-red-100'
                            : feedback.kind === 'success'
                              ? 'text-emerald-100'
                              : 'text-white/80'
                    }`}
                >
                    {feedback.message}
                </p>
            </div>
        </section>
    );
}
