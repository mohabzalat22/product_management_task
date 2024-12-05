<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::group(['middleware'=>['auth:sanctum'], 'prefix'=>'v1'], function(){
    Route::get('/user', function (Request $request) {return $request->user();});
    Route::resource('products', ProductController::class)->names('products');
});
