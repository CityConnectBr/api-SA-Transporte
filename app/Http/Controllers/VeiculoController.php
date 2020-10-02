<?php
namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Veiculo;

class VeiculoController extends Controller
{

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    private $validatorVeiculosList = [
        'placa' => [
            'required',
            'max:7'
        ],
        'cod_renavam' => [
            'required',
            'max:11'
        ],
        'chassi' => [
            'required',
            'max:25'
        ],
        'ano_fabricacao' => [
            'required'
        ],
        'capacidade' => [
            'required',
            'max:15'
        ],
        'observacao_capacidade' => [
            'max:40'
        ],
        'tipo_capacidade' => [
            'required'
        ],
        'anos_vida_util_veiculo' => [
            'required'
        ],
        'marca_modelo_veiculo_id' => [
            'required'
        ],
        'tipo_combustivel_id' => [
            'required'
        ],
        'cor_id' => [
            'required'
        ],
        'tipo_veiculo_id' => [
            'required'
        ],
        'categoria_id' => [
            'required'
        ]
    ];

    private $validatorOnibusList = [ // fazer ainda
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Veiculo::search(parent::getUserLogged()->permissionario_id, $this->request->query->get("search"));
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
        $categoriaID = $request['categoria_id'];
        if (! isset($categoriaID)) {
            return parent::responseMsgJSON("Categoria do veículo não determinada", 404);
        }

        $validator = Validator::make($request->all(), $categoriaID == 1 ? $this->validatorVeiculosList : $this->validatorOnibusList);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $veiculo = new Veiculo();
        $veiculo->fill($request->all());
        $veiculo->permissionario_id = parent::getUserLogged()->permissionario_id;
        $veiculo->situacao = "A";

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
        $veiculo = Veiculo::findComplete($id);
        if (isset($veiculo)) {
            return $veiculo;
        } else {
            return parent::responseMsgJSON("Veiculo não encontrado", 404);
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
        $this->show($id);
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
        $veiculo = Veiculo::findComplete($id);
        if (isset($veiculo)) {

            $categoriaID = $request['categoria_id'];
            if (! isset($categoriaID)) {
                return parent::responseMsgJSON("Categoria do veículo não determinada", 404);
            }

            $validator = Validator::make($request->all(), $categoriaID == 1 ? $this->validatorVeiculosList : $this->validatorOnibusList);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $veiculo->fill($request->all());
            $veiculo->versao ++;

            $veiculo->save();

            return parent::responseMsgJSON("Alterado com sucesso");
        } else {
            return parent::responseMsgJSON("Veiculo não encontrado", 404);
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
