<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ativo',
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
        'chave_pix',
        'tipo_chave_pix'
    ];

    protected $table = 'empresas';

    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'endereco_id');
    }

    //////////////////////////////////////
    public static function search($search)
    {
        return Empresa::where("nome", "like", "%" . $search . "%")
        ->orderBy("nome")
        ->paginate(15);
    }

    public static function findComplete($id)
    {
        return Empresa::where("id", $id)->with('endereco')->first();    }
}
