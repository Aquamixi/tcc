<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'home']);
Route::get('home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Route::get('criar_receitas', [App\Http\Controllers\ReceitaController::class, 'tela_receitas']);
Route::post('cadastrar_receita', [App\Http\Controllers\ReceitaController::class, 'cadastrar_receita'])->name('cadastrar_receita');
Route::get('visualizar_receitas', [App\Http\Controllers\ReceitaController::class, 'visualizar_receitas']);
Route::post('definir_first_login', [App\Http\Controllers\UserController::class, 'definir_first_login']);
