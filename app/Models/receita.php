<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class receita extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'titulo_receita',
        'modo_preparo',
        'tempo_preparo',
        'qtde_porcoes',
        'qtde_curtidas',
        'qtde_comentarios',
        'qtde_compartilhamentos',
        'avaliacao',
        'data_postagem',
        'ingrediente_id',
        'user_id',
        'sabor_id',
        'categoria_id',
        'velocidade_id'
    ];
}
