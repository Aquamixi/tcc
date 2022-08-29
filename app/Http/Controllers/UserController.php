<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use App\Models\endereco;
use App\Models\sabor;
use App\Models\seguidor;
use App\Models\User;
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
        
    }

    public function deixar_seguir(Request $request)
    {
        $linha = seguidor::where('seguidor_id', Auth::user()->id)->where('usuario_id', $request->id)->first();
        $linha->delete();
    }

    public function profile(Request $request)
    {
        $sabores = sabor::get();
        $categorias = categoria::get();
        
        $usuario = User::findOrFail($request->id);

        return view('usuario.profile', compact('usuario', 'sabores', 'categorias'));
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

        if(
            $request->rua || 
            $request->numero || 
            $request->bairro || 
            $request->cidade ||
            $request->cep || 
            $request->uf ||
            $request->pais
        ){
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
                $endereco_id = $endereco->id;
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
            }
        }
        $user = User::findOrFail(Auth::user()->id);
        if(isset($endereco_id)){
            $user->endereco_id = $endereco_id;
        }
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

        return redirect()->route('profile', ['id' => Auth::user()->id, 'editado' => 'editado']);
    }
}
