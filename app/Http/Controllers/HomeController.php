<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;


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
    public function home(Request $request){
        //$today = Carbon::today()->format('Y-m-d');
        $today = '2022-04-21';
        $receita_hoje = \App\Models\receita::where('data_postagem', $today)->orderBy('qtde_curtidas', 'desc')->take(5)->get();

        $receitas = \App\Models\receita::select();
        
        if($request->sabor){
            $receitas->whereHas('sabor', function($q) use ($request){
                $q->where('sabor', $request->sabor);
            });
        }

        $receitas = $receitas->orderBy('qtde_curtidas', 'desc')->take(10)->get();

        return view('home', compact('receitas', 'receita_hoje'));
    }
}
