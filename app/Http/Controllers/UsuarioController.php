<?php
namespace app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\PasswordRecover;
use Illuminate\Http\Request;
use App\Models\Permissionario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use Illuminate\Support\Facades\Mail;
use App\Models\TiposDeUsuarios;
use Carbon\Carbon;

class UsuarioController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => [
                'login',
                'signin',
                'generateRecoverCode',
                'recoverPassword',
                'validateRecoveryCode'
            ]
        ]);
    }

    public function signin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => [
                'required',
                'min:4',
                'max:100'
            ],
            'email' => [
                'required',
                'email',
                'max:190'
            ],
            'cpf_cnpj' => [
                'required',
                'cpf_cnpj'
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

        $user = new Usuario();
        $user->fill($request->all());
        $user->password = hash::make($request->input("password"));

        $permissionario = Permissionario::where("cnh", $user->cnh)->orWhere("cpf_cnpj", $user->cpf_cnpj)->first();
        if (! isset($permissionario)) {
            return parent::responseMsgJSON("Nenhum permissionário previamente cadastrado", "signin:1", 404);
        }

        if (count(Usuario::where("email", $user->email)->orWhere("cpf_cnpj", $user->cpf_cnpj)->get()) > 0) {
            return parent::responseMsgJSON("Usuário já cadastrado", "signin:2", 404);
        }

        // setando tipo
        // posteriormente verificar entre os tipos existentes(fisca, condutor e etc...)
        $user->tipo_id = TiposDeUsuarios::where('nome', "permissionário")->first()->id;

        $user->permissionario_id = $permissionario->id;
        $user->save();

        return Usuario::findComplete($user->id);
    }

    public function login(Request $request)
    {
        $credenciais = $request->all([
            'email',
            'password'
        ]);

        if (! $token = auth('api')->attempt($credenciais)) {
            return parent::responseMsgJSON('E-mail ou senha inválidos', "login:1", 401);
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

    public function generateRecoverCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                'max:190'
            ]
        ]);

        if ($validator->fails()) {
            return parent::responseJSON($validator->errors(), 400);
        }

        $user = Usuario::findByEmail($request->input('email'));

        if (! isset($user)) {
            return parent::responseMsgJSON("Nenhum usuário encontrado.", "generateRecoverCode:1", 404);
        }

        $randCode = random_int(0, 999999);

        $user->codigo_de_recuperacao = $randCode;
        $user->data_hora_ultimo_codigo_de_recuperacao = new \DateTime();

        $user->save();

        Mail::to($user->email)->send(new PasswordRecover($user->nome, $randCode));

        return parent::responseMsgJSON("Código enviado com sucesso.");
    }
    
    public function recoverPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                'max:190'
            ],
            'code' => [
                'required'
            ],
            'new_password' => [
                'required'
            ]
        ]);
        
        if ($validator->fails()) {
            return parent::responseJSON($validator->errors(), 400);
        }
        
        $user = Usuario::findByEmailWithRecoveryCode($request->input('email'), $request->input('code'));
        
        if (! isset($user)) {
            return parent::responseMsgJSON("Usuário ou código encontrado. OBS: Verifique se este é o último código recebido por e-mail.", "recoverPassword:1", 404);
        }
        
               
        if(Carbon::now()->diffInHours($user->data_hora_ultimo_codigo_de_recuperacao)>=3){
            return parent::responseMsgJSON("Código expirado!", "recoverPassword:1", 401);
        }
        
        $user->codigo_de_recuperacao = null;
        $user->password = hash::make($request->input("new_password"));
        
        $user->save();
                
        return parent::responseMsgJSON("Nova senha salva com sucesso.");
    }
    
    public function validateRecoveryCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                'max:190'
            ],
            'code' => [
                'required'
            ]
        ]);
        
        if ($validator->fails()) {
            return parent::responseJSON($validator->errors(), 400);
        }
        
        $user = Usuario::findByEmailWithRecoveryCode($request->input('email'), $request->input('code'));
        
        if (! isset($user)) {
            return parent::responseMsgJSON("Usuário ou código encontrado. OBS: Verifique se este é o último código recebido por e-mail.", "validateRecoveryCode:1", 404);
        }
        
        
        if(Carbon::now()->diffInHours($user->data_hora_ultimo_codigo_de_recuperacao)>=3){
            return parent::responseMsgJSON("Código expirado!", "validateRecoveryCode:1", 401);
        } 
        
        return parent::responseMsgJSON("Código válido!");
    }

    public function me()
    {
        return Usuario::with("tipo")->find(auth()->id());
    }
}
