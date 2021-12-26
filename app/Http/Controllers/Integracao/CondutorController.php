<?php
namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use App\Models\Endereco;
use Illuminate\Http\Request;
use App\Models\Condutor;
use Illuminate\Support\Facades\Validator;
use App\Models\Permissionario;
use App\Utils\Util;

class CondutorController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(Condutor::class, [
            'numero_de_cadastro_antigo' => [
                'max:10',
            ],
            'nome' => [
                'required',
                'max:40',
                'min:3'
            ],
            'cpf' => [
                'max:11',
            ],
            'rg' => [
                'max:9',
            ],
            'telefone' => [
                'nullable',
                'regex:'.Util::REGEX_PHONE,
            ],
            'celular' => [
                'nullable',
                'regex:'.Util::REGEX_PHONE,
            ],
            'email' => [
                'max:200',
            ],
            'cnh' => [
                'required',
                'max:15',
            ],
            'categoria_cnh' => [
                'max:2',
            ],
            'validade_certidao_negativa' => [
                'nullable',
                'regex:'.Util::REGEX_DATE
            ],
            'emissao_primeiros_socorros' => [
                'nullable',
                'regex:'.Util::REGEX_DATE
            ],
            'motivo_afastamento' => [
                'nullable',
                'max:40',
            ],
            'data_inicio_afastamento' => [
                'nullable',
                'regex:'.Util::REGEX_DATE
            ],
            'data_termino_afastamento' => [
                'nullable',
                'regex:'.Util::REGEX_DATE
            ],
            'permissionario_id' => [
                'required',
            ],
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
        $endereco->save();

        $condutor = new Condutor();
        $condutor->fill($request->all());
        $condutor->permissionario_id = $permissionario->id;
        $condutor->cpf = $condutor->id_integracao;
        $condutor->endereco_id = $endereco->id;

        $condutor->atestado_de_saude = $condutor->atestado_de_saude!=null?$condutor->atestado_de_saude=="S":null;
        $condutor->certidao_negativa = $condutor->certidao_negativa!=null?$condutor->certidao_negativa=="S":null;
        $condutor->registro_ctps = $condutor->registro_ctps!=null?$condutor->registro_ctps=="S":null;
        $condutor->primeiros_socorros = $condutor->primeiros_socorros!=null?$condutor->primeiros_socorros=="S":null;

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

        $permissionario = Permissionario::findByIntegracaoComplete($request->input('permissionario_id'));
        if (! isset($permissionario)) {
            return parent::responseMsgJSON("Permissionário relacionado não encontrado", 404);
        }

        $condutor = Condutor::findByIntegracaoComplete($id, true);
        if (isset($request["id_real"])) {
            $condutor = Condutor::findComplete($id, true);
        }

        if (isset($condutor)) {
            unset($request['id']);
            unset($request['endereco_id']);

            $condutor->fill($request->all());
            $condutor->versao ++;
            $condutor->endereco->fill($request->all());
            $condutor->cpf = $condutor->id_integracao;
            $condutor->permissionario_id = $permissionario->id;

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
