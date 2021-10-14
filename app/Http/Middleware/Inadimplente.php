<?php

namespace App\Http\Middleware;

use App\Associado;
use Closure;

class Inadimplente
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
        if ($request->user()->hasRole(['associado'])){
            if ($request->user()->associado->status==0){
                return redirect()->route('associado.regularizar_situacao');
            }
        }
        return $next($request);
    }
}
