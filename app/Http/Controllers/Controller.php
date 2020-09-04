<?php
namespace app\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function __construct($objectModel, $validatorList) {
        $this->objectModel = $objectModel;
        $this->validatorList = $validatorList;
        
    }
    
    protected function responseMsgJSON($message, $codigo = 200, $codigoInterno = "")
    {
        return response()->json([
            "message" => $message,
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
    
}
