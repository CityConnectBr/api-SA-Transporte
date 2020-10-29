<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Env;

class AuthenticateDocAccess
{
    public function handle($request, Closure $next)
    {
        if(password_verify(Env("GETDOC_PASSWORD"), $request->header('token'))){
            return $next($request);
        }

        return response(['Token inválido'],401);
    }
}
