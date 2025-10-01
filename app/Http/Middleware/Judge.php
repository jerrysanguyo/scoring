<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Judge
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->type === "judge") {
            return $next($request);
        }

        return redirect()->route('unauthorized-access');
    }
}
