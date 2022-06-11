<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'categoria'
    ];

    public function sub_categoria()
    {
        return $this->hasOne(subCategoria::class, 'categoria_id', 'id');
    }
}
