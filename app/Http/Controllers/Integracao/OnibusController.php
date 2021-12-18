<?php
namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use Illuminate\Http\Request;
use App\Models\Veiculo;
use Illuminate\Support\Facades\Validator;
use App\Models\MarcaModeloCarroceria;
use App\Models\MarcaModeloChassi;
use App\Models\TipoCombustivel;
use App\Models\CorVeiculo;

class OnibusController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(Veiculo::class, [
            'placa' => [
                'required',
                'max:7',
            ],
            'marca_modelo_carroceria_id' => [
                'required',
            ],
            'marca_modelo_chassi_id' => [
                'required',
            ],
            'tipo_combustivel_id' => [
                'required',
            ],
            'cor_id' => [
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
        $veiculo->categoria_id = 2;//Onibus
        //$veiculo->id_integracao = $veiculo->placa;
        $veiculo->marca_modelo_carroceria_id = MarcaModeloCarroceria::firstWhere("id_integracao", $request->input("marca_modelo_carroceria_id"))->id;
        $veiculo->marca_modelo_chassi_id = MarcaModeloChassi::firstWhere("id_integracao", $request->input("marca_modelo_chassi_id"))->id;
        $veiculo->tipo_combustivel_id = TipoCombustivel::firstWhere("id_integracao", $request->input("tipo_combustivel_id"))->id;
        $veiculo->cor_id = CorVeiculo::firstWhere("id_integracao", $request->input("cor_id"))->id;

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
        $id = str_replace("-", "/", $id);
        $veiculo = Veiculo::findByIntegracaoComplete($id, true);
        if (isset($veiculo)) {
            return $veiculo;
        } else {
            return parent::responseMsgJSON("Ônibus não encontrado", 404);
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

        $id = str_replace("-", "/", $id);

        $veiculo = Veiculo::findByIntegracaoComplete($id, true);
        if (isset($veiculo)) {
            $veiculo->fill($request->all());
            $veiculo->versao ++;
            $veiculo->categoria_id = 2;//Onibus
            $veiculo->marca_modelo_carroceria_id = MarcaModeloCarroceria::firstWhere("id_integracao", $request->input("marca_modelo_carroceria_id"))->id;
            $veiculo->marca_modelo_chassi_id = MarcaModeloChassi::firstWhere("id_integracao", $request->input("marca_modelo_chassi_id"))->id;
            $veiculo->tipo_combustivel_id = TipoCombustivel::firstWhere("id_integracao", $request->input("tipo_combustivel_id"))->id;
            $veiculo->cor_id = CorVeiculo::firstWhere("id_integracao", $request->input("cor_id"))->id;

            $veiculo->save();

            return $veiculo;
        } else {
            return parent::responseMsgJSON("Ônibus não encontrado", 404);
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
