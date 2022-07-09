<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function definir_first_login(Request $request)
    {
        $user = User::findOrfail(Auth::user()->id);
        $user->first_login = $request->data;
        $user->update();
    }
}
