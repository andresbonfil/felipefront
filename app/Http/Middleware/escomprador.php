<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class escomprador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(session('tipoc')=='Comprador'){ return $next($request); }
        return redirect('/');
    }
}
