<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ResidentController;
use App\Http\Controllers\Admin\BrgyOfficialsController;
use App\Http\Controllers\Admin\InsidentsReportController;
use App\Http\Controllers\Admin\PurokController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.user-edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.admin-edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Route::get('/users', [AdminController::class, 'listUsers'])->name('users.list');
        // Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        // Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        // Route::get('/users/{user}', [AdminController::class, 'showUser'])->name('users.show');
        // Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        // Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
        // Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');

        // Residents Routes
        Route::get('/residents', [ResidentController::class, 'index'])->name('residents-list');
        Route::post('/residents', [ResidentController::class, 'store'])->name('residents-store');
        Route::get('/residents/{resident}', [ResidentController::class, 'show'])->name('residents-show');
        Route::get('/residents/{resident}/edit', [ResidentController::class, 'edit'])->name('residents-edit');
        Route::put('/residents/{resident}', [ResidentController::class, 'update'])->name('residents-update');
        Route::delete('/residents/{resident}', [ResidentController::class, 'destroy'])->name('residents.destroy');

        // Brgy Officials Routes
        Route::get('/officials', [BrgyOfficialsController::class, 'index'])->name('officials-list');
        Route::post('/officials', [BrgyOfficialsController::class, 'store'])->name('officials-store');
        Route::get('/officials/{official}', [BrgyOfficialsController::class, 'show'])->name('officials-show');
        Route::get('/officials/{official}/edit', [BrgyOfficialsController::class, 'edit'])->name('officials-edit');
        Route::put('/officials/{official}', [BrgyOfficialsController::class, 'update'])->name('officials-update');
        Route::delete('/officials/{official}', [BrgyOfficialsController::class, 'destroy'])->name('officials-delete');

        // Brgy Report Routes
        Route::get('/reports', [InsidentsReportController::class, 'index'])->name('reports-list');
        Route::post('/reports', [InsidentsReportController::class, 'store'])->name('reports-store');
        Route::get('/reports/{report}', [InsidentsReportController::class, 'show'])->name('reports-show');
        Route::get('/reports/{report}/edit', [InsidentsReportController::class, 'edit'])->name('reports-edit');
        Route::put('/reports/{report}', [InsidentsReportController::class, 'update'])->name('reports-update');
        Route::delete('/reports/{report}', [InsidentsReportController::class, 'destroy'])->name('reports-delete');

        // Adding Purok/Streets
        Route::get('/streets', [PurokController::class, 'index'])->name('streets-list');
        Route::post('/streets', [PurokController::class, 'store'])->name('puroks.store');
        Route::delete('/streets', [PurokController::class, 'destroy'])->name('puroks.destroy');
});


require __DIR__.'/auth.php';