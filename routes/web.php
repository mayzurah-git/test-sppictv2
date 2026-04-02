<?php

use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MeetingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

// Semua route yang memerlukan pengesahan (authentication)
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    //Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/urusetia', [DashboardController::class, 'urusetiaDashboard'])->name('dashboard.urusetia');
    Route::get('/dashboard/pengguna', [DashboardController::class, 'penggunaDashboard'])->name('dashboard.pengguna')->middleware('role:Pengguna Biasa');


    // Route Profil Pengguna
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });

    // Dashboard Mengikut Peranan (Role)
        Route::middleware('role:Superadmin')->prefix('superadmin')->name('superadmin.')->group(function () {
        //Route::get('/dashboard', fn() => redirect()->route('superadmin.audit.index'))->name('dashboard');
        Route::get('/audit-logs', [AuditLogController::class, 'index'])->name('audit.index');
    });

    // Route berkaitan Projek
    Route::controller(ProjectController::class)->prefix('projects')->name('projects.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create')->middleware('role:Urus Setia,Pengguna Biasa');
        Route::post('/store-step1', 'storeStep1')->name('storeStep1');

        // Route yang memerlukan parameter {project}
        Route::get('/{project}', 'show')->name('show');
        Route::get('/{project}/edit', 'edit')->name('edit');
        Route::get('/{project}/print', 'print')->name('print');
        Route::patch('/{project}', 'update')->name('update');
        Route::get('/{project}/status/edit', 'createStatusUpdate')->name('status.edit')->middleware('role:Urus Setia');
        Route::delete('/{project}', 'destroy')->name('destroy');
        Route::patch('/{project}/status', 'updateStatus')->name('updateStatus')->middleware('role:Urus Setia');

        // Route Perincian Projek (Details) - Bersarang di bawah projek
        Route::prefix('/{project}/details')->name('details.')->group(function () {
            Route::get('/create', 'createDetail')->name('create');
            Route::post('/', 'storeDetail')->name('store');
            Route::get('/{detail}/edit', 'editDetail')->name('edit');
            Route::patch('/{detail}', 'updateDetail')->name('update');
            Route::delete('/{detail}', 'destroyDetail')->name('destroy');
        });

        // Route Dokumen Projek - Bersarang di bawah projek
        Route::prefix('/{project}/documents')->name('documents.')->group(function () {
            Route::get('/', 'createDocument')->name('create');
            Route::post('/', 'storeDocument')->name('store');
            Route::delete('/{type}', 'destroyDocument')->name('destroy');
        });

        // Route Pegawai Projek - Bersarang di bawah projek
        Route::prefix('/{project}/officer')->name('officer.')->group(function () {
            Route::get('/create', 'createOfficer')->name('create');
            Route::post('/', 'storeOfficer')->name('store');
            Route::delete('/', 'destroyOfficer')->name('destroy');
        });
            // (submission handled via officer form, no extra routes needed)
        });

        Route::resource('meetings', MeetingController::class)->except(['show'])->middleware('role:Urus Setia');

});