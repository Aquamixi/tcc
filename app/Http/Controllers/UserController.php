<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use App\Models\sabor;
use App\Models\seguidor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function segue_ou_nao(Request $request)
    {
        $linha = seguidor::where('usuario_id', Auth::user()->id)->where('seguidor_id', $request->id)->first();
        if($linha){
            $linha->delete();
        }
        else{
            $novo_seguidor = new seguidor();
            $novo_seguidor->usuario_id = Auth::user()->id;
            $novo_seguidor->seguidor_id = $request->id;
            $novo_seguidor->status = 'Seguindo';
            $novo_seguidor->save();
        }
    }

    public function profile(Request $request)
    {
        $sabores = sabor::get();
        $categorias = categoria::get();
        
        $usuario = User::findOrFail($request->id);
        return view('usuario.profile', compact('usuario', 'sabores', 'categorias'));
    }
}
