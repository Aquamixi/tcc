<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

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
}
