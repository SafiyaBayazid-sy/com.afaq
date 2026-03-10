<?php

use App\Http\Controllers\Web\PageController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Require authentication for admin panel
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Filament handles this automatically
});


Route::inertia('/', 'main_pages/Pages/Home/Index')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
});

// The landing page is served at the root; no separate /home route is required.

Route::get('/about', function () {
    return Inertia::render('main_pages/Pages/About/Index');
})->name('about');

require __DIR__.'/settings.php';
