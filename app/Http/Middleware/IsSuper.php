<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;
use Symfony\Component\HttpFoundation\Response;

class IsSuper extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::user()->hasRole('superAdmin')) {
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
