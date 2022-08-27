<?php

namespace App\Scopes;

use Carbon\Carbon;
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
        $builder->where('escondida', 0);
        
        if(Auth::user()->data_nascimento){
            if(Carbon::parse(Auth::user()->data_nascimento)->diffInYears(Carbon::today()) >= 18){
                $builder->where('mais_dezoito', 0)->orWhere('mais_dezoito', 1);
            }
            else{
                $builder->where('mais_dezoito', 0);
            }
        }
        else{
            $builder->where('mais_dezoito', 0);
        }
    }
}