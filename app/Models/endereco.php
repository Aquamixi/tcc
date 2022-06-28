<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class endereco extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'rua',
        'numero',
        'bairro',
        'cidade',
        'cep',
        'uf_id',
        'pai_id'
    ];
}
