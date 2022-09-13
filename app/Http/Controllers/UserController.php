<?php

namespace App\Http\Controllers;

use App\Models\avaliacao;
use App\Models\categoria;
use App\Models\comentario;
use App\Models\curtida;
use App\Models\endereco;
use App\Models\favorito;
use App\Models\fotoUser;
use App\Models\pai;
use App\Models\receita;
use App\Models\sabor;
use App\Models\seguidor;
use App\Models\uf;
use App\Models\User;
use App\Models\UserMac;
use App\Models\userMissoe;
use App\Models\visualizacao;
use App\Scopes\ReceitaScope;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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

    public function definir_first_login(Request $request)
    {
        $user = User::findOrfail(Auth::user()->id);
        $user->first_login = $request->data;
        $user->update();
    }

    public function seguir(Request $request)
    {
        $novo_seguidor = new seguidor();
        $novo_seguidor->seguidor_id = Auth::user()->id;
        $novo_seguidor->usuario_id = $request->id;
        $novo_seguidor->status = 'Seguindo';
        $novo_seguidor->save();

        $missao_dois = userMissoe::where('user_id', Auth::user()->id)->where('missao', 2)->first();
        if(!isset($missao_dois->id)){
            $segunda_completa = new userMissoe();
            $segunda_completa->user_id = Auth::user()->id;
            $segunda_completa->missao = 2;
            $segunda_completa->save();
        }
    }

    public function deixar_seguir(Request $request)
    {
        $linha = seguidor::where('seguidor_id', Auth::user()->id)->where('usuario_id', $request->id)->first();
        $linha->delete();
    }

    public function profile(Request $request)
    {
        $seguindo = seguidor::where('seguidor_id', Auth::user()->id)->with('usuario')->get();
            
        $array_seguindo = [];
        foreach($seguindo as $s){
            $array_seguindo[] = $s->usuario_id;
        }

        $sabores = sabor::get();
        $categorias = categoria::get();

        $paises = pai::get();
        $ufs = uf::get();
        
        $usuario = User::findOrFail($request->id);
        
        $receitas = receita::where('user_id', $request->id)->get();

        $curtidas = curtida::where('user_id', $request->id)->get();

        $favoritas = favorito::where('user_id', $request->id)->get();
    
        $escondidas = \App\Models\receita::withoutGlobalScope(\App\Scopes\ReceitaScope::class)
        ->where('escondida', 1)
        ->where('user_id', $request->id)->get();

        return view('usuario.profile', compact('usuario', 'sabores', 'categorias', 'receitas', 'ufs', 'paises', 'curtidas', 'favoritas', 'escondidas', 'array_seguindo'));
    }

    public function amigos($id)
    {
        $seguindo = seguidor::where('seguidor_id', $id)->with('usuario')->get();
        $seguidores = seguidor::where('usuario_id', $id)->with('seguidor')->get();

        $meus_seguidores = seguidor::where('seguidor_id', Auth::user()->id)->with('usuario')->get();
            
        $array_seguindo = [];
        foreach($meus_seguidores as $s){
            $array_seguindo[] = $s->usuario_id;
        }

        $sabores = sabor::get();
        $categorias = categoria::get();

        return view('usuario.amigos', compact('seguindo', 'seguidores', 'array_seguindo', 'sabores', 'categorias'));
    }

    public function editar_usuario(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'senha' => 'required',
            'uf' => 'required',
            'pais' => 'required'
        ]);
        
        if(Auth::user()->endereco_id){
            $endereco = endereco::findOrFail(Auth::user()->endereco_id);
            if($request->rua){
                $endereco->rua = $request->rua;
            }
            if($request->numero){
                $endereco->numero = $request->numero;
            }
            if($request->bairro){
                $endereco->bairro = $request->bairro;
            }
            if($request->cidade){
                $endereco->cidade = $request->cidade;
            }
            if($request->cep){
                $endereco->cep = $request->cep;
            }
            if($request->uf){
                $endereco->uf_id = $request->uf;
            }
            if($request->pais){
                $endereco->pai_id = $request->pais;
            }
            $endereco->update();
        }
        else{
            $endereco = new endereco();
            $endereco->rua = $request->rua;
            $endereco->numero = $request->numero;
            $endereco->bairro = $request->bairro;
            $endereco->cidade = $request->cidade;
            $endereco->cep = $request->cep;
            $endereco->uf_id = $request->uf;
            $endereco->pai_id = $request->pais;
            $endereco->save();
            $endereco_id = $endereco->id;

            $user = User::findOrFail(Auth::user()->id);
            $user->endereco_id = $endereco_id;
            $user->update();
        }
        
        $user = User::findOrFail(Auth::user()->id);
        
        $user->name = $request->nome;
        $user->email = $request->email;
        $user->password = Hash::make($request->senha);
        $user->updated_at = Carbon::now();
        $user->telefone = $request->telefone;
        $user->data_nascimento = $request->nascimento;
        if($request->genero){
            $user->genero = $request->genero;
        }
        else{
            $user->genero = 'Indefinido';
        }
        $user->update();
        $user_id = $user->id;

        if($request->imagem){
            $last_imagem = fotoUser::where('user_id', Auth::user()->id)->first();
            if(isset($last_imagem)){
                $last_imagem->delete();
            }

            $linha_user_foto = new fotoUser();

            $request_imagem = $request->imagem;

            $ext = $request_imagem->extension();
            
            $nome_imagem = $request_imagem->getClientOriginalName() . uniqid() . '.' . $ext;
            
            $request_imagem->move(public_path('foto_usuario'), $nome_imagem);

            $linha_user_foto->user_id = $user_id;
            $linha_user_foto->anexo = $nome_imagem;
            $linha_user_foto->save();
        }

        $missao_um = userMissoe::where('user_id', Auth::user()->id)->where('missao', 1)->first();
        $missao_dois = userMissoe::where('user_id', Auth::user()->id)->where('missao', 2)->first();
        $missao_tres = userMissoe::where('user_id', Auth::user()->id)->where('missao', 3)->first();
        $missao_quatro = userMissoe::where('user_id', Auth::user()->id)->where('missao', 4)->first();
        $missao_cinco = userMissoe::where('user_id', Auth::user()->id)->where('missao', 5)->first();
        if(!isset($missao_cinco->id) and isset($missao_um->id) and isset($missao_dois->id) and isset($missao_tres->id) and isset($missao_quatro->id)){
            $quinta_completa = new userMissoe();
            $quinta_completa->user_id = Auth::user()->id;
            $quinta_completa->missao = 5;
            $quinta_completa->save();

            $aprendiz = User::findOrFail(Auth::user()->id);
            $aprendiz->rank = 'Aprendiz';
            $aprendiz->update();
        }
        
        return redirect()->route('profile', ['id' => Auth::user()->id, 'editado' => 'editado']);
    }

    public function excluir_usuario(Request $request)
    {
        $receitas = receita::where('user_id', $request->id)->get();
        foreach($receitas as $receita){
            $array = array($receita->id);

            $id_receita = new \Illuminate\Http\Request($array);

            ReceitaController::excluir_receita($id_receita);
        }
        
        $curtidas = curtida::where('user_id', $request->id)->get();
        foreach($curtidas as $curtida){
            $curtida->delete();
        }

        $favoritas = favorito::where('user_id', $request->id)->get();
        foreach($favoritas as $favorita){
            $favorita->delete();
        }

        $comentarios = comentario::where('user_id', $request->id)->get();
        foreach($comentarios as $comentario){
            $comentario->delete();
        }

        $avaliacaos = avaliacao::where('user_id', $request->id)->get();
        foreach($avaliacaos as $avaliacao){
            $avaliacao->delete();
        }

        $foto = fotoUser::where('user_id', $request->id)->get();
        foreach($foto as $f){
            $f->delete();
        }

        $seguindo = seguidor::where('seguidor_id', $request->id)->get();
        foreach($seguindo as $s){
            $s->delete();
        }

        $seguidores = seguidor::where('usuario_id', $request->id)->get();
        foreach($seguidores as $s){
            $s->delete();
        }

        $macs = UserMac::where('usuario_id', $request->id)->get();
        foreach($macs as $mac){
            $mac->delete();
        }

        $views = visualizacao::where('user_id', $request->id)->get();
        foreach($views as $view){
            $view->delete();
        }

        $usuario = User::findOrFail($request->id);
        $usuario->delete();
    }
}