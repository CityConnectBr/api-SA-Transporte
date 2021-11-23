<?php
namespace app\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MarcaModeloVeiculo;
use App\Models\Veiculo;

class MarcaModeloVeiculoController extends Controller
{

    function __construct(Request $request)
    {
        parent::__construct(MarcaModeloVeiculo::class, $request);
    }

    // public function index()
    // {
    //    //dd('aqui');
    //     //if (method_exists($request, 'search')) {}
    //     $veiculo = Veiculo::returnComplete();
    //     if (isset($veiculo)) {
    //        // dd($veiculo);
    //         return $veiculo;
    //     } else {
    //         return parent::responseMsgJSON("Veiculo não encontrado", 404);
    //     }
    // }

}
