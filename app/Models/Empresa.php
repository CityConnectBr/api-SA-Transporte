<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'id_integracao',
        'nome',
        'telefone',
        'fax',
        'home_page',
        'email',
        'cnpj',
        'inscricao_estadual',
        'inscricao_municipal',
        'nome_do_diretor',
        'nome_do_gerente',
        'nome_do_encarregado_vistoriador',
        'portaria_diretor',
        'data_nomeacao_diretor',
        'decreto_municipal_taxi',
        'decreto_municipal_escolar',
        'endereco_id',
    ];

    protected $table = 'empresas';

    //////////////////////////////////////
    public static function search($search)
    {
        return EntidadeAssociativa::where("nome", "like", "%" . $search . "%")
        ->orderBy("nome")
        ->paginate(15);
    }
}
