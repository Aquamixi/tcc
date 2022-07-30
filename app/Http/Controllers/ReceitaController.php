<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\categoria;
use App\Models\nacionalidade;
use App\Models\sabor;
use App\Models\subCategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        
        $nacionalidades = nacionalidade::orderBy('nacionalidade', 'asc')->get();
        $sabores = sabor::get();
        $categorias = categoria::get();
        $subcategorias = subCategoria::get();
        return view('criar_receitas', compact("sabores", "categorias", "nacionalidades", "subcategorias"));
    }
    
    public function visualizar_receitas(Request $request)
    {
        $sabores = sabor::get();
        $categorias = categoria::get();

        return view('visualizar_receitas', compact("sabores", "categorias"));
    }

    public function cadastrar_receita(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->route('home', []);
        }
        return $request->teste;
    }
    
}
