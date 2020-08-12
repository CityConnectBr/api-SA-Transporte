<?php
namespace app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permissionario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => [
                'login'
            ]
        ]);
    }

    public function signin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'CNH' => [
                'required'
            ],
            'password' => [
                'required'
            ]
        ]);

        if ($validator->fails()) {
            return parent::responseJSON($validator->errors(), 400);
        }

        $user = new User();
        $user->CNH = $request->input("CNH");
        $user->password = hash::make($request->input("password"));

        $permissionario = Permissionario::where("CNH", $user->CNH)->first();
        if (! isset($permissionario)) {
            return parent::responseMsgJSON("Nenhum permissionário ou auxiliar previamente cadastrado", 404);
        }

        $user->permissionario_id = $permissionario->id;
        $user->save();

        return $user;
    }

    public function login(Request $request)
    {
        $credenciais = $request->all([
            'CNH',
            'password'
        ]);

        if (! $token = auth('api')->attempt($credenciais)) {
            return parent::responseMsgJSON('Não Autenticado', 401);
        }

        return parent::responseJSON([
            'token' => $token
        ]);
    }

    public function logout()
    {
        auth('api')->logout();

        return parent::responseMsgJSON("Logout efetuado com sucesso");
    }

    public function refresh()
    {
        return parent::responseJSON([
            'newToken' => auth('api')->refresh()
        ]);
    }
    
    public function me() {
        return parent::responseJSON(auth()->user());
    }
}
