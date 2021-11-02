<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Condutor;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CondutorController extends AdminSuperController
{

    function __construct(Request $request)
    {
        $postMethod = $request->method() == 'POST';
        parent::__construct(
            Condutor::class, [
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
                'cnh' => [
                    'required',
                    'max:15',
                ],
                'categoria_cnh' => [
                    'required',
                    'max:2',
                    'min:1'
                ],
                'vencimento_cnh' => [
                    'required',
                    'regex:'.Util::REGEX_DATE
                ],
                'atestado_de_saude' => [
                    'boolean',
                    'nullable'
                ],
                'certidao_negativa' => [
                    'boolean',
                    'nullable'
                ],
                'validade_certidao_negativa' => [
                    'nullable',
                    'regex:'.Util::REGEX_DATE
                ],
                'registro_ctps' => [
                    'boolean',
                    'nullable'
                ],
                'primeiros_socorros' => [
                    'boolean',
                    'nullable'
                ],
                'emissao_primeiros_socorros' => [
                    'nullable',
                    'regex:'.Util::REGEX_DATE
                ],
                'motivo_afastamento' => [
                    'nullable',
                    'max:40',
                ],
                'data_inicio_afastamento' => [
                    'nullable',
                    'regex:'.Util::REGEX_DATE
                ],
                'data_termino_afastamento' => [
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

        $obj = Condutor::find($id);
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
        $obj = Condutor::find($id);
        if ($obj !== null && $obj->foto == 1) {
            return Storage::download($obj->getTable() . '/foto_' . $obj->id);
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
    }

}
