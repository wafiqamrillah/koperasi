<?php

namespace App\Http;

use Illuminate\Support\Facades\Route;

// Authentication routes
Route::get('/', [Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Password
Route::prefix('password')->name('password')->group(function () {
    Route::get('reset', [Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('.request');
    Route::post('email', [Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('.email');
    Route::get('reset/{token}', [Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('.reset');
    Route::post('reset', [Controllers\Auth\ResetPasswordController::class, 'reset'])->name('.update');
});

// Email verification
Route::prefix('email')->name('verification')->group(function () {
    Route::get('verify', [Controllers\Auth\VerificationController::class, 'show'])->name('.notice');
    Route::get('verify/{id}/{hash}', [Controllers\Auth\VerificationController::class, 'verify'])->name('.verify');
    Route::post('resend', [Controllers\Auth\VerificationController::class, 'resend'])->name('.resend');
});

// Accepted invitations
Route::get('accepted-invitations/create', Livewire\AcceptedInvitationComponent::class)
    ->name('accepted-invitations.create');

// Confirmed emails
Route::get('confirmed-emails/store', [Controllers\ConfirmedEmailController::class, 'store'])
    ->name('confirmed-emails.store');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('home', [Controllers\HomeController::class, 'index'])->name('home.index');

    Route::prefix('profile')->name('profile')->group(function () {
        Route::get('/', [Controllers\Profile\UserController::class, 'index'])->name('.users.index');
    });

    Route::middleware('authorization')->group(function () {
        Route::prefix('users')->name('users')->group(function () {
            Route::get('/', Livewire\IndexUserComponent::class)->name('.index');
            Route::get('create', Livewire\CreateUserComponent::class)->name('.create');
            Route::get('{user}/edit', Livewire\EditUserComponent::class)->name('.edit');
        });

        Route::prefix('roles')->name('roles')->group(function () {
            Route::get('/', Livewire\IndexRoleComponent::class)->name('.index');
            Route::get('create', Livewire\CreateRoleComponent::class)->name('.create');
            Route::get('{role}/edit', Livewire\EditRoleComponent::class)->name('.edit');
        });
    });
});
