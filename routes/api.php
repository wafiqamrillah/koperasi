<?php

namespace App\Http\Controllers\ApiControllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name('api.')->group(function() {
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    
    // Master
    Route::prefix('master')->name('master.')->group(function() {
        // Employee
        Route::apiResource('employee', Master\Employee\EmployeeController::class)->only('index');
    });
});