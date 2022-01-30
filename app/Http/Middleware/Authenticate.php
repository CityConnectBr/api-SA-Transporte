<?php
namespace app\Http\Middleware;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use App\Models\Usuario;

class Authenticate extends Middleware
{

    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
            $id = auth()->id()!=null?auth()->id():auth('api')->id();
            assert($id!=null);
            assert(Usuario::findComplete($id)!=null);
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json([
                    'status' => 'Token inválido'
                ], 401);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json([
                    'status' => 'Token expirado'
                ], 401);
            } else {
                return response()->json([
                    'status' => 'Token não encontrado'
                ], 401);
            }
        }
        return $next($request);
    }
}
