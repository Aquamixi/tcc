<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class visualizacao extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'receita_id'
    ];
    
    public function receita()
    {
        return $this->belongsTo(receita::class, 'receita_id', 'id');
    }
}
