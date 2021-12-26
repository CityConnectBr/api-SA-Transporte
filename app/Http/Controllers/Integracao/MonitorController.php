<?php
namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Monitor;
use App\Models\Municipio;
use App\Models\Permissionario;

class MonitorController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(Monitor::class, [
            'nome' => [
                'required',
                'max:40',
                'min:3'
            ],
            'id_integracao' => [
                'required',
            ],
            'permissionario_id' => [
                'required',
                'numeric'
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

        $permissionario = Permissionario::findByIntegracaoComplete($request->input('permissionario_id'));
        if (! isset($permissionario)) {
            return parent::responseMsgJSON("Permissionário relacionado não encontrado", 404);
        }

        $endereco = new Endereco();
        $endereco->fill($request->all());
        $municipios = Municipio::searchByUf($endereco->uf, $request['municipio']);
        if(sizeof($municipios)>0){
            $endereco->municipio_id = $municipios[0]->id;
        }
        $endereco->save();

        $monitor = new Monitor();
        $monitor->fill($request->all());
        $monitor->endereco_id = $endereco->id;
        $monitor->rg = $monitor->id_integracao;
        $monitor->permissionario_id = $permissionario->id;

        $monitor->certidao_negativa = $monitor->certidao_negativa!=null?$monitor->certidao_negativa=="S":null;
        $monitor->curso_de_primeiro_socorros = $monitor->curso_de_primeiro_socorros!=null?$monitor->curso_de_primeiro_socorros=="S":null;

        $monitor->save();

        return $monitor;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $monitor = Monitor::findByIntegracaoComplete($id, true);
        if (isset($monitor)) {
            return $monitor;
        } else {
            return parent::responseMsgJSON("Monitor não encontrado", 404);
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
