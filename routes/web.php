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

Route::get('visualizar_receitas/{id}', [App\Http\Controllers\ReceitaController::class, 'visualizar_receitas'])->name('visualizar_receitas');
Route::get('visualizar_receita_escondida/{id}', [App\Http\Controllers\ReceitaController::class, 'visualizar_receita_escondida'])->name('visualizar_receita_escondida');

Route::post('curtir_receita', [App\Http\Controllers\ReceitaController::class, 'curtir_receita']);
Route::post('favoritar_receita', [App\Http\Controllers\ReceitaController::class, 'favoritar_receita']);
Route::post('descurtir_receita', [App\Http\Controllers\ReceitaController::class, 'descurtir_receita']);
Route::post('desfavoritar_receita', [App\Http\Controllers\ReceitaController::class, 'desfavoritar_receita']);
Route::post('comentar_receita', [App\Http\Controllers\ReceitaController::class, 'comentar_receita']);
Route::post('editar_comentario', [App\Http\Controllers\ReceitaController::class, 'editar_comentario']);
Route::post('deletar_comentario', [App\Http\Controllers\ReceitaController::class, 'deletar_comentario']);

Route::post('definir_first_login', [App\Http\Controllers\UserController::class, 'definir_first_login']);

Route::post('editar_usuario', [App\Http\Controllers\UserController::class, 'editar_usuario'])->name('editar_usuario');

Route::post('seguir', [App\Http\Controllers\UserController::class, 'seguir']);
Route::post('deixar_seguir', [App\Http\Controllers\UserController::class, 'deixar_seguir']);

Route::get('profile/{id}', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
Route::get('amigos/{id}', [App\Http\Controllers\UserController::class, 'amigos']);
