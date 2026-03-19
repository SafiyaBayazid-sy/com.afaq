<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppDownloadLinkMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public ?string $androidUrl,
        public ?string $iosUrl,
        public ?string $fallbackUrl
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'رابط تحميل تطبيق آفاق العمران'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.app-download-link'
        );
    }
}
