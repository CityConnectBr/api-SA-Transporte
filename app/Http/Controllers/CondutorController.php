<?php
namespace app\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;
use App\Models\Condutor;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class CondutorController extends Controller
{
    
    private $validatorList = [
        'rg' => [
            'required',
            'max:15'
        ],
        'cpf' => [
            'required',
            'max:15'
        ],
        'telefone' => [
            'max:8'
        ],
        'celular' => [
            'max:9'
        ],
        'data_nascimento' => [
            'required',
            'max:11'
        ],
        'naturalidade' => [
            'max:15'
        ],
        'nacionalidade' => [
            'max:15'
        ],
        'cnh' => [
            'required',
            'max:15'
        ],
        'categoria_cnh' => [
            'required',
            'min:1',
            'max:2'
        ],
        'vencimento_cnh' => [
            'required',
            'max:11'
        ],
        'endereco.cep' => [
            'required',
            'min:4',
            'max:40'
        ],
        'endereco.endereco' => [
            'required',
            'min:4',
            'max:40'
        ],
        'endereco.numero' => [
            'required',
            'min:1',
            'max:5'
        ],
        'endereco.complemento' => [
            'max:15'
        ],
        'endereco.bairro' => [
            'required',
            'min:4',
            'max:100'
        ],
        'endereco.municipio' => [
            'required',
            'min:2',
            'max:15'
        ],
        'endereco.uf' => [
            'required',
            'min:2',
            'max:2'
        ]
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Condutor::search(parent::getUserLogged()->permissionario_id, $request->query->get("search"));
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

        $endereco = new Endereco();
        $endereco->fill($request->all()["endereco"]);
        $endereco->save();

        $condutor = new Condutor();
        $condutor->fill($request->all());
        $condutor->endereco_id = $endereco->id;
        $condutor->permissionario_id = parent::getUserLogged()->permissionario_id;
        $condutor->situacao = "A";

        $condutor->save();

        return $condutor;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $condutor = Condutor::findComplete($id);
        if (isset($condutor)) {
            return $condutor;
        } else {
            return parent::responseMsgJSON("Condutor não encontrado", 404);
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
//         $validator = Validator::make($request->all(), $this->validatorList);

//         if ($validator->fails()) {
//             return parent::responseJSON($validator->errors(), 400);
//         }

        $condutor = Condutor::findComplete($id);
        if (isset($condutor)) {
            $condutor->fill($request->all());
            $condutor->versao ++;
            $condutor->endereco->fill($request->all()["endereco"]);

            $condutor->save();
            $condutor->endereco->save();

            return parent::responseMsgJSON("Alterado com sucesso");
        } else {
            return parent::responseMsgJSON("Condutor não encontrado", 404);
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
