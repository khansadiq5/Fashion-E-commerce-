<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function register(Request $req){
        $req->validate([
            'name'=> 'required|min:3',
            'email'=> 'required|email',
            'phone'=> 'required',
            'password'=> 'required|min:6',
            'Cpassword' => 'required|same:password'
        ]);
        $isData = new User;
        $isData->name = $req->name;
        $isData->email = $req->email;
        $isData->phone = $req->phone;
        $isData->password = Hash::make($req->password);

        if($isData->save()){
            return redirect(url('login'));
        }
        else {
            return "something wrong";
        }
    }

    function login(Request $req){

        $credentials = $req->validate([
            'email'=> 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $req->session()->regenerate();

            $user = Auth::user();

            if(Auth::user()->role == 'admin'){
                return redirect(url('./admin'));
            }
            return redirect(url('/'));
        }else {
            return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
        }
    }

    function logout(Request $req){
        Auth::logout();

        $req->session()->invalidate();
        $req->session()->regenerateToken();

        return redirect(url('login'));
    }
}
