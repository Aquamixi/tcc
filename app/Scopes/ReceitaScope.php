<?php

namespace App\Scopes;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class ReceitaScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $usuario = new User();

        $builder->where('escondida', 0);
        
        if(Auth::check() and Auth::user()->data_nascimento){
            if($usuario->usuario_idade() < 18){
                $builder->where('mais_dezoito', 0);
            }
        }
        else{
            $builder->where('mais_dezoito', 0);
        }
    }
}