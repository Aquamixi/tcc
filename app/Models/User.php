<?php

namespace App\Models;

use App\Notifications\RedefinirSenhaNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'genero'
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new RedefinirSenhaNotification($token, $this->email, $this->name));
    }
}
