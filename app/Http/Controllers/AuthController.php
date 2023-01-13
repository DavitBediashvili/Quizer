<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Contracts\Service\Attribute\Required;

class AuthController extends Controller
{
    public function loginPage(Request $request){
        return view('auth.login');
    }

    public function login(Request $request){

        $credentials = $request->validate([
            "email" => "required",
            "password" => "required",
        ]);
        $user = User::where(['email' => $credentials['email']])->first();
        if($user){

            if(Hash::check($credentials['password'], $user->password)){

                Auth::login($user);
                return redirect(route("list"));
            } 
            
            else{
                return back()->withError(['password' => 'Wrong Password']);
            }

        }

        return back()->withError(['email' => 'Wrong email']);
        
        
    }

    public function registerPage(Request $request){
        return view('auth.register');
    }

    public function register(Request $request){

        $credentials = $request->validate([
            "email" => "required",
            "name" => "required",
            "password" => "required|confirmed",
        ]);

        $credentials['password'] = Hash::make($credentials['password']);
        User::create($credentials);
        return redirect(route("login"));

    }

    public function logout(Request $request){

        Auth::logout();
        $request->session()->invalidate();
        return redirect(route('home'));

    }

}
