<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\avaliacao;
use App\Models\categoria;
use App\Models\comentario;
use App\Models\curtida;
use App\Models\curtidaComentario;
use App\Models\curtidaResposta;
use App\Models\favorito;
use App\Models\fotoReceita;
use App\Models\nacionalidade;
use App\Models\notificacao;
use App\Models\receita;
use App\Models\receitaIngrediente;
use App\Models\resposta;
use App\Models\sabor;
use App\Models\userMissoe;
use App\Models\visualizacao;
use Carbon\Carbon;
use DateTimeZone;
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
            'nacionalidade' => 'required|min:4',
            'ingrediente' => 'required',
            'sabor' => 'required'
        ]);

        $linha = new receita();
        $linha->titulo_receita = $request->titulo;
        $linha->modo_preparo = nl2br($request->preparo);
        $linha->tempo_preparo = $request->tempo;
        $linha->qtde_porcoes = $request->qtde_porcoes;
        $linha->data_postagem = Carbon::today(new DateTimeZone('America/Sao_Paulo'));
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

        $nacio = nacionalidade::where('nacionalidade', 'LIKE', "$request->nacionalidade%")->first();
        if(isset($nacio->id)){
            $linha->nacionalidade_id = $nacio->id;
        }
        else{
            $linha->nacionalidade_id = 8;
        }

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
        
        $missao_tres = userMissoe::where('user_id', Auth::user()->id)->where('missao', 3)->first();
        if(!isset($missao_tres->id)){
            $terceira_completa = new userMissoe();
            $terceira_completa->user_id = Auth::user()->id;
            $terceira_completa->missao = 3;
            $terceira_completa->save();
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
        $linha->data_postagem = Carbon::today(new DateTimeZone('America/Sao_Paulo'));
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

            $favoritadas = favorito::where('receita_id', $request->id)->get();
            foreach($favoritadas as $f){
                $f->delete();
            }

            $curtidas = curtida::where('receita_id', $request->id)->get();
            foreach($curtidas as $c){
                $c->delete();
            }
        }
        else{
            $linha->escondida = 0;
        }

        $nacio = nacionalidade::where('nacionalidade', 'LIKE', "$request->nacionalidade%")->first();
        if(isset($nacio->id)){
            $linha->nacionalidade_id = $nacio->id;
        }
        else{
            $linha->nacionalidade_id = 8;
        }
        
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

        $receita = receita::with('ingrediente', 'foto', 'comentario.usuario', 'comentario.respostas.usuario')
        ->findOrFail($request->id);

        foreach($receita->ingrediente as $ingrediente){
            $completo[] = $ingrediente->ingrediente;
        }
        
        return view('receitas.visualizar_receitas', compact("sabores", "categorias", "receita", "completo"));
    }

    public function visualizar_receita_escondida(Request $request)
    {
        $sabores = sabor::get();
        $categorias = categoria::get();
        
        $receita = \App\Models\receita::withoutGlobalScope(\App\Scopes\ReceitaScope::class)
        ->with('ingrediente', 'foto', 'comentario.usuario', 'comentario.respostas.usuario')
        ->findOrFail($request->id);

        return view('receitas.visualizar_receitas', compact("sabores", "categorias", "receita"));
    }

    public function curtir_receita(Request $request)
    {
        $curtida = new curtida();
        $curtida->receita_id = $request->id;
        $curtida->user_id = Auth::user()->id;
        $curtida->save();

        $receita = receita::findOrFail($request->id);

        notificacao::create([
            'user_id' => $receita->user_id,
            'notificacao' => Auth::user()->name . ' curtiu a sua receita: ' . $receita->titulo_receita,
            'lido' => 0
        ]);
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
        $curtida = curtida::where('receita_id', $request->id)
        ->where('user_id', Auth::user()->id)
        ->first();

        $curtida->delete();
    }

    public function desfavoritar_receita(Request $request)
    {
        $favorito = favorito::where('receita_id', $request->id)
        ->where('user_id', Auth::user()->id)
        ->first();

        $favorito->delete();
    }

    public function comentar_receita(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'comentario' => 'required|max:1500'
        ]);

        $linha = new comentario();
        $linha->data_comentario = Carbon::now(new DateTimeZone('America/Sao_Paulo'));
        $linha->user_id = Auth::user()->id;
        $linha->receita_id = $request->id;
        $linha->comentario = nl2br($request->comentario);
        $linha->save();

        $receita = \App\Models\receita::withoutGlobalScope(\App\Scopes\ReceitaScope::class)->findOrFail($request->id);

        notificacao::create([
            'user_id' => $receita->user_id,
            'notificacao' => Auth::user()->name . ' comentou na sua receita: ' . $receita->titulo_receita,
            'lido' => 0
        ]);

        if($receita->escondida == 1){
            return redirect()->route('visualizar_receita_escondida', ['id' => $request->id, 'comentado' => 'comentado']);
        }
        else{
            return redirect()->route('visualizar_receitas', ['id' => $request->id, 'comentado' => 'comentado']);
        }
    }

    public function responder_comentario(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'resposta' => 'required|max:1500',
            'comentario_id' => 'required'
        ]);

        $linha = new resposta();
        $linha->resposta = nl2br($request->resposta);
        $linha->comentario_id = $request->comentario_id;
        $linha->data_resposta = Carbon::now(new DateTimeZone('America/Sao_Paulo'));
        $linha->user_id = Auth::user()->id;
        $linha->save();

        $comentario = comentario::findOrFail($request->comentario_id);
        $receita = \App\Models\receita::withoutGlobalScope(\App\Scopes\ReceitaScope::class)->findOrFail($comentario->receita_id);

        notificacao::create([
            'user_id' => $comentario->user_id,
            'notificacao' => Auth::user()->name . ' respondeu o seu comentario na receita: ' . $receita->titulo_receita . " '$comentario->comentario'",
            'lido' => 0
        ]);
    }

    public function visualizar_comentario_edicao(Request $request)
    {
        $linha = comentario::findOrFail($request->id);
        
        return view('receitas.visualizacao.editar_comentario', compact('linha'));
    }

    public function editar_comentario(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'comentario' => 'required|max:1500'
        ]);

        $linha = comentario::findOrFail($request->id);
        $linha->comentario = nl2br($request->comentario);
        $linha->update();

        return back();
    }

    public function excluir_comentario(Request $request)
    {
        $linha = comentario::findOrFail($request->id);

        $respostas = resposta::where('comentario_id', $linha->id)->get();
        foreach($respostas as $resposta){
            $curitda_resposta = curtidaResposta::where('resposta_id', $resposta->id)->first();
            $curitda_resposta->delete();

            $resposta->delete();
        }

        $curtidas = curtidaComentario::where('comentario_id', $linha->id)->get();
        foreach($curtidas as $c){
            $c->delete();
        }

        $linha->delete();
    }

    public function compartilhar_receita()
    {
        $missao_quatro = userMissoe::where('user_id', Auth::user()->id)->where('missao', 4)->first();
        if(!isset($missao_quatro->id)){
            $quarta_completa = new userMissoe();
            $quarta_completa->user_id = Auth::user()->id;
            $quarta_completa->missao = 4;
            $quarta_completa->save();
        }
    }

    public function compartilhar_receita_escondida(Request $request)
    {
        $receita = \App\Models\receita::withoutGlobalScope(\App\Scopes\ReceitaScope::class)->findOrFail($request->id);
        $receita->token_acesso = $request->token;
        $receita->data_token_validade = Carbon::tomorrow();
        $receita->update();

        $missao_quatro = userMissoe::where('user_id', Auth::user()->id)->where('missao', 4)->first();
        if(!isset($missao_quatro->id)){
            $quarta_completa = new userMissoe();
            $quarta_completa->user_id = Auth::user()->id;
            $quarta_completa->missao = 4;
            $quarta_completa->save();
        }
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
            $respostas = resposta::where('comentario_id', $comentario->id)->first();
            if(isset($respostas->id)){
                $curtida_resposta = curtidaResposta::where('resposta_id', $respostas->id)->first();
                if(isset($curtida_resposta->id)){
                    $curtida_resposta->delete();
                }
                $respostas->delete();
            }

            $curtida_comentario = curtidaComentario::where('comentario_id', $comentario->id)->first();
            if(isset($curtida_comentario->id)){
                $curtida_comentario->delete();
            }

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

        return redirect()->route('profile', ['id' => Auth::user()->id]);
    }

    public function curtir_comentario(Request $request)
    {
        $curtida = new curtidaComentario();
        $curtida->comentario_id = $request->id;
        $curtida->user_id = Auth::user()->id;
        $curtida->save();
        
        $comentario = comentario::findOrFail($request->id);
        $receita = \App\Models\receita::withoutGlobalScope(\App\Scopes\ReceitaScope::class)->findOrFail($comentario->receita_id);

        notificacao::create([
            'user_id' => $comentario->user_id,
            'notificacao' => Auth::user()->name . ' curtiu o seu comentario na receita: ' . $receita->titulo_receita . " '$comentario->comentario'",
            'lido' => 0
        ]);
    }

    public function descurtir_comentario(Request $request)
    {
        $curtida = curtidaComentario::where('comentario_id', $request->id)
        ->where('user_id', Auth::user()->id)
        ->first();

        $curtida->delete();
    }

    public function curtir_resposta(Request $request)
    {
        $curtida = new curtidaResposta();
        $curtida->resposta_id = $request->id;
        $curtida->user_id = Auth::user()->id;
        $curtida->save();

        $resposta = \App\Models\receita::withoutGlobalScope(\App\Scopes\ReceitaScope::class)->findOrFail($request->id);

        notificacao::create([
            'user_id' => $resposta->user_id,
            'notificacao' => Auth::user()->name . ' curtiu a sua resposta: ' . "'$resposta->resposta'",
            'lido' => 0
        ]);
    }

    public function descurtir_resposta(Request $request)
    {
        $curtida = curtidaResposta::where('resposta_id', $request->id)
        ->where('user_id', Auth::user()->id)
        ->first();

        $curtida->delete();
    }

    public function excluir_resposta(Request $request)
    {
        $resposta = resposta::findOrFail($request->id);

        $curtidas = curtidaResposta::where('resposta_id', $resposta->id)
        ->where('user_id', Auth::user()->id)
        ->get();

        foreach($curtidas as $c){
            $c->delete();
        }

        $resposta->delete();
    }

    public function visualizar_resposta_edicao(Request $request)
    {
        $linha = resposta::findOrFail($request->id);
        
        return view('receitas.visualizacao.editar_resposta', compact('linha'));
    }

    public function editar_resposta(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'resposta' => 'required|max:1500'
        ]);

        $linha = resposta::findOrFail($request->id);
        $linha->resposta = nl2br($request->resposta);
        $linha->update();

        return back();
    }
}
