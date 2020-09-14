<?php

namespace App\Http\Middleware;

use Closure;

class PagesMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!auth()->user()) {
            return redirect('home');
        }
        return $next($request);
    }
}
