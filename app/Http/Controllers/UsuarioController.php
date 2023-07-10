<?php
namespace app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permissionario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use Illuminate\Support\Facades\Mail;
use App\Models\TiposDeUsuarios;
use Carbon\Carbon;
use App\Mail\PasswordRecover;
use App\Models\Fiscal;
use App\Models\Condutor;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => [
                'login',
                'signin',
                'refresh',
                'generateRecoverCode',
                'recoverPassword',
                'validateRecoveryCode'
            ]
        ]);
    }

    public function signin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // ///////////// COMUNS
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
            return parent::responseMsgsJSON($validator->errors(), 400);
        }

        // PESQUISANDO USUARIOS
        /*$user = Usuario::findByCpfCnpj($request['cpf_cnpj']);
        if (isset($user)) {
            return parent::responseMsgJSON("CPF ou CNPJ já cadastrado", 400);
        }*/

        $user = Usuario::findByEmail($request['email']);
        if (isset($user)) {
            return parent::responseMsgJSON("E-mail já cadastrado", 400);
        }

        /*if (isset($request['cnh']) && ! empty($request['cnh'])) {
            $user = Usuario::findByCNH($request['cnh']);
            if (isset($user)) {
                return parent::responseMsgJSON("CNH já cadastrada", 400);
            }
        }*/

        $user = new Usuario();
        $user->fill($request->all());
        $user->password = hash::make($request->input("password"));

        // BUSCANDO PERMISSIONARIO
        $permissionario = Permissionario::firstByCpfCnpj($request->input("cpf_cnpj"));
        if (! isset($permissionario) && isset($user->cnh)) {
            $permissionario = Permissionario::firstByCnh($user->cnh);
        }

        // BUSCANDO FISCAL
        $fiscal = Fiscal::firstByCpf($request->input("cpf_cnpj"));

        // BUSCANDO condutor
        $condutor = Condutor::firstByCNH($request->input("cnh"));

        if (! isset($permissionario) && ! isset($fiscal) && ! isset($condutor)) {
            return parent::responseMsgJSON("Nenhum permissionário, fiscal ou condutor previamente cadastrado", 404);
        }

        /*if (count(Usuario::findByEmailOrCpfCnpj($user->email, $request->input("cpf_cnpj"))) > 0) {
            return parent::responseMsgJSON("Usuário já cadastrado", 404);
        }*/
        if (Usuario::findByEmail($user->email)!==null) {
            return parent::responseMsgJSON("Usuário já cadastrado", 404);
        }

        if (isset($permissionario)) {
            $user->tipo_id = TiposDeUsuarios::findByName("permissionário")->id;
            $user->permissionario_id = $permissionario->id;
            $user->save();
        } else if (isset($fiscal)) {
            $user->tipo_id = TiposDeUsuarios::findByName("fiscal")->id;
            $user->fiscal_id = $fiscal->id;
            $user->save();
        } else if (isset($condutor)) {
            $user->tipo_id = TiposDeUsuarios::findByName("condutor")->id;
            $user->condutor_id = $condutor->id;
            $user->save();
        } else {
            return parent::responseMsgJSON("Usuário não pode ser cadastrado", 404);
        }

        return Usuario::findComplete($user->id);
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => [
                'required'
            ],
            'new_password' => [
                'required'
            ]
        ]);

        if ($validator->fails()) {
            return parent::responseMsgsJSON($validator->errors(), 400);
        }

        $user = parent::getUserLogged();

        if (! password_verify($request->input("password"), $user->password)) {
            return parent::responseMsgJSON("Senha atual não confere", 401);
        }

        $user->password = hash::make($request->input("password"));
        $user->save();

        return parent::responseMsgJSON("Alterado com sucesso");
    }

    public function login(Request $request)
    {
        $credenciais = $request->all([
            'email',
            'password'
        ]);

        if (! $token = auth('api')->attempt($credenciais)) {
            return parent::responseMsgJSON('E-mail ou senha inválidos', 401);
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
            return parent::responseMsgsJSON($validator->errors(), 400);
        }

        $user = Usuario::findByEmail($request->input('email'));

        if (! isset($user)) {
            return parent::responseMsgJSON("Nenhum usuário encontrado.", 404);
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
            return parent::responseMsgsJSON($validator->errors(), 400);
        }

        $user = Usuario::findByEmailWithRecoveryCode($request->input('email'), $request->input('code'));

        if (! isset($user)) {
            return parent::responseMsgJSON("Usuário ou código encontrado. OBS: Verifique se este é o último código recebido por e-mail.", 404);
        }

        if (Carbon::now()->diffInHours($user->data_hora_ultimo_codigo_de_recuperacao) >= 3) {
            return parent::responseMsgJSON("Código expirado!", 401);
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
            return parent::responseMsgsJSON($validator->errors(), 400);
        }

        $user = Usuario::findByEmailWithRecoveryCode($request->input('email'), $request->input('code'));

        if (! isset($user)) {
            return parent::responseMsgJSON("Usuário ou código encontrado. OBS: Verifique se este é o último código recebido por e-mail.", 404, "validateRecoveryCode:1");
        }

        if (Carbon::now()->diffInHours($user->data_hora_ultimo_codigo_de_recuperacao) >= 3) {
            return parent::responseMsgJSON("Código expirado!", 401);
        }

        return parent::responseMsgJSON("Código válido!");
    }

    public function user()
    {
        $user = parent::getUserLogged();

        switch ($user->tipo_id) {
            case 1:
                $user->permissionario->modalidade; // carregando modalidade
                $user->permissionario->endereco; // carregando endereco
                $user->permissionario->lastAlvara; // carregando alvara
                break;
            case 2:
                $user->condutor->endereco; // carregando endereco
                $user->condutor->permissionario; // carregando permissionario
                break;
            case 3:
                $user->fiscal->endereco; // carregando endereco
                break;
        }

        return $user;
    }

    public function photoUser()
    {
        try {
            $user = parent::getUserLogged();

            switch ($user->tipo_id) {
                case 1:
                    if (isset($user->permissionario->foto_uid)) {
                        return Storage::download('arquivos/' . $user->permissionario->foto_uid . '.jpg');
                    }
                case 2:
                    if (isset($user->condutor->foto_uid)) {
                        return Storage::download('arquivos/' . $user->condutor->foto_uid . '.jpg');
                    }
            }
        } catch (\Exception $e) {}

        return parent::responseMsgJSON("Foto não encontrada!", 404);
    }
}
