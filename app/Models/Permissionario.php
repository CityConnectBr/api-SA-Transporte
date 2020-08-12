<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permissionario extends Model
{
    protected $fillable = [
        'nome',
        'id_permissionario_integracao',
        'modalidade_id',
        'tipo',
        'CNPJ',
        'RG',
        'inscricao_municipal',
        'DDD',
        'telefone',
        'telefone2',
        'celular',
        'celular',
        'email',
        'data_nascimento',
        'naturalidade',
        'nacionalidade',
        'CNH',
        'categoria_CNH',
        'vencimento_CNH',
        'versao',
    ];

    protected $attributes = [
        'versao' => 0,
    ];

    protected $temporaly = ['modalidade_transporte'];

    public function endereco()
    {
        return $this->hasOne('App\Models\Endereco');
    }

    public function modalidade()
    {
        return $this->hasOne(Modalidade::class, 'id', 'modalidade_id');
    }

    public static function findComplete($id){
        return Permissionario::with('modalidade')->with('endereco')->find($id);
    }

}
