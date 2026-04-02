import { useState } from 'react';
import type { FormEvent } from 'react';
import { usePublicLanguage } from '../hooks/use-public-language';

type FeedbackState = {
    kind: 'idle' | 'success' | 'error';
    message: string;
};

export default function PublicEmailCapture() {
    const { dir, isEnglish } = usePublicLanguage();
    const content = isEnglish
        ? {
              idleMessage:
                  'Enter your email address and we will send you the app download link right away.',
              sendingMessage: 'Sending the link...',
              successMessage: (email: string) =>
                  `The app download link has been sent to ${email}.`,
              errorMessage:
                  'We could not send the link right now. Please try again shortly.',
              title: 'Get the app download link',
              description:
                  'Enter your email and we will send you a link to download the Afaq Omran app, where you can manage all services more easily.',
              submitIdle: 'Send link',
              submitLoading: 'Sending...',
              textAlign: 'text-left',
          }
        : {
              idleMessage:
                  'أدخل بريدك الإلكتروني وسنرسل لك رابط تحميل التطبيق مباشرة.',
              sendingMessage: 'جارٍ إرسال الرابط...',
              successMessage: (email: string) =>
                  `تم إرسال رابط تحميل التطبيق إلى ${email}.`,
              errorMessage:
                  'تعذر إرسال الرابط الآن. يرجى المحاولة مرة أخرى بعد قليل.',
              title: 'احصل على رابط تحميل التطبيق',
              description:
                  'أدخل بريدك الإلكتروني وسنرسل لك رابط تحميل تطبيق آفاق العمران، ومن خلال التطبيق ستتمكن من إدارة كل الخدمات بسهولة.',
              submitIdle: 'إرسال الرابط',
              submitLoading: 'جارٍ الإرسال...',
              textAlign: 'text-right',
          };
    const [email, setEmail] = useState('');
    const [isSubmitting, setIsSubmitting] = useState(false);
    const [feedback, setFeedback] = useState<FeedbackState>({
        kind: 'idle',
        message: content.idleMessage,
    });

    const handleSubmit = async (event: FormEvent<HTMLFormElement>) => {
        event.preventDefault();

        const normalizedEmail = email.trim();

        if (!normalizedEmail) {
            return;
        }

        setIsSubmitting(true);
        setFeedback({ kind: 'idle', message: content.sendingMessage });

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
                message: content.successMessage(normalizedEmail),
            });
            setEmail('');
        } catch {
            setFeedback({
                kind: 'error',
                message: content.errorMessage,
            });
        } finally {
            setIsSubmitting(false);
        }
    };

    return (
        <section className="bg-primary py-16 text-white" dir={dir} id="contact">
            <div className={`container mx-auto max-w-3xl px-6 ${content.textAlign}`}>
                <h2 className="mb-4 text-3xl font-black">{content.title}</h2>
                <p className="mb-8 text-base leading-relaxed text-white/85">
                    {content.description}
                </p>

                <form className="flex flex-col gap-3 sm:flex-row" onSubmit={handleSubmit}>
                    <input
                        autoComplete="email"
                        className={`h-12 flex-1 rounded-lg border border-white/25 bg-white/10 px-4 text-white placeholder:text-white/60 focus:border-white focus:outline-none ${
                            isEnglish ? 'text-left' : 'text-right'
                        }`}
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
                        {isSubmitting
                            ? content.submitLoading
                            : content.submitIdle}
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
