import React, { useEffect } from 'react';

/**
 * Injects an inline tailwind.config script and (if needed) the Tailwind CDN
 * so the runtime Tailwind CDN uses the same configuration as the original HTML.
 */
const TailwindConfig = ({ children }) => {
    useEffect(() => {
        // Create inline tailwind-config script (mirrors code.html)
        const configScript = document.createElement('script');
        configScript.id = 'tailwind-config';
        configScript.type = 'text/javascript';
        configScript.text = `tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        \"primary\": \"#0a332e\",
                        \"background-light\": \"#f6f8f8\",
                        // Use the RGB form with Tailwind alpha placeholder so opacity utilities work
                        \"background-dark\": \"rgb(18 32 30 / <alpha-value>)\",
                    },
                    fontFamily: {
                        \"display\": [\"Manrope\", \"Noto Sans Arabic\", \"sans-serif\"]
                    },
                    borderRadius: { \"DEFAULT\": \"0.25rem\", \"lg\": \"0.5rem\", \"xl\": \"0.75rem\", \"full\": \"9999px\" },
                },
            },
        }`;
        document.head.appendChild(configScript);

        // Ensure the Tailwind CDN is loaded (use existing if present)
        let createdCdn = false;
        let cdnScript = document.querySelector('script[src^="https://cdn.tailwindcss.com"]');
        if (!cdnScript) {
            cdnScript = document.createElement('script');
            cdnScript.src = 'https://cdn.tailwindcss.com?plugins=forms,container-queries';
            cdnScript.async = true;
            document.head.appendChild(cdnScript);
            createdCdn = true;
        }

        // Cleanup on unmount: remove any scripts we added
        return () => {
            if (configScript && configScript.parentNode) configScript.parentNode.removeChild(configScript);
            if (createdCdn && cdnScript && cdnScript.parentNode) cdnScript.parentNode.removeChild(cdnScript);
        };
    }, []);

    return children;
};

export default TailwindConfig;
