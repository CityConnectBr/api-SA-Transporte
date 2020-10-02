<?php
namespace app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CorVeiculo;
use Illuminate\Http\Request;

class CorVeiculoController extends Controller
{

    function __construct(Request $request)
    {
        parent::__construct(CorVeiculo::class, $request);
    }
}
