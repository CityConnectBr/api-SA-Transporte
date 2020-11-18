<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Usuario;

class Fiscal
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
        try {
            
            $user = Usuario::with("fiscal")->find(auth()->id());
            
            if(!isset($user->fiscal)){
                return response()->json([
                    'status' => 'Usuário não é um fiscal.'
                ], 401);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocorreu um erro ao verificar o fiscal'
            ], 500);
        }
        return $next($request);
    }
}
