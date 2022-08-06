<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\categoria;
use App\Models\fotoReceita;
use App\Models\nacionalidade;
use App\Models\subCategoria;
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
        $nacionalidades = nacionalidade::orderBy('nacionalidade', 'asc')->get();
        $sabores = sabor::get();
        $categorias = categoria::get();

        return view('receitas.criar_receitas', compact("sabores", "categorias", "nacionalidades"));
    }

    public function cadastrar_receita(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'preparo' => 'required',
            'tempo' => 'required',
            'qtde_porcoes' => 'required',
            'categoria' => 'required',
            'descricao' => 'required',
            'nacionalidade' => 'required',
            'ingrediente' => 'required',
            'sabor' => 'required'
        ]);

        $linha = new receita();
        $linha->titulo_receita = $request->titulo;
        $linha->modo_preparo = $request->preparo;
        $linha->tempo_preparo = $request->tempo;
        $linha->qtde_porcoes = $request->qtde_porcoes;
        $linha->data_postagem = Carbon::today();
        $linha->user_id = Auth::user()->id;
        $linha->categoria_id = $request->categoria;
        $linha->descricao = $request->descricao;
        if($request->mais_dezoito){
            $linha->mais_dezoito = 1;
        }
        else{
            $linha->mais_dezoito = 0;
        }
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

        if($request->imagem){
            $linha_receita_foto = new fotoReceita();

            $request_imagem = $request->imagem;

            $ext = $request_imagem->extension();
            
            $nome_imagem = $request_imagem->getClientOriginalName() . uniqid() . '.' . $ext;

            $request_imagem->move(public_path('foto_receitas'), $nome_imagem);

            $linha_receita_foto->receita_id = $id;
            $linha_receita_foto->anexo = $nome_imagem;
            $linha_receita_foto->save();

        }

        return redirect()->route('home', ['confirm' => 'receita_cadastrada']);
    }
    

    public function visualizar_receitas(Request $request)
    {
        $sabores = sabor::get();
        $categorias = categoria::get();

        return view('receitas.visualizar_receitas', compact("sabores", "categorias"));
    }
}
