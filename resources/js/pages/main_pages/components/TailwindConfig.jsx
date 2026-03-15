import React, { useEffect, useLayoutEffect } from 'react';

const TailwindConfig = ({ children }) => {
    // useLayoutEffect runs BEFORE the browser paints, which helps prevent the white flash
    useLayoutEffect(() => {
        document.documentElement.classList.add('dark');
        document.documentElement.setAttribute('dir', 'rtl');
        document.body.style.backgroundColor = '#12201e'; // Immediate fallback
    }, []);

    useEffect(() => {
        // Inject Fonts
        const fontLinks = [
            'https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Noto+Sans+Arabic:wght@300;400;500;600;700;800&display=swap',
            'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap'
        ];

        fontLinks.forEach(href => {
            if (!document.querySelector(`link[href="${href}"]`)) {
                const link = document.createElement('link');
                link.rel = 'stylesheet';
                link.href = href;
                document.head.appendChild(link);
            }
        });

        // Inject Tailwind Config Script
        const configScript = document.createElement('script');
        configScript.id = 'tailwind-config';
        configScript.text = `
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        colors: {
                            "primary": "#0a332e",
                            "background-light": "#f6f8f8",
                            "background-dark": "#12201e",
                        },
                        fontFamily: {
                            "display": ["Manrope", "Noto Sans Arabic", "sans-serif"]
                        },
                        borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                    },
                },
            }
        `;
        
        if (!document.getElementById('tailwind-config')) {
            document.head.appendChild(configScript);
        }

        // Load Tailwind CDN if not present
        if (!document.querySelector('script[src*="tailwindcss.com"]')) {
            const cdnScript = document.createElement('script');
            cdnScript.src = 'https://cdn.tailwindcss.com?plugins=forms,container-queries';
            document.head.appendChild(cdnScript);
        }
    }, []);

    return children;
};

export default TailwindConfig;