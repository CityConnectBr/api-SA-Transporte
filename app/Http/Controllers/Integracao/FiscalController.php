<?php
namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Fiscal;

class FiscalController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(Fiscal::class, [
            'nome' => [
                'required',
                'max:40',
                'min:3'
            ],
            'id_integracao' => [
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

        $endereco = new Endereco();
        $endereco->fill($request->all());
        $endereco->save();

        $fiscal = new Fiscal();
        $fiscal->fill($request->all());
        $fiscal->endereco_id = $endereco->id;

        $fiscal->save();

        return $fiscal;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fiscal = Fiscal::findByIntegracaoComplete($id);
        if (isset($fiscal)) {
            return $fiscal;
        } else {
            return parent::responseMsgJSON("Fiscal não encontrado", 404);
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

        $fiscal = Fiscal::findByIntegracaoComplete($id);
        if (isset($request["id_real"])) {
            $fiscal = Fiscal::findComplete($id);
        }

        if (isset($fiscal)) {
            unset($request['id']);
            unset($request['endereco_id']);

            $fiscal->fill($request->all());
            $fiscal->versao ++;
            $fiscal->endereco->fill($request->all());

            $fiscal->save();
            $fiscal->endereco->save();

            return $fiscal;
        } else {
            return parent::responseMsgJSON("Fiscal não encontrado", 404);
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
