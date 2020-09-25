<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Usuario;

class Permissionario
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
            
            $user = Usuario::with("permissionario")->find(auth()->id());
            
            if(!isset($user->permissionario)){
                return response()->json([
                    'status' => 'Usuário não é um permissionário.'
                ], 401);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocorreu um erro ao verificar o permissionário'
            ], 500);
        }
        return $next($request);
    }
}
