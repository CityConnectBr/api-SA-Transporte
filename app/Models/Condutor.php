<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Condutor extends Model
{

    protected $fillable = [
        'nome',
        'id_integracao',
        'modalidade_id',
        'situacao',
        'cpf',
        'rg',
        'ddd',
        'telefone',
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
    
    protected $table = 'condutores';
    
    protected $attributes = [
        'versao' => 0
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

    // /////////////////
    public static function findComplete($id, $withoutGlobalScope = false)
    {
        if ($withoutGlobalScope) {
            return Condutor::withoutGlobalScope('situacao')->with('endereco')->find($id);
        } else {
            return Condutor::with('endereco')->find($id);
        }
    }

    public static function findByIntegracaoComplete($id, $withoutGlobalScope = false)
    {
        if ($withoutGlobalScope) {
            return Condutor::withoutGlobalScope('situacao')->with('endereco')->firstWhere("id_integracao", $id);
        } else {
            return Condutor::with('endereco')->firstWhere("id_integracao", $id);
        }
    }
}
