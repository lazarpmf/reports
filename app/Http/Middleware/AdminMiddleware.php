<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
 
    public function handle($request, Closure $next)
    {
        if(auth()->user()->role !== 1 && auth()->user()){
            return redirect('home');
        }

        return $next($request);
    }
}
