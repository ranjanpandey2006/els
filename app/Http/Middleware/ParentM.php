<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ParentM
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->type == "admin" && Auth::user()->type == "teacher" && Auth::user()->type == "student"){

            $request->session()->put('status','You don\'t have permission to access this resource');

            return redirect('home');
        }
        return $next($request);
    }
}
