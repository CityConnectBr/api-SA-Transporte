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
        'categoria_cnh',
        'vencimento_cnh',
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
