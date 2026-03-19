<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AppDownloadLinkController;
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
})->middleware('auth:sanctum');

// PDF-compatible mobile contract endpoints
Route::prefix('auth')->group(function () {
    Route::post('/register', [MobileContractController::class, 'register']);
    Route::post('/login', [MobileContractController::class, 'login']);
});

Route::get('/projects', [MobileContractController::class, 'projects']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/inspections/store', [MobileContractController::class, 'storeInspection']);
    Route::post('/consultations/store', [MobileContractController::class, 'storeConsultation']);
    Route::get('/orders', [MobileContractController::class, 'orders']);
    Route::get('/orders/{id}', [MobileContractController::class, 'showOrder']);
});

Route::prefix('v1')->group(function () {
    // Backward-compatible auth routes
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Phase endpoints: auth
    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
    });

    // Phase endpoints: projects
    Route::get('/projects/filters', [ProjectApiController::class, 'filters']);
    Route::get('/projects', [ProjectApiController::class, 'index']);
    Route::get('/projects/{project}', [ProjectApiController::class, 'show']);

    // Public content/settings for the customer app
    Route::get('/content/pages', [ContentPageApiController::class, 'index']);
    Route::get('/content/pages/{slug}', [ContentPageApiController::class, 'show']);
    Route::get('/settings/public', [PublicSettingsApiController::class, 'index']);
    Route::post('/app-link/request', [AppDownloadLinkController::class, 'send']);

    // Existing dynamic forms
    Route::get('/forms/{slug}', [FormBuilderController::class, 'show']);
    Route::post('/forms/{slug}/submissions', [FormBuilderController::class, 'submit']);

    // Lead Hub ingestion
    Route::post('/leads/mobile', [LeadHubController::class, 'storeFromMobile']);
    Route::post('/leads/website', [LeadHubController::class, 'storeFromWebsite']);
    Route::post('/leads/webhooks/facebook', [LeadHubController::class, 'storeFacebookWebhook']);
    Route::post('/leads/webhooks/google', [LeadHubController::class, 'storeGoogleWebhook']);

    // Authenticated customer endpoints
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);

        // submit inquiry / booking
        Route::post('/inquiries', [InquiryApiController::class, 'submit']);
        Route::post('/bookings', [BookingApiController::class, 'submit']);

        // my profile
        Route::get('/my/profile', [ProfileApiController::class, 'show']);

        // my notifications
        Route::get('/my/notifications', [MyNotificationController::class, 'index']);
        Route::patch('/my/notifications/{notification}/read', [MyNotificationController::class, 'markAsRead']);

        // my push-notification device tokens
        Route::get('/my/device-tokens', [DeviceTokenApiController::class, 'index']);
        Route::post('/my/device-tokens', [DeviceTokenApiController::class, 'store']);
        Route::delete('/my/device-tokens/{deviceToken}', [DeviceTokenApiController::class, 'destroy']);
    });
});
