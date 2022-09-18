<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class comentario extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'receita_id',
        'comentario',
        'data_comentario'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function respostas()
    {
        return $this->hasMany(resposta::class, 'comentario_id', 'id');
    }

    public function curtida_user()
    {
        return $this->hasMany(curtidaComentario::class, 'comentario_id', 'id')->where('user_id', Auth::user()->id);
    }
}
