<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserEnable
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
        if (auth()->check() && !auth()->user()->is_enabled) {
            auth()->logout();

            $message = 'A sua conta foi suspensa. Entre em contato com o administrador.';

            return redirect()->route('login')->with('error', $message);
        }

        return $next($request);
    }
}
