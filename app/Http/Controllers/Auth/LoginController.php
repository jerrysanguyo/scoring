<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function redirectTo()
    {
        if (auth()->user()->type == 'admin') {
            return '/admin/home';
        } else if (auth()->user()->type == 'user') {
            return '/user/home';
        } else if (auth()->user()->type == 'judge') {
            return '/judge/home';
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
