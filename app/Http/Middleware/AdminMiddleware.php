<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
 
    public function handle($request, Closure $next)
    {
        
        if(!auth()->user()){
            return redirect('home');
        }else if(auth()->user()){
            if(auth()->user()->role !== 1){
                return redirect('home');
            }
        }

        return $next($request);
    }
}
