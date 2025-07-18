<?php


// dashboard routes

use App\Http\Controllers\Dashboard\ActivityLogController;
use App\Http\Controllers\Dashboard\ConstantController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\ReviewController;
use App\Http\Controllers\Dashboard\SpecializationController;
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
    // Reviewer
    // Route::middleware(['auth', 'check.specialization.active'])->group(function () {
    //     Route::get('/reviewer/requests', [ReviewerController::class, 'index'])->name('reviewer.requests');
    // });
    Route::get('/reviewers', [ReviewController::class, 'index'])->name('reviewers.index');
    Route::get('/reviewers/{id}', [ReviewController::class, 'show'])->name('reviewers.show'); // تفاصيل للـ AJAX
    Route::post('/reviewers/{id}/decision', [ReviewController::class, 'decision'])->name('reviewers.decision'); // POST لموافقة/رفض

    // Resources
    Route::resource('constants', ConstantController::class)->only(['index','store','destroy']);

    Route::resources([
        'users' => UserController::class,
        'specializations' => SpecializationController::class,
    ]);
    /* ********************************************************** */
});
