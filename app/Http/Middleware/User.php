<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class User
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->type === "user") {
            return $next($request);
        }

        return redirect()->route('unauthorized-access');
    }
}
