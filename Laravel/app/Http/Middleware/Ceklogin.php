<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Ceklogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$roles): Response
    {
        if (!Auth::check()) 
        {
            return redirect('admin');
        }

        $user=Auth::user();
        if ($user->level == $roles) {
            return $next($request);
        }

        return redirect('admin');




      
    }
}
