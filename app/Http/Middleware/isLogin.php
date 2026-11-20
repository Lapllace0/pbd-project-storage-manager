<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('isLogin') == true) {
            return $next($request);
        } else {
            return redirect('/')->with('error', 'Anda harus login terlebih dahulu');
        }
    }
}
