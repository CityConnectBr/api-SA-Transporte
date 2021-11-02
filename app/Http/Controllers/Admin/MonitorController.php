<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Monitor;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MonitorController extends AdminSuperController
{

    function __construct(Request $request)
    {
        $postMethod = $request->method() == 'POST';
        parent::__construct(
            Monitor::class, [
                'numero_de_cadastro_antigo' => [
                    'max:10',
                ],
                'nome' => [
                    'required',
                    'max:40',
                    'min:3'
                ],
                'cpf' => [
                    'required',
                    'max:11',
                    'min:11',
                    'regex:'.Util::REGEX_CPF_CNPJ,
                ],
                'rg' => [
                    'required',
                    'max:9',
                ],
                'telefone' => [
                    'nullable',
                    'regex:'.Util::REGEX_PHONE,
                ],
                'celular' => [
                    'nullable',
                    'regex:'.Util::REGEX_PHONE,
                ],
                'email' => [
                    'nullable',
                    'email',
                    'max:200',
                ],
                'data_nascimento' => [
                    'required',
                    'regex:'.Util::REGEX_DATE
                ],
                'certidao_negativa' => [
                    'boolean',
                    'nullable'
                ],
                'validade_da_certidao_negativa' => [
                    'nullable',
                    'regex:'.Util::REGEX_DATE
                ],
                'curso_de_primeiro_socorros' => [
                    'boolean',
                    'nullable'
                ],
                'emissao_curso_de_primeiro_socorros' => [
                    'nullable',
                    'regex:'.Util::REGEX_DATE
                ],
                'endereco_id' => [
                    $postMethod?'required':'',
                    'exists:enderecos,id'
                ],
                'permissionario_id' => [
                    $postMethod?'required':'',
                    'exists:permissionarios,id'
                ],
            ],
            $request
        );
    }

    public function storeFoto($id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'foto' => [
                'required',
                'file',
            ]
        ]);

        if ($validator->fails()) {
            return Parent::responseMsgsJSON($validator->errors(), 400);
        }

        $obj = Monitor::find($id);
        if (isset($obj)) {
            $obj->foto = true;
            if (isset($request->foto)) {
                $request->foto->storeAs('/' . $obj->getTable(), 'foto_' . $obj->id);
            }
            $obj->save();

            return $obj;
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
    }

    public function showFoto($id)
    {
        $obj = Monitor::find($id);
        if ($obj !== null && $obj->foto == 1) {
            return Storage::download($obj->getTable() . '/foto_' . $obj->id);
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
    }

}
