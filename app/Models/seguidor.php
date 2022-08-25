<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seguidor extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'usuario_id',
        'seguidor_id',
        'status'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }

    public function seguidor()
    {
        return $this->belongsTo(User::class, 'seguidor_id', 'id');
    }
}
