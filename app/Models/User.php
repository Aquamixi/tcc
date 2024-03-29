<?php

namespace App\Models;

use App\Notifications\RedefinirSenhaNotification;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $primaryKey = 'id';
    protected $fillable = [
        'endereco_id',
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'telefone',
        'data_nascimento',
        'first_login',
        'genero',
        'rank'
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new RedefinirSenhaNotification($token, $this->email, $this->name));
    }

    public function foto()
    {
        return $this->hasOne(fotoUser::class, 'user_id', 'id');
    }

    public function seguidor()
    {
        return $this->hasMany(seguidor::class, 'usuario_id', 'id');
    }

    public function seguindo()
    {
        return $this->hasMany(seguidor::class, 'seguidor_id', 'id');
    }

    public function favoritas()
    {
        return $this->hasMany(favorito::class, 'user_id', 'id');
    }
    
    public function curtidas()
    {
        return $this->hasMany(curtida::class, 'user_id', 'id');
    }
    
    public function receitas()
    {
        return $this->hasMany(receita::class, 'user_id', 'id');
    }

    public function endereco()
    {
        return $this->belongsTo(endereco::class, 'endereco_id', 'id');
    }

    public function usuario_idade()
    {
        if(Auth::user()->data_nascimento){
            $data = Carbon::parse(Auth::user()->data_nascimento);
        }
        else{
            $data = Carbon::parse(Carbon::today(new DateTimeZone('America/Sao_Paulo')));
        }
        return $data->diffInYears(Carbon::today(new DateTimeZone('America/Sao_Paulo')));
    }

}
