<?php

namespace App\Http\Middleware;

use Closure;

class ConsultorioMiddleware
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
        if($request->user() === null) {
            return redirect('login/');
        }elseif ($request->user()->isGuest()) {
            return response()->view('errors.401',[],401);
        }

        return $next($request);
    }
}
