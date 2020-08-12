<?php

namespace app\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function responseMsgJSON($message, $codigo = 200)
    {
        return response()->json(["message"=>$message], $codigo);
    }
    
    protected function responseJSON($json, $codigo = 200)
    {
        return response()->json($json, $codigo);
    }

    protected function responseErrorJSON($message, $codigo)
    {
        return response()->json(["error"=>$message], $codigo);
    }
}
