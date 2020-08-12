<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Env;

class AuthenticateIntegracao
{
    public function handle($request, Closure $next)
    {
        if(password_verify(Env("INTEGRADOR_PASSWORD"), $request->header('token'))){
            return $next($request);
        }

        return response(['Token inválido'],401);
    }
}
