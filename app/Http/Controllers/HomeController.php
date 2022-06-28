<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use App\Models\receita;
use App\Models\User;
use App\Models\sabor;
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
        $sabores = sabor::get();
        $categorias = categoria::get();
        $today = '2022-04-21';
        $receita_hoje = receita::where('data_postagem', $today)->orderBy('qtde_curtidas', 'desc')->take(5)->get();

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

        if($request->search){
            $receitas->where(function($query) use ($request){
                $query->where('titulo_receita', 'LIKE', '%' . $request->search . '%')
                ->orWhereHas('categoria', function($q) use ($request){
                    $q->where('categoria', 'LIKE', '%' . $request->search . '%');
                })
                ->orWhereHas('categoria', function($q) use ($request){
                    $q->whereHas('sub_categoria', function($fundo) use ($request){
                        $fundo->where('sub_categoria', 'LIKE', '%' . $request->search . '%');
                    });
                })
                ->orWhereHas('nacionalidade', function($q) use ($request){
                    $q->where('nacionalidade', 'LIKE', '%' . $request->search . '%');
                })
                ->orWhereHas('sabor', function($q) use ($request){
                    $q->where('sabor', 'LIKE', '%' . $request->search . '%');
                })
                ->orWhereHas('ingrediente', function($q) use ($request){
                    $q->where('ingrediente', 'LIKE', '%' . $request->search . '%');
                });
            });
        }
        $receitas = $receitas->orderBy('qtde_curtidas', 'desc')->take(10)->get();

        return view('home', compact('receitas', 'receita_hoje', 'sabores', 'categorias'));
    }

    public function teste(Request $request){
        $linha = User::where('name', $request->usuario)->first();
        return view('teste', compact('linha'));
    }
}
