<?php
namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use App\Models\Endereco;
use Illuminate\Http\Request;
use App\Models\Condutor;
use Illuminate\Support\Facades\Validator;

class CondutorController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(Condutor::class, [
            'nome' => [
                'required',
                'max:40',
                'min:3'
            ],
            'id_integracao' => [
                'required',
                'numeric'
            ],
            'situacao' => [
                'required',
                'max:1',
                'min:1'
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
        // paginate
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

        $endereco = new Endereco();
        $endereco->fill($request->all());
        $endereco->save();

        $condutor = new Condutor();
        $condutor->fill($request->all());
        $condutor->endereco_id = $endereco->id;

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
        $condutor = Condutor::findByIntegracaoComplete($id, true);
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

        $condutor = Condutor::findByIntegracaoComplete($id, true);
        if (isset($condutor)) {
            $condutor->fill($request->all());
            $condutor->versao ++;
            $condutor->endereco->fill($request->all());

            $condutor->save();
            $condutor->endereco->save();

            return $condutor;
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
