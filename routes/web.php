<?php

use App\Http\Controllers\Web\PageController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;


// Require authentication for admin panel
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Filament handles this automatically
});


Route::inertia('/', 'welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
});


Route::inertia('/about', 'main_pages/Pages/About/Index')->name('about');
Route::inertia('/studies', 'main_pages/Pages/Studies/Index')->name('studies');

require __DIR__.'/settings.php';
