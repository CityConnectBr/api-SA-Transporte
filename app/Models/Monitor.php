<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Permissionario extends Model
{

    protected $fillable = [
        'nome',
        'id_integracao',
        'situacao',
        'cpf',
        'rg',
        'telefone',
        'email',
        'data_nascimento',
        'versao'
    ];

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

    public function permissionario()
    {
        return $this->hasOne(Permissionario::class, 'id', 'permissionario_id')->withoutGlobalScopes();
    }

    // /////////////////

}
