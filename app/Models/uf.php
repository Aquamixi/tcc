<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class uf extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['uf'];
}
