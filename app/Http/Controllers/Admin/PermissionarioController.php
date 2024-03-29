<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Condutor;
use App\Models\Permissionario;
use App\Models\SolicitacaoDeAlteracao;
use App\Models\Veiculo;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionarioController extends AdminSuperController
{

    function __construct(Request $request)
    {
        $postMethod = $request->method() == 'POST';
        parent::__construct(
            Permissionario::class,
            [
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
                    'min:11',
                    'regex:' . Util::REGEX_CPF_CNPJ,
                    //$postMethod ? 'unique:permissionarios' : ''
                ],
                'rg' => [
                    'max:9',
                ],
                'estado_civil' => [
                    'required',
                    'max:1',
                    'min:1'
                ],
                'inscricao_municipal' => [
                    'required',
                    'max:15',
                    'min:3'
                ],
                'alvara_de_funcionamento' => [
                    'max:15',
                ],
                'prefixo' => [
                    'required',
                    'max:15',
                    'min:3'
                ],
                'responsavel' => [
                    'max:40',
                ],
                'procurador_responsavel' => [
                    'max:40',
                ],
                'telefone' => [
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
                ],
                'email' => [
                    'nullable',
                    'email',
                    'max:200',
                ],
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
                'categoria_cnh' => [
                    'max:2',
                    'min:1'
                ],
                'endereco_id' => [
                    $postMethod ? 'required' : '',
                    'exists:enderecos,id'
                ],
                'vencimento_cnh' => [
                    'regex:' . Util::REGEX_DATE
                ]
            ],
            $request
        );
    }

    public function index()
    {
        $objSearch = null;
        $search = $this->request->input('search');
        if ($search == null) {
            $search = $this->request->query('search');
        }

        $ativo = $this->request->input('ativo');
        $modalidade = $this->request->input('modalidade');
        $usuario = $this->request->input('usuario');
        $todos = $this->request->input('todos');
        $emailPushValidos = $this->request->input('email_push_validos');

        if (isset($todos)) {
            $objSearch = $this->objectModel::search($search, $ativo, $modalidade, $usuario, true, $emailPushValidos);
        } else {
            $objSearch = $this->objectModel::search($search, $ativo, $modalidade, $usuario, false, $emailPushValidos);
        }

        if ($objSearch != null) {
            return $objSearch;
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
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
            return parent::responseMsgsJSON($validator->errors(), 400);
        }

        $obj = new $this->objectModel();
        $obj->fill($request->all());

        $obj->save();

        $solicitacao = SolicitacaoDeAlteracao::find($request['solicitacao_substituicao_id']);
        if($solicitacao!=null && $solicitacao->status!="A"){
            $solicitacao->status="A";
            $solicitacao->update();
        }

        return $obj;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateModalidade(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'modalidade_id' => [
                'required',
                'exists:modalidades,id'
            ],
            'inss' => [
                'required',
                'max:10',
                'min:3'
            ],
        ]);

        if ($validator->fails()) {
            return parent::responseMsgsJSON($validator->errors(), 400);
        }

        $obj = Permissionario::find($id);
        if (isset($obj)) {
            $obj->fill($request->all());
            $obj->update();

            return $obj;
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateDocumentos(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'atestado_de_saude' => [
                'boolean',
                'nullable'
            ],
            'certidao_negativa' => [
                'boolean',
                'nullable'
            ],
            'validade_certidao_negativa' => [
                'regex:' . Util::REGEX_DATE,
                'nullable'
            ],
            'comprovante_de_endereco' => [
                'boolean',
                'nullable'
            ],
            'inscricao_do_cadastro_mobiliario' => [
                'boolean',
                'nullable'
            ],
            'numero_do_cadastro_mobiliario' => [
                'max:10',
                'nullable'
            ],
            'curso_primeiro_socorros' => [
                'boolean',
                'nullable'
            ],
            'curso_primeiro_socorros_emissao' => [
                'regex:' . Util::REGEX_DATE,
                'nullable'
            ],
            'crlv' => [
                'boolean',
                'nullable'
            ],
            'dpvat' => [
                'boolean',
                'nullable'
            ],
            'certificado_pontuacao_cnh' => [
                'boolean',
                'nullable'
            ],
            'contrato_comodato' => [
                'boolean',
                'nullable'
            ],
            'contrato_comodato_validade' => [
                'regex:' . Util::REGEX_DATE,
                'nullable'
            ],
            'ipva' => [
                'boolean',
                'nullable'
            ],
            'relacao_dos_alunos_transportados' => [
                'boolean',
                'nullable'
            ],
            'laudo_vistoria_com_aprovacao_da_sa_trans' => [
                'boolean',
                'nullable'
            ],
            'ciretran_vistoria' => [
                'boolean',
                'nullable'
            ],
            'ciretran_autorizacao' => [
                'boolean',
                'nullable'
            ],
            'selo_gnv' => [
                'boolean',
                'nullable'
            ],
            'selo_gnv_validade' => [
                'regex:' . Util::REGEX_DATE,
                'nullable'
            ],
            'taximetro_tacografo' => [
                'boolean',
                'nullable'
            ],
            'taximetro_tacografo_numero' => [
                'max:10',
                'nullable'
            ],
            'taximetro_tacografo_afericao' => [
                'regex:' . Util::REGEX_DATE,
                'nullable'
            ],
            'inicio_atividades' => [
                'regex:' . Util::REGEX_DATE,
                'nullable'
            ],
            'termino_atividades' => [
                'regex:' . Util::REGEX_DATE,
                'nullable'
            ],
            'termino_atividades_motivo' => [
                'max:15',
                'nullable'
            ],
            'data_transferencia' => [
                'regex:' . Util::REGEX_DATE,
                'nullable'
            ],
        ]);

        if ($validator->fails()) {
            return parent::responseMsgsJSON($validator->errors(), 400);
        }

        $obj = Permissionario::find($id);
        if (isset($obj)) {
            $obj->fill($request->all());
            $obj->update();

            return $obj;
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateFalecimento(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'data_obito' => [
                'required',
                'regex:' . Util::REGEX_DATE,
            ],
            'certidao_de_obito' => [
                'required',
                'max:15',
                'min:3'
            ],
            'observacao_obito' => [
                'max:200',
            ],
            'nome_inventariante' => [
                'max:40',
            ],
            'grau_de_paretesco_inventariante' => [
                'max:15',
            ],
            'numero_do_processo_do_inventario' => [
                'max:15',
            ],
            'parecer_do_juiz_sobre_inventario' => [
                'max:500',
            ],
        ]);

        if ($validator->fails()) {
            return parent::responseMsgsJSON($validator->errors(), 400);
        }

        $obj = Permissionario::find($id);
        if (isset($obj)) {
            $obj->fill($request->all());
            $obj->nome_razao_social = $obj->nome_razao_social . " (FALECIDO)";
            $obj->update();

            return $obj;
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
    }

    public function indexVeiculos($id)
    {
        $obj = Permissionario::find($id);
        if ($obj == null) {
            return parent::responseMsgJSON("Não encontrado", 404);
        }

        return Veiculo::searchByIdPermissionario($id, "");
    }

    public function indexCondutores($id)
    {
        $obj = Permissionario::find($id);
        if ($obj == null) {
            return parent::responseMsgJSON("Não encontrado", 404);
        }

        return Condutor::searchByPermissionario($id, "");
    }
}