<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\MenteeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Redirect authenticated users to their role-specific dashboard
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Mentor Routes
Route::middleware(['auth', 'role:mentor'])->prefix('mentor')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Mentor/Dashboard');
    })->name('mentor.dashboard');
});

// Mentee Routes
Route::middleware(['auth', 'role:mentee'])->prefix('mentee')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Mentee/Dashboard');
    })->name('mentee.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Registration Routes
Route::get('/register/mentor', [MentorController::class, 'create'])->name('register.mentor');
Route::post('/register/mentor', [MentorController::class, 'store'])->name('register.mentor.store');

Route::get('/register/mentee', [MenteeController::class, 'create'])->name('register.mentee');
Route::post('/register/mentee', [MenteeController::class, 'store'])->name('register.mentee.store');

require __DIR__.'/auth.php';
