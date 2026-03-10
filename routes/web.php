<?php

use App\Http\Controllers\Web\PageController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Require authentication for admin panel
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Filament handles this automatically
});


Route::inertia('/', 'main_pages/Pages/Home/Index')->name('home');

// Studies & Research page
Route::inertia('studies', 'main_pages/Pages/StudiesResearch/Index')->name('studies');

// Building Strengthening / Structural services page
Route::inertia('building-strengthening', 'main_pages/Pages/BuildingStrengthening/Index')->name('building.strengthening');

// Legal Consultations page
Route::inertia('legal-consultations', 'main_pages/Pages/LegalConsultations/Index')->name('legal.consultations');

// Projects listing
Route::inertia('projects', 'main_pages/Pages/Projects/Index')->name('projects.index');

// Project details (dynamic)
Route::inertia('projects/{slug}', 'main_pages/Pages/Project/Index')->name('project.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
});

// The landing page is served at the root; no separate /home route is required.

Route::get('/about', function () {
    return Inertia::render('main_pages/Pages/About/Index');
})->name('about');

require __DIR__.'/settings.php';
