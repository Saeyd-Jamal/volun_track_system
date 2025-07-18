<?php

use App\Http\Controllers\ApplicationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => '',
    'as' => 'application.',
],function(){
    Route::get('/', [ApplicationController::class,'index'])
        ->name('index')
        ->middleware('check.form.open');

    Route::post('/store', [ApplicationController::class,'store'])
        ->name('store');

    Route::get('/msg/{msg_type}', [ApplicationController::class,'msg'])
        ->name('msg');

    Route::post('/checkEmail', [ApplicationController::class,'checkEmail'])
        ->name('checkEmail');
});

require __DIR__.'/dashboard.php';
