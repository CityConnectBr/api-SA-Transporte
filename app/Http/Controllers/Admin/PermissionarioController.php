<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Permissionario;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionarioController extends AdminSuperController
{

    function __construct(Request $request)
    {
        $postMethod = $request->method() == 'POST';
        parent::__construct(
            Permissionario::class, [
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
                    'regex:'.Util::REGEX_CPF_CNPJ,
                    $postMethod?'unique:permissionarios':''
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
                'responsavel' => [
                    'max:40',
                ],
                'procurador_responsavel' => [
                    'max:40',
                ],
                'telefone' => [
                    'nullable',
                    'regex:'.Util::REGEX_PHONE,
                ],
                'telefone2' => [
                    'nullable',
                    'regex:'.Util::REGEX_PHONE,
                ],
                'celular' => [
                    'nullable',
                    'regex:'.Util::REGEX_PHONE,
                ],
                'email' => [
                    'nullable',
                    'email',
                    'max:200',
                ],
                'data_nascimento' => [
                    'nullable',
                    'regex:'.Util::REGEX_DATE
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
                    $postMethod?'required':'',
                    'exists:enderecos,id'
                ],
                'vencimento_cnh' => [
                    'regex:'.Util::REGEX_DATE
                ]
            ],
            $request
        );
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
            'prefixo' => [
                'required',
                'max:15',
                'min:3'
            ],
        ]);

        if ($validator->fails()) {
            return Parent::responseMsgsJSON($validator->errors(), 400);
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
                'regex:'.Util::REGEX_DATE,
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
                'regex:'.Util::REGEX_DATE,
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
                'regex:'.Util::REGEX_DATE,
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
                'regex:'.Util::REGEX_DATE,
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
                'boolean',
                'nullable'
            ],
            'inicio_atividades' => [
                'boolean',
                'nullable'
            ],
            'termino_atividades' => [
                'boolean',
                'nullable'
            ],
            'termino_atividades_motivo' => [
                'max:15',
                'nullable'
            ],
            'data_transferencia' => [
                'regex:'.Util::REGEX_DATE,
                'nullable'
            ],
        ]);

        if ($validator->fails()) {
            return Parent::responseMsgsJSON($validator->errors(), 400);
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
}
