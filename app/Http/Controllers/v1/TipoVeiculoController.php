<?php
namespace app\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoVeiculo;

class TipoVeiculoController extends Controller
{

    function __construct(Request $request)
    {
        parent::__construct(TipoVeiculo::class, $request);
    }
}
