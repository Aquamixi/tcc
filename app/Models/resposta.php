<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class resposta extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'resposta',
        'user_id',
        'comentario_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function curtida_user()
    {
        return $this->hasMany(curtidaResposta::class, 'resposta_id', 'id')->where('user_id', Auth::user()->id);
    }
}
