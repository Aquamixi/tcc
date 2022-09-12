<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\avaliacao;
use App\Models\categoria;
use App\Models\comentario;
use App\Models\curtida;
use App\Models\favorito;
use App\Models\fotoReceita;
use App\Models\nacionalidade;
use App\Models\receita;
use App\Models\receitaIngrediente;
use App\Models\resposta;
use App\Models\sabor;
use App\Models\visualizacao;
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
        $br = nacionalidade::where('nacionalidade', 'brasileira')->orderBy('nacionalidade', 'asc')->get();
        $resto = nacionalidade::where('nacionalidade', '<>', 'brasileira')->orderBy('nacionalidade', 'asc')->get();
        $nacionalidades = $br->union($resto);
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
        $linha->modo_preparo = nl2br($request->preparo);
        $linha->tempo_preparo = $request->tempo;
        $linha->qtde_porcoes = $request->qtde_porcoes;
        $linha->data_postagem = Carbon::today();
        $linha->user_id = Auth::user()->id;
        $linha->categoria_id = $request->categoria;
        $linha->descricao = nl2br($request->descricao);
        if($request->mais_dezoito){
            $linha->mais_dezoito = 1;
        }
        else{
            $linha->mais_dezoito = 0;
        }
        if($request->escondida){
            $linha->escondida = 1;
        }
        else{
            $linha->escondida = 0;
        }

        $nacio = nacionalidade::where('nacionalidade', $request->nacionalidade)->first();
        $linha->nacionalidade_id = $nacio->id;

        $linha->sabor_id = $request->sabor;

        if($request->tempo >= 0 and $request->tempo <= 30){
            $linha->velocidade_id = 1;
        }
        elseif($request->tempo > 30 and $request->tempo <= 60){
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
            $cria_ingrediente->ingrediente = trim($ingrediente);
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
    
    public function editar_receitas(Request $request)
    {
        $br = nacionalidade::where('nacionalidade', 'brasileira')->orderBy('nacionalidade', 'asc')->get();
        $resto = nacionalidade::where('nacionalidade', '<>', 'brasileira')->orderBy('nacionalidade', 'asc')->get();

        $nacionalidades = $br->union($resto);

        $sabores = sabor::get();
        $categorias = categoria::get();
        $linha = \App\Models\receita::withoutGlobalScope(\App\Scopes\ReceitaScope::class)->findOrFail($request->id);

        $val_des = $linha->pluck('descricao');
        $modo_preparo = $linha->pluck('modo_preparo');

        foreach($linha->ingrediente as $ingrediente){
            $completo[] = $ingrediente->ingrediente;
        }

        return view('receitas.editar_receitas', compact("sabores", "categorias", "nacionalidades", "linha", 'completo', "val_des", "modo_preparo"));
    }

    public function editar_receita(Request $request)
    {
        $request->validate([
            'id' => 'required',
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

        $linha = \App\Models\receita::withoutGlobalScope(\App\Scopes\ReceitaScope::class)->findOrFail($request->id);
        $linha->titulo_receita = $request->titulo;
        $linha->modo_preparo = nl2br($request->preparo);
        $linha->tempo_preparo = $request->tempo;
        $linha->qtde_porcoes = $request->qtde_porcoes;
        $linha->data_postagem = Carbon::today();
        $linha->user_id = Auth::user()->id;
        $linha->categoria_id = $request->categoria;
        $linha->descricao = nl2br($request->descricao);
        if($request->mais_dezoito){
            $linha->mais_dezoito = 1;
        }
        else{
            $linha->mais_dezoito = 0;
        }
        if($request->escondida){
            $linha->escondida = 1;
        }
        else{
            $linha->escondida = 0;
        }

        $nacio = nacionalidade::where('nacionalidade', $request->nacionalidade)->first();
        $linha->nacionalidade_id = $nacio->id;

        $linha->sabor_id = $request->sabor;

        if($request->tempo >= 0 and $request->tempo <= 30){
            $linha->velocidade_id = 1;
        }
        elseif($request->tempo > 30 and $request->tempo <= 60){
            $linha->velocidade_id = 2;
        }
        else{
            $linha->velocidade_id = 3;
        }

        $linha->update();

        $id = $linha->id;

        $last_ingredientes = receitaIngrediente::where('receita_id', $request->id)->get();
        foreach($last_ingredientes as $i){
            $i->delete();
        }

        $ingredientes = explode(',', $request->ingrediente);

        foreach($ingredientes as $ingrediente){
            $cria_ingrediente = new receitaIngrediente();
            $cria_ingrediente->ingrediente = trim($ingrediente);
            $cria_ingrediente->receita_id = $id;
            $cria_ingrediente->save();
        }

        if($request->imagem){
            $last_imagem = fotoReceita::where('receita_id', $request->id)->first();
            if(isset($last_imagem)){
                $last_imagem->delete();
            }

            $linha_receita_foto = new fotoReceita();

            $request_imagem = $request->imagem;

            $ext = $request_imagem->extension();
            
            $nome_imagem = $request_imagem->getClientOriginalName() . uniqid() . '.' . $ext;

            $request_imagem->move(public_path('foto_receitas'), $nome_imagem);

            $linha_receita_foto->receita_id = $id;
            $linha_receita_foto->anexo = $nome_imagem;
            $linha_receita_foto->save();
        }

        return redirect()->route('home', ['confirm' => 'receita_editada']);
    }

    public function visualizar_receitas(Request $request)
    {
        $sabores = sabor::get();
        $categorias = categoria::get();
        
        $receita = receita::findOrFail($request->id);

        return view('receitas.visualizar_receitas', compact("sabores", "categorias", "receita"));
    }

    public function visualizar_receita_escondida(Request $request)
    {
        $sabores = sabor::get();
        $categorias = categoria::get();
        
        $receita = \App\Models\receita::withoutGlobalScope(\App\Scopes\ReceitaScope::class)->findOrFail($request->id);

        return view('receitas.visualizar_receitas', compact("sabores", "categorias", "receita"));
    }

    public function curtir_receita(Request $request)
    {
        $curtida = new curtida();
        $curtida->receita_id = $request->id;
        $curtida->user_id = Auth::user()->id;
        $curtida->save();
    }

    public function favoritar_receita(Request $request)
    {
        $favorito = new favorito();
        $favorito->receita_id = $request->id;
        $favorito->user_id = Auth::user()->id;
        $favorito->save();
    }

    public function descurtir_receita(Request $request)
    {
        $curtida = curtida::where('receita_id', $request->id)->first();
        $curtida->delete();
    }

    public function desfavoritar_receita(Request $request)
    {
        $favorito = favorito::where('receita_id', $request->id)->first();
        $favorito->delete();
    }

    public function comentar_receita(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'comentario' => 'required'
        ]);

        $linha = new comentario();
        $linha->data_comentario = Carbon::today();
        $linha->user_id = Auth::user()->id;
        $linha->receita_id = $request->id;
        $linha->comentario = nl2br($request->comentario);
        $linha->save();

        return redirect()->route('visualizar_receitas', ['id' => $request->id]);
    }

    public function editar_comentario(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'comentario' => 'required'
        ]);

        $linha = comentario::findOrFail($request->id);
        $linha->comentario = nl2br($request->comentario);
        $linha->update();

        return redirect()->route('visualizar_receitas', ['id' => $request->id]);
    }

    public function deletar_comentario(Request $request)
    {
        $linha = comentario::findOrFail($request->id);
        $respostas = resposta::where('comentario_id', $request->id)->get();
        foreach($respostas as $resposta){
            $resposta->delete();
        }
        $linha->delete();

        return redirect()->route('visualizar_receitas', ['id' => $request->id]);
    }

    public function compartilhar_receita_escondida(Request $request)
    {
        $receita = \App\Models\receita::withoutGlobalScope(\App\Scopes\ReceitaScope::class)->findOrFail($request->id);
        $receita->token_acesso = $request->token;
        $receita->data_token_validade = Carbon::tomorrow();
        $receita->update();
    }

    public function avaliar_receita(Request $request)
    {
        $receita = \App\Models\receita::withoutGlobalScope(\App\Scopes\ReceitaScope::class)->findOrFail($request->id);

        $last_avaliacao = avaliacao::where('receita_id', $receita->id)
        ->where('user_id', Auth::user()->id)
        ->first();

        if(isset($last_avaliacao->qtde)){
            $avaliacao = avaliacao::findOrFail($last_avaliacao->id);
            $avaliacao->qtde = $request->value;
            $avaliacao->save();
        }
        else{
            $avaliacao = new avaliacao();
            $avaliacao->user_id = Auth::user()->id;
            $avaliacao->receita_id = $receita->id;
            $avaliacao->qtde = $request->value;
            $avaliacao->save();
        }

        $avaliacaos = avaliacao::where('receita_id', $receita->id)->get();
        $total = $avaliacaos->sum('qtde') / $avaliacaos->count();

        $receita->avaliacao = $total;
        $receita->update();
    }

    public static function excluir_receita(Request $request)
    {
        $curtidas = curtida::where('receita_id', $request->id)->get();
        foreach($curtidas as $curtida){
            $curtida->delete();
        }

        $favoritas = favorito::where('receita_id', $request->id)->get();
        foreach($favoritas as $favorita){
            $favorita->delete();
        }

        $comentarios = comentario::where('receita_id', $request->id)->get();
        foreach($comentarios as $comentario){
            $comentario->delete();
        }

        $avaliacaos = avaliacao::where('receita_id', $request->id)->get();
        foreach($avaliacaos as $avaliacao){
            $avaliacao->delete();
        }

        $ingredientes = receitaIngrediente::where('receita_id', $request->id)->get();
        foreach($ingredientes as $ingrediente){
            $ingrediente->delete();
        }

        $foto = fotoReceita::where('receita_id', $request->id)->get();
        foreach($foto as $f){
            $f->delete();
        }

        $views = visualizacao::where('receita_id', $request->id)->get();
        foreach($views as $view){
            $view->delete();
        }

        $receita = \App\Models\receita::withoutGlobalScope(\App\Scopes\ReceitaScope::class)->findOrFail($request->id);
        $receita->delete();
    }
}
