<?php
namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use App\Models\Certidao;
use App\Models\CorVeiculo;
use App\Models\MarcaModeloVeiculo;
use App\Models\Permissionario;
use App\Models\Ponto;
use App\Models\TipoCombustivel;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class CertidaoController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(Certidao::class, [
            'data' => [
                'required',
                'regex:' . Util::REGEX_DATE,
            ],
            'renavam' => [
                'required',
                'max:11',
                'min:11'
            ],
            'placa' => [
                'required',
                'max:7',
                'min:7'
            ],
            'ano_fabricacao' => [
                'required',
                'max:4',
                'regex:'.Util::REGEX_NUMBER
            ],
            'chassis' => [
                'max:25',
            ],
            'prefixo' => [
                'required',
                'max:15',
                'min:3'
            ],
            'observacao' => [
                'max:200',
            ],
            'permissionario_id' => [
                'required',
            ],
            'marca_modelo_veiculo_id' => [
                'required',
            ],
            'cor_id' => [
                'required',
            ],
            'ponto_id' => [
                'required',
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validatorList);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $obj = new Certidao();
        $obj->fill($request->all());

        //TIPO

        if($request->input("permissionario_id")!=null && $request->input("permissionario_id")!='')
            $obj->permissionario_id = Permissionario::firstWhere("id_integracao", $request->input("permissionario_id"))->id;

        if($request->input("marca_modelo_veiculo_id")!=null && $request->input("marca_modelo_veiculo_id")!=''){
            $marcaModeloVeiculoArray = MarcaModeloVeiculo::getByDescricao($request->input("marca_modelo_veiculo_id"));
            $obj->marca_modelo_veiculo_id = sizeof($marcaModeloVeiculoArray)>0?$marcaModeloVeiculoArray[0]->id:null;
        }

        if($request->input("combustivel_id")!=null && $request->input("combustivel_id")!=''){
            $tipoCombustivel = TipoCombustivel::getByDescricao($request->input("combustivel_id"));
            $obj->tipo_combustivel_id = sizeof($tipoCombustivel)>0?$tipoCombustivel[0]->id:null;
        }

        if($request->input("cor_id")!=null && $request->input("cor_id")!=''){
            $cor = CorVeiculo::getByDescricao($request->input("cor_id"));
            $obj->cor_id = sizeof($cor)>0?$cor[0]->id:null;
        }

        if($request->input("ponto_id")!=null && $request->input("ponto_id")!=''){
            $ponto = Ponto::getByDescricao($request->input("ponto_id"));
            $obj->ponto_id = sizeof($ponto)>0?$ponto[0]->id:null;
        }

        $obj->save();

        return $obj;
    }

}
