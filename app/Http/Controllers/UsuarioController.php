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
use App\Models\Endereco;
use Illuminate\Support\Facades\Log;

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
            ],
            // ///////////// PERMISSIONARIO
            'rg' => [
                'max:15'
            ],
            'inscricao_municipal' => [
                'max:15'
            ],
            'telefone' => [
                'max:8'
            ],
            'telefone2' => [
                'max:9'
            ],
            'celular' => [
                'max:9'
            ],
            'data_nascimento' => [
                'max:11'
            ],
            'naturalidade' => [
                'max:15'
            ],
            'nacionalidade' => [
                'max:15'
            ],
            'cnh' => [
                'max:15'
            ],
            'categoria_cnh' => [
                'max:1'
            ],
            'vencimento_cnh' => [
                'max:11'
            ]
        ]);

        if ($validator->fails()) {
            return parent::responseMsgsJSON($validator->errors(), 400);
        }

        $user = new Usuario();
        $user->fill($request->all());
        $user->password = hash::make($request->input("password"));

        $permissionario = Permissionario::firstByCpfCnpj($user->cpf_cnpj);

        if (!isset($permissionario) && isset($user->cnh)) {
            $permissionario = Permissionario::firstByCnh($user->cnh);
        }

        if (! isset($permissionario)) {
            return parent::responseMsgJSON("Nenhum permissionário previamente cadastrado", 404);
        }

        if (count(Usuario::findByEmailOrCpfCnpj($user->email, $user->cpf_cnpj)) > 0) {
            return parent::responseMsgJSON("Usuário já cadastrado", 404);
        }

        // setando tipo
        // posteriormente verificar entre os tipos existentes(fisca, condutor e etc...)
        $user->tipo_id = TiposDeUsuarios::where('nome', "permissionário")->first()->id;

        $user->permissionario_id = $permissionario->id;
        $user->save();

        // atualizando email do permissionario
        $permissionario->email = $user->email;
        $permissionario->versao ++;
        $permissionario->save();

        return Usuario::findComplete($user->id);
    }

    public function update(Request $request)
    {
        // Log::channel('stderr')->info('aki!');
        $validator = Validator::make($request->all(), [
            // ///////////// COMUNS
            'nome' => [
                'required',
                'min:4',
                'max:100'
            ]
        ]);

        if ($validator->fails()) {
            return parent::responseMsgsJSON($validator->errors(), 400);
        }

        $user = parent::getUserLogged();

        $user->nome = $request->input("nome");
        $user->save();

        $permissionario = $user->permissionario;
        if (isset($permissionario) && isset($request->all()['permissionario'])) {

            $validator = Validator::make($request->all(), [
                // ///////////// PERMISSIONARIO
                'permissionario.rg' => [
                    'max:15'
                ],
                'permissionario.inscricao_municipal' => [
                    'max:15'
                ],
                'permissionario.telefone' => [
                    'max:8'
                ],
                'permissionario.telefone2' => [
                    'max:9'
                ],
                'permissionario.celular' => [
                    'max:9'
                ],
                'permissionario.data_nascimento' => [
                    'required',
                    'max:11'
                ],
                'permissionario.naturalidade' => [
                    'max:15'
                ],
                'permissionario.nacionalidade' => [
                    'max:15'
                ],
                'permissionario.cnh' => [
                    'max:15'
                ],
                'permissionario.categoria_cnh' => [
                    'max:2'
                ],
                'permissionario.vencimento_cnh' => [
                    'max:11'
                ]
            ]);

            if ($validator->fails()) {
                return parent::responseMsgsJSON($validator->errors(), 400);
            }

            // limpando dados que nao devem ser alterados
            unset($request['permissionario']["id"]);
            unset($request['permissionario']["email"]);
            unset($request['permissionario']["id_integracao"]);
            unset($request['permissionario']["modalidade_id"]);
            unset($request['permissionario']["situacao"]);
            unset($request['permissionario']["tipo"]);
            unset($request['permissionario']["cpf_cnpj"]);
            unset($request['permissionario']["versao"]);

            $permissionario->fill($request->all()['permissionario']);

            $permissionario->versao ++;
            $permissionario->save();

            $endereco = $permissionario->endereco;
            if (isset($endereco) && isset($request->all()['permissionario']['endereco'])) {

                $validator = Validator::make($request->all(), [
                    // ///////////// ENDERECO
                    'permissionario.endereco.cep' => [
                        'required',
                        'min:4',
                        'max:40'
                    ],
                    'permissionario.endereco.endereco' => [
                        'required',
                        'min:4',
                        'max:40'
                    ],
                    'permissionario.endereco.numero' => [
                        'required',
                        'min:1',
                        'max:5'
                    ],
                    'permissionario.endereco.complemento' => [
                        'required',
                        'min:4',
                        'max:15'
                    ],
                    'permissionario.endereco.bairro' => [
                        'required',
                        'min:4',
                        'max:100'
                    ],
                    'permissionario.endereco.municipio' => [
                        'required',
                        'min:2',
                        'max:15'
                    ],
                    'permissionario.endereco.uf' => [
                        'required',
                        'min:2',
                        'max:2'
                    ]
                ]);

                if ($validator->fails()) {
                    return parent::responseMsgsJSON($validator->errors(), 400);
                }

                // limpando dados que nao devem ser alterados
                unset($request->all()['permissionario']['endereco']["id"]);

                $endereco->fill($request->all()['permissionario']['endereco']);
                $endereco->save();
            }
        }

        return parent::responseMsgJSON("Alterado com sucesso");
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
        $user->permissionario->modalidade; // carregando modalidade
        $user->permissionario->endereco; // carregando modalidade

        return $user;
    }
}
