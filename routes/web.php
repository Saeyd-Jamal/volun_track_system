<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {return view('index');})->name('home');


require __DIR__.'/dashboard.php';
