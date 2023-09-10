<?php

namespace App\Http\Middleware;

use App\Models\Perfil;
use App\Models\Usuario;
use Closure;
use Illuminate\Support\Str;

class CheckAdminPerfil
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
            $idLogado = auth()->id() != null ? auth()->id() : auth('api')->id();
            $usuarioLogado = Usuario::find($idLogado);
            assert($idLogado != null);
            assert($usuarioLogado != null);
            assert($usuarioLogado->perfil_web_id != null);
            $perfil = Perfil::find($usuarioLogado->perfil_web_id);
            assert($perfil != null);
            $path = $request->path();

            if (Str::endsWith($path, '/usuarios') && $perfil->cadastro_usuario != 1) {
                return response()->json([
                    'message' => 'Este usuário não pode realizar este tipo de ação!'
                ], 401);
            }

            if (Str::endsWith($path, '/perfis') && $perfil->cadastro_perfil != 1) {
                return response()->json([
                    'message' => 'Este usuário não pode realizar este tipo de ação!'
                ], 401);
            }

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ocorreu um erro ao validar perfil'
            ], 401);
        }
        return $next($request);
    }
}