<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SenhaController extends Controller
{
    public function resetar_senha()
    {
        return view('auth/passwords/reset');
    }
}
