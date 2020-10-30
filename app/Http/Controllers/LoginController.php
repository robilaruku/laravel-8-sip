<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function index()
    {
        if (auth()->user() == true) {
            return redirect()->route('admin');
        }

        return view('login');
    }

    public function authenticate(Request $request)
    {
        if (auth()->user() == true) {
            return redirect()->route('admin');
        }
        
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        Auth::attempt($data);

        if (Auth::check()) {
            return redirect()->route('admin');
        }else{
            Session::flash('message', 'Email Atau Password Salah');
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
