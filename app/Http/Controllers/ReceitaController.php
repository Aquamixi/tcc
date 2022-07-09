<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\categoria;
use App\Models\sabor;
use Illuminate\Http\Request;

class ReceitaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function tela_receitas()
    {  
        $sabores = sabor::get();
        $categorias = categoria::get();
        return view('criar_receitas', compact("sabores", "categorias"));
    }
}
