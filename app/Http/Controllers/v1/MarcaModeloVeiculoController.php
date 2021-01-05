<?php
namespace app\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MarcaModeloVeiculo;

class MarcaModeloVeiculoController extends Controller
{

    function __construct(Request $request)
    {
        parent::__construct(MarcaModeloVeiculo::class, $request);
    }
}
