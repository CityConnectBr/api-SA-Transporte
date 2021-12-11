<?php
namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use App\Models\Endereco;
use App\Models\Modalidade;
use Illuminate\Http\Request;
use App\Models\Permissionario;
use App\Utils\Util;
use Illuminate\Support\Facades\Validator;

class PermissionarioController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(Permissionario::class, [
            'numero_de_cadastro_antigo' => [
                'max:10',
            ],
            'nome_razao_social' => [
                'required',
                'max:40',
                'min:3'
            ],
            'tipo' => [
                'required',
                'regex:/(F|J)/'
            ],
            'cpf_cnpj' => [
                'required',
                'max:14',
                //'min:11',
                //'regex:' . Util::REGEX_CPF_CNPJ,
                //'unique:permissionarios'
            ],
            'rg' => [
                'max:9',
            ],
            /*'estado_civil' => [
                'required',
                'max:1',
                'min:1'
            ],*
            /*'inscricao_municipal' => [
                'required',
                'max:15',
                'min:3'
            ],*/
            'alvara_de_funcionamento' => [
                'max:15',
            ],
            'responsavel' => [
                'max:40',
            ],
            'procurador_responsavel' => [
                'max:40',
            ],
            /*('telefone' => [
                'nullable',
                'regex:' . Util::REGEX_PHONE,
            ],
            'telefone2' => [
                'nullable',
                'regex:' . Util::REGEX_PHONE,
            ],
            'celular' => [
                'nullable',
                'regex:' . Util::REGEX_PHONE,
            ],*/
            /*'email' => [
                'nullable',
                'email',
                'max:200',
            ],*/
            'data_nascimento' => [
                'nullable',
                'regex:' . Util::REGEX_DATE
            ],
            'naturalidade' => [
                'max:15',
            ],
            'nacionalidade' => [
                'max:15',
            ],
            'cnh' => [
                'max:15',
            ],
            /*'categoria_cnh' => [
                'max:2',
                'min:1'
            ],*/
            'vencimento_cnh' => [
                'regex:' . Util::REGEX_DATE
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

        $permissionario = new Permissionario();
        $permissionario->fill($request->all());
        $permissionario->modalidade_id = Modalidade::findOne($request->input('modalidade_transporte'))->id;
        $permissionario->endereco_id = $endereco->id;

        $permissionario->save();

        return $permissionario;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permissionario = Permissionario::findByIntegracaoComplete($id, true);
        if (isset($permissionario)) {
            return $permissionario;
            // return (new PermissionarioTransformer)->transform(Permissionario::find($id));
        } else {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
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

        $permissionario = Permissionario::findByIntegracaoComplete($id, true);
        if (isset($permissionario)) {
            $permissionario->fill($request->all());
            $permissionario->versao ++;
            $permissionario->modalidade_id = Modalidade::where('identificador', $request->input('modalidade_transporte'))->first()->id;
            $permissionario->endereco->fill($request->all());

            $permissionario->save();
            $permissionario->endereco->save();

            return $permissionario;
        } else {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
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
