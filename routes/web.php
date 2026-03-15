<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Filament handles this automatically
});

Route::inertia('/', 'main_pages/Pages/Home/Index')->name('home');
Route::inertia('studies', 'main_pages/Pages/StudiesResearch/Index')->name('studies');
Route::inertia('building-strengthening', 'main_pages/Pages/BuildingStrengthening/Index')->name('building.strengthening');
Route::inertia('legal-consultations', 'main_pages/Pages/LegalConsultations/Index')->name('legal.consultations');
Route::inertia('projects', 'main_pages/Pages/Projects/Index')->name('projects.index');
Route::inertia('projects/{slug}', 'main_pages/Pages/Project/Index')->name('project.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
});

Route::inertia('/about', 'main_pages/Pages/About/Index')->name('about');

require __DIR__.'/settings.php';
