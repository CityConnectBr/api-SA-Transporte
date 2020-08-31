<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Permissionario extends Model
{

    protected $fillable = [
        'nome',
        'id_permissionario_integracao',
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
        'celular',
        'email',
        'data_nascimento',
        'naturalidade',
        'nacionalidade',
        'cnh',
        'categoria_cnh',
        'vencimento_cnh',
        'versao'
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
        return $this->hasOne('App\Models\Endereco');
    }

    public function modalidade()
    {
        return $this->hasOne(Modalidade::class, 'id', 'modalidade_id');
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
}
