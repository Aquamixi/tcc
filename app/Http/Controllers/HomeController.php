<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use App\Models\receita;
use App\Models\User;
use App\Models\sabor;
use App\Models\seguidor;
use App\Models\userMissoe;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTimeZone;
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
        $today = Carbon::today(new DateTimeZone('America/Sao_Paulo'))->format('Y-m-d');
        $sabores = sabor::get();
        $categorias = categoria::get();

        $receita_hoje = receita::has('foto')
        ->where('data_postagem', $today)->orderByDesc('avaliacao')
        ->take(5)
        ->get();

        $receitas = receita::select();

        if($request->search){
            $usuarios = User::where('name', 'LIKE', '%' . $request->search . '%')->get();
            $meus_seguidores = seguidor::where('seguidor_id', Auth::user()->id)->with('usuario')->get();
                
            $array_seguindo = [];
            foreach($meus_seguidores as $s){
                $array_seguindo[] = $s->usuario_id;
            }

            $receitas->pesquisa_avancada($val = $request->search);

            $receitas = $receitas->get();

            return view('pesquisa.pesquisa', compact('array_seguindo', 'usuarios', 'receitas', 'sabores', 'categorias'));
        }

        if($request->seguindo){
            $receitas->whereHas('usuario', function($query){
                $query->whereHas('seguidor', function($q){
                    $q->where('seguidor_id', Auth::user()->id)->where('status', 'Seguindo');
                });
            })->orderByDesc('data_postagem');
        }

        $verificar = receita::first();
        $receitas = $receitas->orderByDesc('data_postagem')->simplePaginate(10);

        return view('home', compact('receitas', 'receita_hoje', 'sabores', 'categorias', 'verificar'));
    }

    public function visualizar_missoes()
    {
        $um = userMissoe::where('user_id', Auth::user()->id)->where('missao', 1)->first();
        $dois = userMissoe::where('user_id', Auth::user()->id)->where('missao', 2)->first();
        $tres = userMissoe::where('user_id', Auth::user()->id)->where('missao', 3)->first();
        $quatro = userMissoe::where('user_id', Auth::user()->id)->where('missao', 4)->first();
        $cinco = userMissoe::where('user_id', Auth::user()->id)->where('missao', 5)->first();

        return view('layouts.missoes.missoes', compact('um', 'dois', 'tres', 'quatro', 'cinco'));
    }
}
