<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    public function store(RegisterRequest $request){
        $validated = $request->validated();

        // register logic
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),

        ]);
        
        //login logic
        Auth::login($user);

        // redirect to dashboard

        return redirect()->route('dashboard')->with('success','User Created Successfully');
    }
}
