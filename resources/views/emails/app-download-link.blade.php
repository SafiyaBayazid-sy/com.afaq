<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رابط تحميل التطبيق</title>
</head>
<body style="font-family: Tahoma, Arial, sans-serif; background-color: #f8fafc; margin: 0; padding: 24px;">
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="max-width: 640px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0;">
        <tr>
            <td style="background: #0d4c43; color: #ffffff; padding: 20px 24px; text-align: right;">
                <h1 style="margin: 0; font-size: 22px; line-height: 1.4;">رابط تحميل تطبيق آفاق العمران</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 24px; text-align: right; color: #0f172a;">
                <p style="margin: 0 0 16px; font-size: 16px; line-height: 1.8;">
                    شكرًا لتواصلك معنا. يمكنك تحميل التطبيق عبر الروابط التالية:
                </p>

                @if($androidUrl)
                    <p style="margin: 0 0 10px; font-size: 15px;">
                        <strong>Android:</strong>
                        <a href="{{ $androidUrl }}" style="color: #0d4c43;">{{ $androidUrl }}</a>
                    </p>
                @endif

                @if($iosUrl)
                    <p style="margin: 0 0 10px; font-size: 15px;">
                        <strong>iOS:</strong>
                        <a href="{{ $iosUrl }}" style="color: #0d4c43;">{{ $iosUrl }}</a>
                    </p>
                @endif

                @if(!$androidUrl && !$iosUrl && $fallbackUrl)
                    <p style="margin: 0 0 10px; font-size: 15px;">
                        <strong>رابط التطبيق:</strong>
                        <a href="{{ $fallbackUrl }}" style="color: #0d4c43;">{{ $fallbackUrl }}</a>
                    </p>
                @endif

                <p style="margin: 20px 0 0; font-size: 14px; line-height: 1.8; color: #475569;">
                    التطبيق يتيح لك متابعة جميع الخدمات وإدارة طلباتك بسهولة من مكان واحد.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
