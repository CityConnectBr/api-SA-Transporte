<?php

namespace App\Http\Middleware;

use App\Models\Perfil;
use App\Models\Usuario;
use Closure;

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
            $idLogado = auth()->id()!=null?auth()->id():auth('api')->id();
            $usuarioLogado = Usuario::find($idLogado);
            assert($idLogado!=null);
            assert($usuarioLogado!=null);
            assert($usuarioLogado->perfil_web_id!=null);
            $perfil = Perfil::find($usuarioLogado->perfil_web_id);
            assert($perfil!=null);

            if(
                ($request->method()=="POST" && $perfil->incluir!=1) ||
                ($request->method()=="PATH" && $perfil->alterar!=1) ||
                ($request->method()=="PUT" && $perfil->alterar!=1) ||
                ($request->method()=="GET" && $perfil->consultar!=1) ||
                ($request->method()=="DELETE" && $perfil->excluir!=1)
                ){
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
