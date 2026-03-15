import React, { useEffect } from 'react';

const TailwindConfig = ({ children }) => {
    useEffect(() => {
        // حفظ التكوين الأصلي إذا كان موجوداً
        const originalConfig = window.tailwind?.config;

        // تطبيق التكوين الخاص بالصفحة
        window.tailwind = window.tailwind || {};
        window.tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#0a332e",
                        "background-light": "#f6f8f8",
                        "background-dark": "#12201e",
                    },
                    fontFamily: {
                        "display": ["Noto Sans Arabic", "Manrope", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        };

        // تنظيف التكوين عند مغادرة الصفحة
        return () => {
            if (originalConfig) {
                window.tailwind.config = originalConfig;
            } else {
                delete window.tailwind.config;
            }
        };
    }, []);

    return children;
};

export default TailwindConfig;
