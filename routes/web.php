<?php

use App\Http\Controllers\ApplicationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [ApplicationController::class,'index'])->name('application.index');
Route::post('/store', [ApplicationController::class,'store'])->name('application.store');
Route::get('/msg', [ApplicationController::class,'msg'])->name('application.msg');
Route::post('/checkEmail', [ApplicationController::class,'checkEmail'])->name('application.checkEmail');

require __DIR__.'/dashboard.php';
