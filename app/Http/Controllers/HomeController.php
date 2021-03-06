<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use App\Models\receita;
use App\Models\User;
use App\Models\sabor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home(Request $request)
    {
        $today = Carbon::today()->format('Y-m-d');
        $sabores = sabor::get();
        $categorias = categoria::get();
        // $today = '2022-04-21';
        $receita_hoje = receita::has('foto')
        ->where('data_postagem', $today)->orderBy('qtde_curtidas', 'desc')->take(5)->get();
        $first_login = Auth::user()->first_login;

        $receitas = receita::select()->has('foto');
        
        if($request->sabor){
            $receitas->whereHas('sabor', function($q) use ($request){
                $q->where('sabor', $request->sabor);
            });
        }

        if($request->categoria){
            $receitas->whereHas('categoria', function($q) use ($request){
                $q->where('categoria', $request->categoria);
            });
        }

        if($request->search){
            $usuarios = User::where('name', 'LIKE', '%' . $request->search . '%')->get();

            $receitas->pesquisa_avancada($val = $request->search);

            $receitas = $receitas->orderBy('qtde_curtidas', 'desc')->get();

            return view('pesquisa.pesquisa', compact('usuarios', 'first_login', 'receitas', 'sabores', 'categorias'));
        }
        
        $receitas = $receitas->orderBy('qtde_curtidas', 'desc')->take(10)->get();

        return view('home', compact('receitas', 'first_login', 'receita_hoje', 'sabores', 'categorias'));
    }

}
