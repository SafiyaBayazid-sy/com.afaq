<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingApiController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\FormBuilderController;
use App\Http\Controllers\Api\InquiryApiController;
use App\Http\Controllers\Api\LeadHubController;
use App\Http\Controllers\Api\MyNotificationController;
use App\Http\Controllers\Api\ProfileApiController;
use App\Http\Controllers\Api\ProjectApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    // Backward-compatible auth routes
    Route::post('/register', [CustomerController::class, 'register']);
    Route::post('/login', [CustomerController::class, 'login']);

    // Phase endpoints: auth
    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
    });

    // Phase endpoints: projects
    Route::get('/projects', [ProjectApiController::class, 'index']);
    Route::get('/projects/{project}', [ProjectApiController::class, 'show']);

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
    });
});
