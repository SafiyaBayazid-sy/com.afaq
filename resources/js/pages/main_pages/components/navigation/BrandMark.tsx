interface BrandMarkProps {
    className?: string;
    iconClassName?: string;
}

export default function BrandMark({ className = '', iconClassName = '' }: BrandMarkProps) {
    return (
        <div
            className={`flex size-8 items-center justify-center rounded-md border border-white/10 bg-[#0a4a42] text-white shadow-[inset_0_1px_0_rgba(255,255,255,0.08)] ${className}`.trim()}
        >
            <svg
                aria-hidden="true"
                className={`size-4 ${iconClassName}`.trim()}
                fill="currentColor"
                viewBox="0 0 48 48"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path d="M6 6H42L36 24L42 42H6L12 24L6 6Z" />
            </svg>
        </div>
    );
}
