<?php
namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Arquivo;
use App\Models\Infracao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InfracaoController extends Controller
{
    function __construct(Request $request)
    {
    }

    public function index()
    {
        $user = parent::getUserLogged();

        return Infracao::findByPermissionarioByStatus($user->permissionario_id, 'pendente');
    }

    public function show($id)
    {
        $user = parent::getUserLogged();

        $obj = Infracao::findByPermissionarioAndId($user->permissionario_id, $id);

        if($obj==null){
            return Parent::responseMsgsJSON("Objeto não encontrado", 400);
        }

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
            return Parent::responseMsgsJSON($validator->errors(), 400);
        }

        $user = parent::getUserLogged();

        $obj = Infracao::findByPermissionarioAndId($user->permissionario_id, $id);

        if($obj==null){
            return Parent::responseMsgsJSON("Infração não encontrada", 400);
        }

        if($obj->status!="pendente"){
            return Parent::responseMsgsJSON("Infração já paga", 400);
        }

        if(preg_match("/([a-zA-Z0-9\s_\\.\-\(\):])+(.jpg|.jpeg|.png)$/", $request['arquivo']->getClientOriginalName())==0){
            return Parent::responseMsgsJSON("Arquivo inválido", 400);
        }

        $arquivo = new Arquivo();
        $arquivo->origem = "app";
        $arquivo->save();

        $request['arquivo']->storeAs('/arquivos', $arquivo->id . ".jpg");

        $obj->status="confirmacao_pendente";
        $obj->arquivo_comprovante_uid=$arquivo->id;
        $obj->data_envio_comprovante=date('Y-m-d H:i:s');
        $obj->update();

        return $obj;
    }


}
