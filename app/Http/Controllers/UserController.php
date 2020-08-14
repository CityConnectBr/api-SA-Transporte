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
                'login', 'signin'
            ]
        ]);
    }

    public function signin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => [
                'required', 'min:4', 'max:100'
            ],
            'email' => [
                'required','email', 'max:190'
            ],
            'cpf_cnpj' => [
                'required','cpf_cnpj'
            ],
            'cnh' => [
                'max:11'
            ],
            'password' => [
                'required'
            ]
        ]);

        if ($validator->fails()) {
            return parent::responseJSON($validator->errors(), 400);
        }

        $user = new User();
        $user->fill($request->all());
        $user->password = hash::make($request->input("password"));

        $permissionario = Permissionario::where("cnh", $user->cnh)->orWhere("cpf_cnpj", $user->cpf_cnpj)->first();
        if (! isset($permissionario)) {
            return parent::responseMsgJSON("Nenhum permissionário previamente cadastrado", 404);
        }

        if(!empty(User::where("email", $user->email)->orWhere("cpf_cnpj", $user->cpf_cnpj)->get())){
            return parent::responseMsgJSON("Usuário já cadastrado", 404);
        }

        $user->permissionario_id = $permissionario->id;
        $user->save();

        return $user;
    }

    public function login(Request $request)
    {
        $credenciais = $request->all([
            'email',
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
