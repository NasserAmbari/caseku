<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsLogged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('userId')){
            return redirect()->route('login')->with('fail','Login Dulu ngentot');
        }
        return $next($request);
    }
}
