<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'home']);
Route::get('home', [App\Http\Controllers\HomeController::class, 'home']);
Route::get('home/teste', [App\Http\Controllers\HomeController::class, 'teste']);
