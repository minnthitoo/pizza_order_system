<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //login
    public function loginPage(){
        return view('login');
    }

    //register
    public function registerPage(){
        return view('register');
    }

    public function dashboard()
    {
        if(Auth::user()->role == 'admin'){
            return redirect()->route('category#list');
        }
        return redirect()->route('user#home');
    }

}
