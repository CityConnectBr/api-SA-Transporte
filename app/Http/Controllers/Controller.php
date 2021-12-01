<?php
namespace app\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Usuario;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    function __construct($objectModel, Request $request) {
        $this->objectModel = $objectModel;
        $this->request = $request;
    }
    
    protected function responseMsgJSON($message, $codigo = 200, $codigoInterno = "")
    {
        return response()->json([
            "message" => $message,
            "internal_code" => $codigoInterno
        ], $codigo);
    }
    
    protected function responseMsgsJSON($messages, $codigo = 200, $codigoInterno = "")
    {
        return response()->json([
            "messages" => $messages,
            "internal_code" => $codigoInterno
        ], $codigo);
    }

    protected function responseJSON($json, $codigo = 200)
    {
        return response()->json($json, $codigo);
    }

    protected function responseErrorJSON($message, $codigo)
    {
        return response()->json([
            "error" => $message
        ], $codigo);
    }
    
    ////////////////
    ////////////////
    ////////////////
    
    
    protected function getUserLogged()
    {
        //$user = Usuario::with("permissionario")->with("tipo")->find(auth()->id());
        $user = Usuario::findComplete(auth()->id());        
        if (! isset($user)) {
            return parent::responseMsgJSON("Usuário não encontrado", 404);
        }
        
        return $user;
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $obj = $this->objectModel::search($this->request->query->get("search"));
        if (isset($obj)) {
            return $obj;
        } else {
            return $this->responseJSON("Não encontrado", 404);
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obj = $this->objectModel::firstWhere("id", $id);
        if (isset($obj)) {
            return $obj;
        } else {
            return $this->responseJSON("Não encontrado", 404);
        }
    }
    
    
}
