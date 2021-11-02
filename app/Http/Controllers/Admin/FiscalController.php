<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Fiscal;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FiscalController extends AdminSuperController
{

    function __construct(Request $request)
    {
        $postMethod = $request->method() == 'POST';
        parent::__construct(
            Fiscal::class, [
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
                    $postMethod?'unique:fiscais':''
                ],
                'telefone' => [
                    'nullable',
                    'regex:'.Util::REGEX_PHONE,
                ],
                'email' => [
                    'nullable',
                    'email',
                    'max:200',
                ],
                'cargo' => [
                    'max:40',
                ],
                'unidade_trabalho' => [
                    'max:40',
                ],
                'endereco_id' => [
                    $postMethod?'required':'',
                    'exists:enderecos,id'
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

        $obj = Fiscal::find($id);
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
        $obj = Fiscal::find($id);
        if ($obj !== null && $obj->foto == 1) {
            return Storage::download($obj->getTable() . '/foto_' . $obj->id);
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
    }
}
