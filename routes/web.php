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
        Route::middleware(['verified'])->group(function () {
            // Dashboard
            Route::resource('dashboard', DashboardController::class)->only('index');

            // Notifications
            Route::name('notifications.')->prefix('notifications')->group(function() {
                // Route::resource(NULL, System\NotificationController::class)->only('index');
                Route::get('get', System\GetNotificationController::class)->name('get');
            });
        });

        // Profile
        Route::name('profile')->prefix('profile')->group(function () {
            Route::get(NULL, [ProfileController::class, 'edit'])->name('.edit');
            Route::patch(NULL, [ProfileController::class, 'update'])->name('.update');
            Route::delete(NULL, [ProfileController::class, 'destroy'])->name('.destroy');
        });

        // Masters
        Route::name('master')->prefix('master')->group(function() {
            Route::name('.')->group(function() {
                // Members
                Route::prefix('members')->name('members.')->group(function() {
                    Route::get('import', [Master\Member\MemberController::class, 'import'])->name('import');
                    Route::post('importing', [Master\Member\MemberController::class, 'importing'])->name('importing');
                    Route::get('{member}/delete', [Master\Member\MemberController::class, 'delete'])->name('delete');
                });
                Route::resource('members', Master\Member\MemberController::class);

                // Products
                Route::prefix('products')->name('products.')->group(function() {
                    // Product Categories
                    Route::prefix('categories')->name('categories.')->group(function() {
                        Route::get('{category}/delete', [Master\Product\ProductCategoryController::class, 'delete'])->name('delete');
                    });
                    Route::resource('categories', Master\Product\ProductCategoryController::class);

                    Route::get('{product}/delete', [Master\Product\ProductController::class, 'delete'])->name('delete');
                });
                Route::resource('products', Master\Product\ProductController::class);

                // Units
                Route::prefix('units')->name('units.')->group(function() {
                    Route::prefix('types')->name('types.')->group(function() {
                        Route::get('{type}/delete', [Master\Unit\UnitTypeController::class, 'delete'])->name('delete');
                    });
                    Route::resource('types', Master\Unit\UnitTypeController::class);

                    Route::get('{unit}/delete', [Master\Unit\UnitController::class, 'delete'])->name('delete')->withTrashed();
                });
                Route::resource('units', Master\Unit\UnitController::class)->withTrashed();
            });
        });

        // Settings
        Route::name('settings.')->prefix('settings')->group(function () {
            Route::get(NULL, [System\SettingController::class, 'edit'])->name('edit')->middleware('can:access settings');
            Route::patch(NULL, [System\SettingController::class, 'update'])->name('update')->middleware('can:update settings');

            // Users
            Route::resource('users', System\UserController::class)->middleware('can:access user settings');
        });
    });

    require __DIR__.'/auth.php';
});
