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
