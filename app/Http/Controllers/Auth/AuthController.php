<?php

namespace App\Http\Controllers\Auth;

//use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        //$this->redirectAfterLogout = route('auth.login');
        $this->redirectTo = route('dashboard');
            
        //$this->middleware('guest', ['except' => 'getLogout']);
    }
}
