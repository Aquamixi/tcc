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

    public function sabor()
    {
        return $this->belongsTo(sabor::class, 'sabor_id', 'id');
    }

    public function categoria()
    {
        return $this->belongsTo(categoria::class, 'categoria_id', 'id');
    }

    public function ingrediente()
    {
        return $this->belongsTo(ingrediente::class, 'ingrediente_id', 'id');
    }

    public function nacionalidade()
    {
        return $this->belongsTo(nacionalidade::class, 'nacionalidade_id', 'id');
    }
}
