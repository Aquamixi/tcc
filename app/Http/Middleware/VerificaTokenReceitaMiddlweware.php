<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificaTokenReceitaMiddlweware
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
        $receita = \App\Models\receita::withoutGlobalScope(\App\Scopes\ReceitaScope::class)->findOrFail($request->id);
        if (Auth::user()->id == $receita->user_id) {
            return $next($request);
        } else {
            if(isset($receita->token_acesso)){
                if($receita->token_acesso == $request->token and Carbon::now(new DateTimeZone('America/Sao_Paulo'))->diffInHours(Carbon::parse($receita->data_token_validade), false) >= 0){
                    return $next($request);
                }
                else{
                    return redirect()->route('home', ['confirm' => 'usuario_invalido']);
                }
            }
            else{
                return redirect()->route('home', ['confirm' => 'usuario_invalido']);
            }
        }
    }
}
