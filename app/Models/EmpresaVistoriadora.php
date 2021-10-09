<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpresaVistoriadora extends Model
{
    protected $fillable = [
        'id_integracao',
        'nome',
        'tipo',
        'telefone',
        'email',
        'cnpj',
        'inscricao_estadual',
        'inscricao_municipal',
        'nome_diretor',
        'nome_delegado',
        'total_vistorias_dia',
        'endereco_id',
    ];

    protected $table = 'empresas_vistoriadoras';

    //////////////////////////////////////
    public static function search($search)
    {
        return EmpresaVistoriadora::where("nome", "like", "%" . $search . "%")
        ->orderBy("nome")
        ->paginate(15);
    }
}
