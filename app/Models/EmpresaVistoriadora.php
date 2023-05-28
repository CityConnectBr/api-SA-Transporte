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

    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'endereco_id');
    }

    //////////////////////////////////////
    public static function search($search)
    {
        return EmpresaVistoriadora::where("nome", "like", "%" . $search . "%")
        ->orderBy("nome")
        ->paginate(15);
    }

    public static function findComplete($id)
    {
        return EmpresaVistoriadora::where("id", $id)
        ->with("endereco")
        ->first();
    }
}
