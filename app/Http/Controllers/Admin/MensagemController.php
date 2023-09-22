<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Mail\Notification;
use App\Models\Mensagem;
use App\Models\MensagemDestinatario;
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
                            $permissionario->nome,
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


}