<?php
namespace app\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
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
    
}
