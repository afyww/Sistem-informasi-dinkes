<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    function index()
    {
        return view('auth.login');
    }

    function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
 
            return redirect('dashboard')->with('toast_success','Berhasil Login !');
        }
 
        return back()->with('error', 'Password atau Email Salah !');
    }

    function logout(){
        Auth::logout();
        return redirect('/')->with('toast_success', 'Berhasil Logout !');
    }

}

