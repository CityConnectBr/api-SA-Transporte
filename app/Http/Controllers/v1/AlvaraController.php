<?php
namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Alvara;
use App\Models\Arquivo;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlvaraController extends Controller
{
    function __construct(Request $request)
    {
    }

    public function show($id)
    {
        $user = parent::getUserLogged();

        $obj = Alvara::findByPermissionarioAndId($user->permissionario_id, $id);

        if ($obj == null) {
            return parent::responseMsgsJSON("Objeto não encontrado", 400);
        }

        $empresa = Empresa::findComplete($obj->empresa_id);

        $obj->empresa = $empresa->nome;
        $obj->municipio = $empresa->endereco->municipio->nome;

        return $obj;
    }
    public function updatePagamento(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'arquivo' => [
                'required',
                'file',
            ],
        ]);


        if ($validator->fails()) {
            return parent::responseMsgsJSON($validator->errors(), 400);
        }

        $user = parent::getUserLogged();

        $obj = Alvara::findByPermissionarioAndId($user->permissionario_id, $id);

        if ($obj == null) {
            return parent::responseMsgsJSON("Infração não encontrada", 400);
        }

        if ($obj->status != "pendente") {
            return parent::responseMsgsJSON("Infração já paga", 400);
        }

        if (preg_match("/([a-zA-Z0-9\s_\\.\-\(\):])+(.jpg|.jpeg|.png)$/", $request['arquivo']->getClientOriginalName()) == 0) {
            return parent::responseMsgsJSON("Arquivo inválido", 400);
        }

        $arquivo = new Arquivo();
        $arquivo->origem = "app";
        $arquivo->save();

        $request['arquivo']->storeAs('/arquivos', $arquivo->id . ".jpg");

        $obj->status = "confirmacao_pendente";
        $obj->arquivo_comprovante_uid = $arquivo->id;
        $obj->data_envio_comprovante = date('Y-m-d H:i:s');
        $obj->update();

        return $obj;
    }


}