<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ValoresDaInfracao extends Model
{
    protected $fillable = [
        'id_integracao',
        'modalidade_id',
        'descricao',
        'quantidade',
        'natureza_infracao_id',
        'moeda_id',
    ];

    protected $table = 'valores_da_infracao';

    public function modalidade()
    {
        return $this->hasOne(Modalidade::class, 'id', 'modalidade_id');
    }

    public static function search($search)
    {
        return ValoresDaInfracao::where("descricao", "like", "%" . $search . "%")
        ->orderBy("descricao")
        ->paginate(40);
    }

    public static function findByModalidadeAndNatureza($modalidade, $natureza)
    {
        return ValoresDaInfracao::where("modalidade_id", $modalidade)
        ->where("natureza_infracao_id", $natureza)
        ->orderBy("descricao")
        ->get();
    }
}
