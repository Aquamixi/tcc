<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\categoria;
use App\Models\receita;
use App\Models\receitaIngrediente;
use App\Models\sabor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function cadastrar_receita(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'preparo' => 'required',
            'tempo' => 'required',
            'qtde_porcoes' => 'required',
            'categoria' => 'required',
            'nacionalidade' => 'required',
            'sabor' => 'required',
            'ingrediente' => 'required',
            'titulo' => 'required',
        ]);

        $linha = new receita();
        $linha->titulo_receita = $request->titulo;
        $linha->modo_preparo = $request->preparo;
        $linha->tempo_preparo = $request->tempo;
        $linha->qtde_porcoes = $request->qtde_porcoes;
        $linha->data_postagem = Carbon::today();
        $linha->user_id = Auth::user()->id;
        $linha->categoria_id = $request->categoria;
        $linha->mais_dezoito = $request->mais_dezoito;
        $linha->nacionalidade_id = $request->nacionalidade;
        $linha->sabor_id = $request->sabor;

        if($request->tempo >= 0 and $request->tempo <= 15){
            $linha->velocidade_id = 1;
        }
        elseif($request->tempo > 15 and $request->tempo <= 45){
            $linha->velocidade_id = 2;
        }
        else{
            $linha->velocidade_id = 3;
        }

        $linha->save();

        $id = $linha->id;

        $ingredientes = explode(',', $request->ingrediente);

        foreach($ingredientes as $ingrediente){
            $cria_ingrediente = new receitaIngrediente();
            $cria_ingrediente->ingrediente = $ingrediente;
            $cria_ingrediente->receita_id = $id;
            $cria_ingrediente->save();
        }
    }
}
