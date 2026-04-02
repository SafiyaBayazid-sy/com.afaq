import type { ImgHTMLAttributes } from 'react';

export default function AppLogoIcon({
    alt = 'Afaq logo',
    src,
    ...props
}: ImgHTMLAttributes<HTMLImageElement>) {
    return <img {...props} src={src ?? '/images/afaq-logo.png'} alt={alt} />;
}
