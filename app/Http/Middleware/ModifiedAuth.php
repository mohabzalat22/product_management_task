<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ModifiedAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return redirect to home page on not auth.
     */

    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return redirect()->route('home');
        }
        return $next($request);
    }
}
