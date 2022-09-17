<?php

namespace App\Http\Middleware;

use App\Models\userMissoe;
use App\Models\visualizacao;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisualizacaoReceita
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $missao_um = userMissoe::where('user_id', Auth::user()->id)->where('missao', 1)->first();
        if(!isset($missao_um->id)){
            $primeira_completa = new userMissoe();
            $primeira_completa->user_id = Auth::user()->id;
            $primeira_completa->missao = 1;
            $primeira_completa->save();
        }

        $views = visualizacao::where('receita_id', $request->id)
        ->where('user_id', Auth::user()->id)
        ->first();

        if(!isset($views->id)){
            $new_view = new visualizacao();
            $new_view->user_id = Auth::user()->id;
            $new_view->receita_id = $request->id;
            $new_view->save();
        }

        return $next($request);
    }
}
