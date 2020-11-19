<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Usuario;

class Condutor
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
            
            $user = Usuario::with("condutor")->find(auth()->id());
            
            if(!isset($user->condutor)){
                return response()->json([
                    'status' => 'Usuário não é um condutor.'
                ], 401);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocorreu um erro ao verificar o condutor'
            ], 500);
        }
        return $next($request);
    }
}
