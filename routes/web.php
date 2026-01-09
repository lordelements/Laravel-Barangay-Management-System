<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ResidentController;
use App\Http\Controllers\Admin\BrgyOfficialsController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\CommitteePositionController;
use App\Http\Controllers\Admin\InsidentsReportController;
use App\Http\Controllers\Admin\PurokController;
use App\Http\Controllers\Admin\CertificateController;
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
        
        // Brgy Officials Routes
        Route::get('/officials', [BrgyOfficialsController::class, 'index'])->name('officials-list');
        Route::post('/officials', [BrgyOfficialsController::class, 'store'])->name('officials-store');
        Route::get('/officials/{official}', [BrgyOfficialsController::class, 'show'])->name('officials-show');
        Route::get('/officials/{official}/edit', [BrgyOfficialsController::class, 'edit'])->name('officials-edit');
        Route::put('/officials/{official}', [BrgyOfficialsController::class, 'update'])->name('officials-update');
        Route::delete('/officials/{official}', [BrgyOfficialsController::class, 'destroy'])->name('officials-delete');
        
        // Adding BrgyOfficial Position
        Route::get('/official-positions', [PositionController::class, 'index'])->name('official-positions-list');
        Route::post('/official-positions', [PositionController::class, 'store'])->name('official-positions-store');
        Route::get('/official-positions/{position}', [PositionController::class, 'edit'])->name('official-positions-edit');
        Route::put('/official-positions/{position}', [PositionController::class, 'update'])->name('positions-update');
        Route::delete('/official-positions/{position}', [PositionController::class, 'destroy'])->name('delete-position');
        
        // Adding BrgyOfficial Committee Position
        Route::get('/committee-positions', [CommitteePositionController::class, 'index'])->name('committee-positions-list');
        Route::post('/committee-positions', [CommitteePositionController::class, 'store'])->name('committee-positions-store');
        Route::get('/committee-positions/{committee_position}', [CommitteePositionController::class, 'show'])->name('committee-positions-show');
        Route::get('/committee-positions/{committee_position}/edit', [CommitteePositionController::class, 'edit'])->name('committee-positions-edit');
        Route::put('/committee-positions/{committee_position}', [CommitteePositionController::class, 'update'])->name('committee-positions-update');
        Route::delete('/committee-positions/{committee_position}', [CommitteePositionController::class, 'destroy'])->name('committee-delete');
        

        // Adding Issuance of Certificates Routes
        Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates-list');
        Route::post('/certificates', [CertificateController::class, 'store'])->name('certificates-store');
        Route::get('/certificates/{certificate}', [CertificateController::class, 'show'])->name('certificates-show');
        Route::get('/certificates/{certificate}/edit', [CertificateController::class, 'edit'])->name('certificates-edit');
        Route::put('/certificates/{certificate}', [CertificateController::class, 'update'])->name('certificates-update');
        Route::delete('/certificates/{certificate}', [CertificateController::class, 'destroy'])->name('certificates-delete');
});


require __DIR__.'/auth.php';