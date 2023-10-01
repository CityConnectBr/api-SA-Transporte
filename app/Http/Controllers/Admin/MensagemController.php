<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Mail\Notification;
use App\Models\Condutor;
use App\Models\Fiscal;
use App\Models\Mensagem;
use App\Models\MensagemDestinatario;
use App\Models\Monitor;
use App\Models\Permissionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class MensagemController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            Mensagem::class,
            [],
            $request
        );
    }

    public function enviar()
    {
        $validator = Validator::make(
            $this->request->all(),
            [
                'assunto' => [
                    'required',
                    'max:40',
                    'min:3'
                ],
                'conteudo' => [
                    'required',
                    'max:500',
                    'min:3'
                ],
                'email' => [
                    'boolean',
                ],
                'push' => [
                    'boolean',
                ],
                'destinatarios' => [
                    'required',
                    'array',
                    'min:1',
                ],
            ]
        );

        if ($validator->fails()) {
            return parent::responseMsgsJSON($validator->errors(), 400);
        }

        $mensagem = new Mensagem();
        $mensagem->assunto = $this->request->assunto;
        $mensagem->conteudo = $this->request->conteudo;
        $mensagem->email = $this->request->email;
        $mensagem->push = $this->request->push;
        $mensagem->save();

        foreach ($this->request->destinatarios as $destinatario) {
            if ($destinatario['tipo'] == 'permissionario') {
                $permissionario = Permissionario::find($destinatario['id']);
                if ($permissionario != null) {
                    MensagemDestinatario::create([
                        'mensagem_id' => $mensagem->id,
                        'permissionario_id' => $permissionario->id,
                    ]);
                }
            } else if ($destinatario['tipo'] == 'condutor') {
                $permissionario = Permissionario::find($destinatario['id']);
                if ($permissionario != null) {
                    MensagemDestinatario::create([
                        'mensagem_id' => $mensagem->id,
                        'condutor_id' => $permissionario->id,
                    ]);
                }
            } else if ($destinatario['tipo'] == 'monitor') {
                $permissionario = Permissionario::find($destinatario['id']);
                if ($permissionario != null) {
                    MensagemDestinatario::create([
                        'mensagem_id' => $mensagem->id,
                        'monitor_id' => $permissionario->id,
                    ]);
                }
            } else if ($destinatario['tipo'] == 'fiscal') {
                $permissionario = Permissionario::find($destinatario['id']);
                if ($permissionario != null) {
                    MensagemDestinatario::create([
                        'mensagem_id' => $mensagem->id,
                        'fiscal_id' => $permissionario->id,
                    ]);
                }
            }
        }

        if ($mensagem->email) {
            $this->processarDestinatariosPorEmail($mensagem);
        }

        if ($mensagem->push) {
            $this->processarDestinatariosPorPush($mensagem);
        }

    }

    public function index()
    {
        $mensagens = Mensagem::all();
        foreach ($mensagens as $mensagem) {
            $mensagem->destinatarios = MensagemDestinatario::where('mensagem_id', $mensagem->id)->get();
        }
        return parent::responseJSON($mensagens);
    }

    private function processarDestinatariosPorEmail($mensagem)
    {
        $destinatarios = MensagemDestinatario::where('mensagem_id', $mensagem->id)->get();
        foreach ($destinatarios as $destinatario) {
            if ($destinatario->permissionario_id != null) {
                $permissionario = Permissionario::find($destinatario->permissionario_id);
                if ($permissionario != null) {
                    try {
                        $this->enviarEmail(
                            $permissionario->email,
                            $permissionario->nome_razao_social,
                            $mensagem->assunto,
                            $mensagem->conteudo
                        );
                        $destinatario->enviado_email = true;
                        $destinatario->save();
                    } catch (\Exception $e) {
                    }
                }
            } else if ($destinatario->condutor_id != null) {
                $condutor = Condutor::find($destinatario->condutor_id);
                if ($condutor != null) {
                    try {
                        $this->enviarEmail(
                            $condutor->email,
                            $condutor->nome,
                            $mensagem->assunto,
                            $mensagem->conteudo
                        );
                        $destinatario->enviado_email = true;
                        $destinatario->save();
                    } catch (\Exception $e) {
                    }
                }
            } else if ($destinatario->monitor_id != null) {
                $monitor = Monitor::find($destinatario->monitor_id);
                if ($monitor != null) {
                    try {
                        $this->enviarEmail(
                            $monitor->email,
                            $monitor->nome,
                            $mensagem->assunto,
                            $mensagem->conteudo
                        );
                        $destinatario->enviado_email = true;
                        $destinatario->save();
                    } catch (\Exception $e) {
                    }
                }
            } else if ($destinatario->fiscal_id != null) {
                $fiscal = Fiscal::find($destinatario->fiscal_id);
                if ($fiscal != null) {
                    try {
                        $this->enviarEmail(
                            $fiscal->email,
                            $fiscal->nome,
                            $mensagem->assunto,
                            $mensagem->conteudo
                        );
                        $destinatario->enviado_email = true;
                        $destinatario->save();
                    } catch (\Exception $e) {
                    }
                }
            }
        }
    }

    private function enviarEmail($email, $nome, $assunto, $conteudo)
    {
        $emailPattern = "/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/";

        if ($email == null || !preg_match($emailPattern, $email)) {
            new \Exception("Email inválido");
        }

        Mail::to($email)->send(new Notification($nome, $conteudo));
    }

    private function processarDestinatariosPorPush($mensagem)
    {
        $tokens = [];

        $destinatarios = MensagemDestinatario::where('mensagem_id', $mensagem->id)->get();
        foreach ($destinatarios as $destinatario) {
            if ($destinatario->permissionario_id != null) {
                $permissionario = Permissionario::findWithUsuario($destinatario->permissionario_id);
                if ($permissionario != null && $permissionario->usuario != null && $permissionario->usuario->token_fcm != null) {
                    array_push($tokens, $permissionario->usuario->token_fcm);
                }
            } else if ($destinatario->condutor_id != null) {
                $condutor = Condutor::findWithUsuario($destinatario->condutor_id);
                if ($condutor != null && $condutor->usuario != null && $condutor->usuario->token_fcm != null) {
                    array_push($tokens, $condutor->usuario->token_fcm);
                }
            } else if ($destinatario->monitor_id != null) {
                $monitor = Monitor::findWithUsuario($destinatario->monitor_id);
                if ($monitor != null && $monitor->usuario != null && $monitor->usuario->token_fcm != null) {
                    array_push($tokens, $monitor->usuario->token_fcm);
                }
            } else if ($destinatario->fiscal_id != null) {
                $fiscal = Fiscal::findWithUsuario($destinatario->fiscal_id);
                if ($fiscal != null && $fiscal->usuario != null && $fiscal->usuario->token_fcm != null) {
                    array_push($tokens, $fiscal->usuario->token_fcm);
                }
            }
        }

        $this->enviarPush($tokens, $mensagem->assunto, $mensagem->conteudo);
    }

    private function enviarPush($tokens, $assunto, $conteudo)
    {
        
        try{
            $url = Env('API_FCM_URL');
            $secToken = Env('API_FCM_TOKEN');

            $data = array(
                'tokens' => $tokens,
                'titulo' => $assunto,
                'mensagem' => $conteudo,
                'sec_token' => $secToken
            );

            $options = array(
                'http' => array(
                    'header'  => "Content-Type: application/json\r\n",
                    'method'  => 'POST',
                    'content' => json_encode($data)
                )
            );

            $context  = stream_context_create($options);

            $result = file_get_contents($url, false, $context);
        }catch(\Exception $e){
        }
    }
}