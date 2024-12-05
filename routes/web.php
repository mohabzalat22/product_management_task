<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ModifiedAuth;

Route::get('/', function () {return view('welcome');})->name('home');

Route::group(['middleware'=> ['web', ModifiedAuth::class]], function(){
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
});

Route::group(['middleware'=> ['web', 'guest']], function(){
    Route::controller(AuthController::class)->group(function(){
        Route::post('login', 'login')->name('login');
        Route::post('logout', 'logout')->name('logout');
    });
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');
});    
