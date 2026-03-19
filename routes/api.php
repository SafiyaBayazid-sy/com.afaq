<?php

use App\Http\Controllers\Api\AppDownloadLinkController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingApiController;
use App\Http\Controllers\Api\ContentPageApiController;
use App\Http\Controllers\Api\DeviceTokenApiController;
use App\Http\Controllers\Api\FormBuilderController;
use App\Http\Controllers\Api\InquiryApiController;
use App\Http\Controllers\Api\LeadHubController;
use App\Http\Controllers\Api\MobileContractController;
use App\Http\Controllers\Api\MyNotificationController;
use App\Http\Controllers\Api\ProfileApiController;
use App\Http\Controllers\Api\ProjectApiController;
use App\Http\Controllers\Api\PublicSettingsApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(['auth:sanctum', 'user.type:customer', 'abilities:customer:profile:read']);

// PDF-compatible mobile contract endpoints
Route::prefix('auth')->group(function () {
    Route::post('/register', [MobileContractController::class, 'register'])->middleware('throttle:5,1');
    Route::post('/login', [MobileContractController::class, 'login'])->middleware('throttle:5,1');
});

Route::get('/projects', [MobileContractController::class, 'projects']);

Route::middleware(['auth:sanctum', 'user.type:customer', 'abilities:customer:orders:create'])->group(function () {
    Route::post('/inspections/store', [MobileContractController::class, 'storeInspection']);
    Route::post('/consultations/store', [MobileContractController::class, 'storeConsultation']);
});

Route::middleware(['auth:sanctum', 'user.type:customer', 'abilities:customer:orders:read'])->group(function () {
    Route::get('/orders', [MobileContractController::class, 'orders']);
    Route::get('/orders/{id}', [MobileContractController::class, 'showOrder']);
});

Route::prefix('v1')->group(function () {
    // Backward-compatible auth routes
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

    // Phase endpoints: auth
    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1');
        Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    });

    // Phase endpoints: projects
    Route::get('/projects/filters', [ProjectApiController::class, 'filters']);
    Route::get('/projects', [ProjectApiController::class, 'index']);
    Route::get('/projects/{project}', [ProjectApiController::class, 'show']);

    // Public content/settings for the customer app
    Route::get('/content/pages', [ContentPageApiController::class, 'index']);
    Route::get('/content/pages/{slug}', [ContentPageApiController::class, 'show']);
    Route::get('/settings/public', [PublicSettingsApiController::class, 'index']);
    Route::post('/app-link/request', [AppDownloadLinkController::class, 'send'])->middleware('throttle:3,1');

    // Existing dynamic forms
    Route::get('/forms/{slug}', [FormBuilderController::class, 'show']);
    Route::post('/forms/{slug}/submissions', [FormBuilderController::class, 'submit'])->middleware('throttle:10,1');

    // Lead Hub ingestion
    Route::post('/leads/mobile', [LeadHubController::class, 'storeFromMobile'])->middleware('throttle:10,1');
    Route::post('/leads/website', [LeadHubController::class, 'storeFromWebsite'])->middleware('throttle:10,1');
    Route::post('/leads/webhooks/facebook', [LeadHubController::class, 'storeFacebookWebhook'])->middleware('throttle:60,1');
    Route::post('/leads/webhooks/google', [LeadHubController::class, 'storeGoogleWebhook'])->middleware('throttle:60,1');

    // Authenticated customer endpoints
    Route::middleware(['auth:sanctum', 'user.type:customer'])->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('abilities:customer:auth');

        // submit inquiry / booking
        Route::post('/inquiries', [InquiryApiController::class, 'submit'])->middleware('abilities:customer:inquiries:create');
        Route::post('/bookings', [BookingApiController::class, 'submit'])->middleware('abilities:customer:bookings:create');

        // my profile
        Route::get('/my/profile', [ProfileApiController::class, 'show'])->middleware('abilities:customer:profile:read');

        // my notifications
        Route::get('/my/notifications', [MyNotificationController::class, 'index'])->middleware('abilities:customer:notifications:read');
        Route::patch('/my/notifications/{notification}/read', [MyNotificationController::class, 'markAsRead'])->middleware('abilities:customer:notifications:update');

        // my push-notification device tokens
        Route::get('/my/device-tokens', [DeviceTokenApiController::class, 'index'])->middleware('abilities:customer:device-tokens:manage');
        Route::post('/my/device-tokens', [DeviceTokenApiController::class, 'store'])->middleware('abilities:customer:device-tokens:manage');
        Route::delete('/my/device-tokens/{deviceToken}', [DeviceTokenApiController::class, 'destroy'])->middleware('abilities:customer:device-tokens:manage');
    });
});
