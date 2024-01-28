<?php
namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use App\Models\Alvara;
use App\Models\Endereco;
use App\Models\EntidadeAssociativa;
use App\Models\Modalidade;
use App\Models\Municipio;
use Illuminate\Http\Request;
use App\Models\Permissionario;
use App\Models\Ponto;
use App\Models\PontoDoPermissionario;
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

    private $estadoCivilDePara = [
        1=>'S',
        2=>'C',
        3=>'Di',
        4=>'V',
        5=>'De',
        6=>'M',
        7=>'O',
    ];

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
        $municipios = Municipio::searchByUf($endereco->uf, $request['municipio']);
        if(sizeof($municipios)>0){
            $endereco->municipio_id = $municipios[0]->id;
        }
        $endereco->save();

        $permissionario = new Permissionario();
        $permissionario->fill($request->all());

        $permissionario->modalidade_id = Modalidade::findOne($request->input('modalidade_transporte'))->id;
        $permissionario->endereco_id = $endereco->id;

        $permissionario->estado_civil =
            $permissionario->estado_civil!=null?$this->estadoCivilDePara[$permissionario->estado_civil]:null;

        //Log::channel('stderr')->info($permissionario->certidao_negativa);

        $permissionario->atestado_de_saude = $permissionario->atestado_de_saude!=null?$permissionario->atestado_de_saude=="S":null;
        $permissionario->certidao_negativa = $permissionario->certidao_negativa!=null?$permissionario->certidao_negativa=="S":null;
        $permissionario->comprovante_de_endereco = $permissionario->comprovante_de_endereco!=null?$permissionario->comprovante_de_endereco=="S":null;
        $permissionario->inscricao_do_cadastro_mobiliario = $permissionario->inscricao_do_cadastro_mobiliario!=null?$permissionario->inscricao_do_cadastro_mobiliario=="S":null;
        $permissionario->curso_primeiro_socorros = $permissionario->curso_primeiro_socorros!=null?$permissionario->curso_primeiro_socorros=="S":null;
        $permissionario->crlv = $permissionario->crlv!=null?$permissionario->crlv=="S":null;
        $permissionario->dpvat = $permissionario->dpvat!=null?$permissionario->dpvat=="S":null;
        $permissionario->certificado_pontuacao_cnh = $permissionario->certificado_pontuacao_cnh!=null?$permissionario->certificado_pontuacao_cnh=="S":null;
        $permissionario->contrato_comodato = $permissionario->contrato_comodato!=null?$permissionario->contrato_comodato=="S":null;
        $permissionario->ipva = $permissionario->ipva!=null?$permissionario->ipva=="S":null;
        $permissionario->relacao_dos_alunos_transportados = $permissionario->relacao_dos_alunos_transportados!=null?$permissionario->relacao_dos_alunos_transportados=="S":null;
        $permissionario->laudo_vistoria_com_aprovacao_da_sa_trans = $permissionario->laudo_vistoria_com_aprovacao_da_sa_trans!=null?$permissionario->laudo_vistoria_com_aprovacao_da_sa_trans=="S":null;
        $permissionario->ciretran_vistoria = $permissionario->ciretran_vistoria!=null?$permissionario->ciretran_vistoria=="S":null;
        $permissionario->ciretran_autorizacao = $permissionario->ciretran_autorizacao!=null?$permissionario->ciretran_autorizacao=="S":null;
        $permissionario->selo_gnv = $permissionario->selo_gnv!=null?$permissionario->selo_gnv=="S":null;
        $permissionario->taximetro_tacografo = $permissionario->taximetro_tacografo!=null?$permissionario->taximetro_tacografo=="S":null;

        $situacao = $request->input('situacao');
        if($situacao!=null){
            if($situacao=="A"){
                $permissionario->ativo = true;
            }else if($situacao=="I"){
                $permissionario->ativo = false;
            }
        }else{
            $permissionario->ativo = true;
        }

        if($request['entidade_associativa_id']!=null)
            $permissionario->entidade_associativa_id = EntidadeAssociativa::firstWhere("id_integracao", $request->input("entidade_associativa_id"))->id;

        $permissionario->save();

        for($i= 1;$i < 10;$i++){
            if($request['ponto'.$i]!=null){
                $ponto = Ponto::firstWhere("id_integracao", $request['ponto'.$i]);
                if($ponto!=null){
                    $pontoDoPermissionario = new PontoDoPermissionario();
                    $pontoDoPermissionario->ponto_id = $ponto->id;
                    $pontoDoPermissionario->permissionario_id = $permissionario->id;
                    $pontoDoPermissionario->save();
                }
            }
        }

        $alvara = new Alvara();
        $alvara->fill($request->all());
        $alvara->permissionario_id = $permissionario->id;
        $alvara->save();

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
        $permissionario = Permissionario::findByIntegracaoComplete($id);
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

        $permissionario = Permissionario::findByIntegracaoComplete($id);
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
