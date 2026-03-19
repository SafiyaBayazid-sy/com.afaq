<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\AppDownloadLinkMail;
use App\Services\SettingsService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AppDownloadLinkController extends Controller
{
    use ApiResponseTrait;

    public function send(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $appLinks = SettingsService::getAppLinks();
        $androidUrl = $appLinks['android'] ?? null;
        $iosUrl = $appLinks['ios'] ?? null;
        $fallbackUrl = config('app.url');

        if (! $androidUrl && ! $iosUrl && ! $fallbackUrl) {
            return $this->errorResponse('No application download links are configured yet.', 422);
        }

        try {
            Mail::to($validated['email'])->send(
                new AppDownloadLinkMail($androidUrl, $iosUrl, $fallbackUrl)
            );
        } catch (\Throwable $exception) {
            report($exception);

            return $this->errorResponse('Failed to send the app link email. Please try again.', 500);
        }

        return $this->successResponse(
            ['email' => $validated['email']],
            'Application download link email sent successfully.'
        );
    }
}
