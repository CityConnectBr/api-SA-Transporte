<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Permissionario extends Model
{

    protected $fillable = [
        'id_integracao',
        'numero_de_cadastro_antigo',
        'nome_razao_social',
        'tipo',
        'cpf_cnpj',
        'rg',
        'estado_civil',
        'inscricao_municipal',
        'alvara_de_funcionamento',
        'responsavel',
        'procurador_responsavel',
        'telefone',
        'telefone2',
        'celular',
        'email',
        'data_nascimento',
        'naturalidade',
        'nacionalidade',
        'cnh',
        'prefixo',
        'inss',
        'categoria_cnh',
        'vencimento_cnh',
        'endereco_id',
        'atestado_de_saude',
        'certidao_negativa',
        'validade_certidao_negativa',
        'comprovante_de_endereco',
        'inscricao_do_cadastro_mobiliario',
        'numero_do_cadastro_mobiliario',
        'numero_do_cadastro_mobiliario',
        'curso_primeiro_socorros',
        'curso_primeiro_socorros_emissao',
        'crlv',
        'dpvat',
        'certificado_pontuacao_cnh',
        'contrato_comodato',
        'contrato_comodato_validade',
        'ipva',
        'relacao_dos_alunos_transportados',
        'laudo_vistoria_com_aprovacao_da_sa_trans',
        'ciretran_vistoria',
        'ciretran_autorizacao',
        'selo_gnv',
        'selo_gnv_validade',
        'taximetro_tacografo',
        'taximetro_tacografo_numero',
        'taximetro_tacografo_afericao',
        'inicio_atividades',
        'termino_atividades',
        'termino_atividades_motivo',
        'data_transferencia',
    ];

    protected $temporaly = [
        'modalidade_transporte'
    ];

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'id', 'endereco_id');
    }

    public function modalidade()
    {
        return $this->hasOne(Modalidade::class, 'id', 'modalidade_id');
    }


    //////////////////////////////////////
    public static function search($search)
    {
        return Permissionario::where("nome_razao_social", "like", "%" . $search . "%")
            ->orderBy("nome_razao_social")
            ->simplePaginate(15);
    }

    public static function findComplete($id, $withoutGlobalScope = false)
    {
        if ($withoutGlobalScope) {
            return Permissionario::withoutGlobalScope('situacao')->with('modalidade')
                ->with('endereco')
                ->find($id);
        } else {
            return Permissionario::with('modalidade')->with('endereco')->find($id);
        }
    }

    public static function findByIntegracaoComplete($id, $withoutGlobalScope = false)
    {
        if ($withoutGlobalScope) {
            return Permissionario::withoutGlobalScope('situacao')->with('modalidade')
                ->with('endereco')
                ->firstWhere("id_integracao", $id);
        } else {
            return Permissionario::with('modalidade')->with('endereco')->firstWhere("id_integracao", $id);
        }
    }

    public static function firstWhereByIntegracao($id, $withoutGlobalScope = false)
    {
        if ($withoutGlobalScope) {
            return Permissionario::withoutGlobalScope('situacao')->firstWhere("id_integracao", $id);
        } else {
            return Permissionario::firstWhere("id_integracao", $id);
        }
    }

    public static function firstByCpfCnpj($cpfCnj)
    {
        return Permissionario::where("cpf_cnpj", $cpfCnj)->first();
    }

    public static function firstByCnh($cpfCnj)
    {
        return Permissionario::where("cnh", $cpfCnj)->first();
    }
}
