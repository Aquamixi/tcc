<?php

namespace App\Http\Middleware;

use App\Models\receita;
use App\Scopes\ReceitaScope;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonoReceita
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
        $receita = receita::withoutGlobalScope(ReceitaScope::class)->findOrFail($request->id);

        if (isset($receita)) {
            if($receita->user_id == Auth::user()->id){
                return $next($request);
            }
            else{
                return redirect()->route('home', ['confirm' => 'usuario_invalido']);
            }
        } else {
            return redirect()->route('home', ['confirm' => 'usuario_invalido']);
        }
        
    }
}
