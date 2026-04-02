import { usePage } from '@inertiajs/react';

export type PublicLanguage = 'ar' | 'en';

export function usePublicLanguage() {
    const { url } = usePage();
    const [path = '/', query = ''] = url.split('?');
    const params = new URLSearchParams(query);
    const isHomePage = path === '/';
    const lang: PublicLanguage =
        isHomePage && params.get('lang') === 'en' ? 'en' : 'ar';

    return {
        lang,
        isEnglish: lang === 'en',
        isHomePage,
        dir: lang === 'en' ? 'ltr' : 'rtl',
        homeHref: lang === 'en' ? '/?lang=en' : '/',
        langToggleHref: lang === 'en' ? '/' : '/?lang=en',
    };
}
