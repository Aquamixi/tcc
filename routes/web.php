<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\VisitanteController::class, 'home']);
Route::get('home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Route::get('criar_receitas', [App\Http\Controllers\ReceitaController::class, 'tela_receitas'])->name('tela_receitas');
Route::post('cadastrar_receita', [App\Http\Controllers\ReceitaController::class, 'cadastrar_receita'])->name('cadastrar_receita');

Route::get('editar_receitas/{id}', [App\Http\Controllers\ReceitaController::class, 'editar_receitas'])->middleware('dono_receita');
Route::post('editar_receita/{id}', [App\Http\Controllers\ReceitaController::class, 'editar_receita'])->middleware('dono_receita');

Route::get('visualizar_receitas/{id}', [App\Http\Controllers\ReceitaController::class, 'visualizar_receitas']);

Route::post('definir_first_login', [App\Http\Controllers\UserController::class, 'definir_first_login']);

Route::post('editar_usuario', [App\Http\Controllers\UserController::class, 'editar_usuario'])->name('editar_usuario');

Route::post('segue_ou_nao', [App\Http\Controllers\UserController::class, 'segue_ou_nao']);

Route::get('profile/{id}', [App\Http\Controllers\UserController::class, 'profile']);
Route::get('amigos/{id}', [App\Http\Controllers\UserController::class, 'amigos']);
