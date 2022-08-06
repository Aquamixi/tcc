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
        'descricao',
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
        return $this->hasMany(receitaIngrediente::class, 'receita_id', 'id');
    }

    public function nacionalidade()
    {
        return $this->belongsTo(nacionalidade::class, 'nacionalidade_id', 'id');
    }

    public function velocidade(){
        return $this->belongsTo(velocidade::class, 'velocidade_id', 'id');
    }

    public function foto(){
        return $this->hasOne(fotoReceita::class, 'receita_id', 'id');
    }

    public function scopePesquisa_avancada($query, $val){
        $query->where(function($variavel) use ($val){
            $variavel->where('titulo_receita', 'LIKE', '%' . $val . '%')
            ->orWhereHas('categoria', function($q) use ($val){
                $q->where('categoria', 'LIKE', '%' . $val . '%');
            })
            ->orWhereHas('categoria', function($q) use ($val){
                $q->whereHas('sub_categoria', function($fundo) use ($val){
                    $fundo->where('sub_categoria', 'LIKE', '%' . $val . '%');
                });
            })
            ->orWhereHas('nacionalidade', function($q) use ($val){
                $q->where('nacionalidade', 'LIKE', '%' . $val . '%');
            })
            ->orWhereHas('sabor', function($q) use ($val){
                $q->where('sabor', 'LIKE', '%' . $val . '%');
            })
            ->orWhereHas('ingrediente', function($q) use ($val){
                $q->where('ingrediente', 'LIKE', '%' . $val . '%');
            })
            ->orWhereHas('velocidade', function($q) use ($val){
                $q->where('velocidade', 'LIKE', '%' . $val . '%');
            });
        });
    }
}
