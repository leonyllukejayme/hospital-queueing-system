<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthManager extends Controller
{
    public function login(){
        if(Auth::check()){
            return redirect(route('dashboard'));
        }
        return view('login');
    }
    public function signup(){
        if(Auth::check()){
            return redirect(route('dashboard'));
        }

        return view('registration');
    }

    public function loginPost(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);

        $credentials = $request->only('username','password');
        if(Auth::attempt($credentials)) {
            return redirect()->intended(route('dashboard'));
        }

        return redirect(route('login'))->with('error','Login Credentials are not valid');
    }

    public function signupPost(Request $request){
        $request->validate([
            'username'=>'required|unique:users',
            'password'=>'required'
        ]);

        $data['username'] = $request->username;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);

        if(!$user){
            return redirect(route('signup'))->with('error','Registration Failed Try Again');
        }
        return redirect(route('login'))->with('success','Registration Sucess');
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
