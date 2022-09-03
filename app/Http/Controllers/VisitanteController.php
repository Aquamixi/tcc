<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use App\Models\receita;
use App\Models\User;
use App\Models\sabor;
use App\Models\seguidor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class VisitanteController extends Controller
{
    public function home(Request $request)
    {
        $today = Carbon::today()->format('Y-m-d');
        $sabores = sabor::get();
        $categorias = categoria::get();

        // $today = '2022-04-21';

        $receita_hoje = receita::has('foto')
        ->where('data_postagem', $today)->take(5)->get();

        $receitas = receita::select();
        
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
        $verificar = receita::first();

        $receitas = $receitas->simplePaginate(10);

        return view('home', compact('receitas', 'receita_hoje', 'sabores', 'categorias', 'verificar'));
    }
}
