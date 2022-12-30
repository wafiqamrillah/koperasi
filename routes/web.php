<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('splade')->group(function () {
    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::get('/', function () {
        return redirect()->route('dashboard.index');
    });

    Route::middleware('auth')->group(function () {
        // Dashboard
        Route::resource('dashboard', DashboardController::class)->only('index')->middleware(['verified']);

        // Profile
        Route::name('profile')->prefix('profile')->group(function () {
            Route::get(NULL, [ProfileController::class, 'edit'])->name('.edit');
            Route::patch(NULL, [ProfileController::class, 'update'])->name('.update');
            Route::delete(NULL, [ProfileController::class, 'destroy'])->name('.destroy');
        });

        // Settings
        Route::name('settings')->prefix('settings')->group(function () {
            Route::get(NULL, [System\SettingController::class, 'edit'])->name('.edit');
            Route::patch(NULL, [System\SettingController::class, 'update'])->name('.update');
        });
    });

    require __DIR__.'/auth.php';
});
