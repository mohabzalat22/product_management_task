<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request){

        $validated = $request->validated();
        // login logic

        if(Auth::attempt($validated)){
            return redirect()->route('dashboard')->with('success', 'Logged In Successfully!');
        }
        return redirect()->route('dashboard')->with('error', 'Loged In Failed!');
    }

    public function logout(){
        
        Auth::logout();

        // invalidate token
        request()->session()->invalidate();
        
        // regenerate token
        request()->session()->regenerateToken();

        //redirect to home page
        return redirect()->route('home');
    }
}
