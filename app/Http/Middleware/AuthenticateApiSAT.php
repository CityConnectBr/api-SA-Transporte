<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Env;

class AuthenticateApiSAT
{
    public function handle($request, Closure $next)
    {
        if(password_verify(Env("API_SAT_PASSWORD"), $request->header('token'))){
            return $next($request);
        }

        return response(['Token inválido'],401);
    }
}
