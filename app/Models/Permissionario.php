<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permissionario extends Model
{
    protected $fillable = [
        'nome',
        'id_permissionario_integracao',
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
        'modalidade_transporte',
        'data_nascimento',
        'naturalidade',
        'nacionalidade',
        'CNH',
        'categoria_CNH',
        'vencimento_CNH',
    ];
}
