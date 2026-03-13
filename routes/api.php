<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\FormBuilderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('customers', CustomerController::class);

Route::prefix('v1')->group(function () {

    Route::post('/register', [CustomerController::class, 'register']);
    Route::post('/login', [CustomerController::class, 'login']);
    Route::get('/forms/{slug}', [FormBuilderController::class, 'show']);
    Route::post('/forms/{slug}/submissions', [FormBuilderController::class, 'submit']);
});
