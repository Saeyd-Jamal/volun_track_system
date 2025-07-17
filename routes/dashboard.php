<?php


// dashboard routes

use App\Http\Controllers\Dashboard\ActivityLogController;
use App\Http\Controllers\Dashboard\ConstantController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', function () {
    return redirect()->route('dashboard.home');
});

Route::group([
    'prefix' => 'dashboard',
    'middleware' => ['auth'],
    'as' => 'dashboard.'
], function () {
    /* ********************************************************** */

    // Dashboard ************************
    Route::get('/home', [HomeController::class,'index'])->name('home');

    // Logs ************************
    Route::get('logs',[ActivityLogController::class,'index'])->name('logs.index');
    Route::get('getLogs',[ActivityLogController::class,'getLogs'])->name('logs.getLogs');

    // users ************************
    Route::get('profile/settings',[UserController::class,'settings'])->name('profile.settings');

    /* ********************************************************** */

    // Resources
    Route::resource('constants', ConstantController::class)->only(['index','store','destroy']);

    Route::resources([
        'users' => UserController::class,
    ]);
    /* ********************************************************** */
});
