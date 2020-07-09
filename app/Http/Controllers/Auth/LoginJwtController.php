<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class LoginJwtController extends Controller
{

    public function teste(){
        return "teste";
    }

    public function login(Request $request){

        $credenciais = $request->all(['email', 'password']);

        if(!$token = auth('api')->attempt($credenciais)){
            return response(['message'=>'Não Autenticado'], 401);
        }

        return ['token'=>$token];
    }

    public function teste2(){
        return "teste2";
    }

    public function logout(){
        auth('api')->logout();

        return response([], 200);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
}
