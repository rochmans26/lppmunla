<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function index()
    {
        if (!isset(Auth::user()->level)) {
            return redirect()->route('loginui');
        } elseif (Auth::user()->level == 'admin') {
            return redirect('/admin');
        } elseif (Auth::user()->level == 'sp-admin') {
            return redirect('/sp-admin');
        }
    }


    public function proses_login(Request $request)
    {
        request()->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ]
        );
        $kredensil = $request->only('username', 'password');
        if (Auth::attempt($kredensil)) {
            $user = Auth::user();
            if ($user->level == 'admin') {
                return redirect()->intended('admin');
            } elseif (Auth::user()->level == 'sp-admin') {
                return redirect('/sp-admin');
            }
            return redirect()->route('loginui');
        }
        return redirect()->route('loginui');
    }
    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect()->route('home');
    }

    public function login()
    {
        if (!isset(Auth::user()->level)) {
            return redirect()->route('loginui');
        } elseif (Auth::user()->level == 'admin') {
            return redirect('/admin');
        }elseif (Auth::user()->level == 'sp-admin') {
            return redirect('/sp-admin');
        }
    }
}
