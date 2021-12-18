<?php
namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use Illuminate\Http\Request;
use App\Models\Veiculo;
use Illuminate\Support\Facades\Validator;
use App\Models\TipoCombustivel;
use App\Models\CorVeiculo;
use App\Models\MarcaModeloVeiculo;
use App\Models\TipoVeiculo;
use App\Models\Permissionario;

class VeiculoController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(Veiculo::class, [
            'marca_modelo_veiculo_id' => [
                'required',
            ],
            'tipo_combustivel_id' => [
                'required',
            ],
            'tipo_veiculo_id' => [
                'required',
            ],
            'cor_id' => [
                'required',
            ],
            'permissionario_id' => [
                'required',
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            "Message" => "Não implementado!"
        ], 501);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            "Message" => "Não implementado!"
        ], 501);
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

        $veiculo = new Veiculo();
        $veiculo->fill($request->all());
        $veiculo->categoria_id = 1;//Veiculo
        //$veiculo->placa = $request->input("id_integracao");
        $veiculo->marca_modelo_veiculo_id = MarcaModeloVeiculo::firstWhere("id_integracao", $request->input("marca_modelo_veiculo_id"))->id;
        $veiculo->permissionario_id = Permissionario::firstWhereByIntegracao($request->input("permissionario_id"))->id;
        if($request->input("tipo_combustivel_id")!=null && $request->input("tipo_combustivel_id")>0){
            $veiculo->tipo_combustivel_id = TipoCombustivel::firstWhere("id_integracao", $request->input("tipo_combustivel_id"))->id;
        }else{
            $veiculo->tipo_combustivel_id = null;
        }
        if($request->input("tipo_veiculo_id")!=null && $request->input("tipo_veiculo_id")>0){
            $veiculo->tipo_veiculo_id = TipoVeiculo::firstWhere("id_integracao", $request->input("tipo_veiculo_id"))->id;
        }else{
            $veiculo->tipo_veiculo_id = null;
        }
        if($request->input("cor_id")!=null && $request->input("cor_id")>0){
            $veiculo->cor_id = CorVeiculo::firstWhere("id_integracao", $request->input("cor_id"))->id;
        }else{
            $veiculo->cor_id = null;
        }

        $veiculo->save();

        return $veiculo;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $veiculo = Veiculo::findByIntegracaoComplete($id, true);
        if (isset($veiculo)) {
            return $veiculo;
        } else {
            return parent::responseMsgJSON("Veículo não encontrado", 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json([
            "Message" => "Não implementado!"
        ], 501);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->validatorList);

        if ($validator->fails()) {
            return parent::responseJSON($validator->errors(), 400);
        }

        $veiculo = Veiculo::findByIntegracaoComplete($id, true);
        if (isset($veiculo)) {
            $veiculo->fill($request->all());
            $veiculo->versao ++;
            $veiculo->categoria_id = 1;//Onibus
            $veiculo->marca_modelo_veiculo_id = MarcaModeloVeiculo::firstWhere("id_integracao", $request->input("marca_modelo_veiculo_id"))->id;
            $veiculo->tipo_combustivel_id = TipoCombustivel::firstWhere("id_integracao", $request->input("tipo_combustivel_id"))->id;
            $veiculo->tipo_veiculo_id = TipoVeiculo::firstWhere("id_integracao", $request->input("tipo_veiculo_id"))->id;
            $veiculo->cor_id = CorVeiculo::firstWhere("id_integracao", $request->input("cor_id"))->id;
            $veiculo->permissionario_id = Permissionario::firstWhereByIntegracao($request->input("permissionario_id"))->id;

            $veiculo->save();

            return $veiculo;
        } else {
            return parent::responseMsgJSON("Veículo não encontrado", 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json([
            "Message" => "Não implementado!"
        ], 501);
    }
}
