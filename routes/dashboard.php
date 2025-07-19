<?php


// dashboard routes

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ReviewController;
use App\Http\Controllers\Dashboard\ConstantController;
use App\Http\Controllers\Dashboard\ActivityLogController;
use App\Http\Controllers\Dashboard\FormSettingController;
use App\Http\Controllers\Dashboard\SpecializationController;

Route::get('dashboard', function () {
    return redirect()->route('dashboard.home');
});

Route::group([
    'prefix' => 'dashboard',
    'middleware' => ['auth', 'check.specialization.active'],
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


    //Setting
   Route::get('/form-settings/edit', [FormSettingController::class, 'edit'])->name('form-settings.edit');
   Route::post('/form-settings/update', [FormSettingController::class, 'update'])->name('form-settings.update');

   //constant
   Route::get('/constants/edit', [ConstantController::class, 'edit'])->name('constants.edit');
   Route::post('/constants/update', [ConstantController::class, 'update'])->name('constants.update');

    Route::resources([
        'users' => UserController::class,
        'specializations' => SpecializationController::class,
    ]);
    /* ********************************************************** */
});
