<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Permissionario extends Model
{

    protected $fillable = [
        'nome',
        'id_integracao',
        'modalidade_id',
        'situacao',
        'tipo',
        'cpf_cnpj',
        'rg',
        'inscricao_municipal',
        'ddd',
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
        'versao',
        'status_foto',
        'foto_url'
    ];

    protected $attributes = [
        'versao' => 0
    ];

    protected $temporaly = [
        'modalidade_transporte'
    ];

    protected static function booted()
    {
        static::addGlobalScope('situacao', function (Builder $builder) {
            $builder->where('situacao', "A");
        });
    }

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'id', 'endereco_id');
    }

    public function modalidade()
    {
        return $this->hasOne(Modalidade::class, 'id', 'modalidade_id');
    }

    public function setStatus($foto, $fotoUrl)
    {
        //0=sem foto, 1=com foto, 2=com foto url
        if(isset($fotoUrl)){
            $this->status_foto = 2;
        }else{
            if(isset($foto)){
                $this->status_foto = 1;
            }else{
                $this->status_foto = 0;
            }
        }
    }

    // /////////////////
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
