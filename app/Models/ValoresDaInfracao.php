<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ValoresDaInfracao extends Model
{
    protected $fillable = [
        'id_integracao',
        'modalidade_transporte',
        'quantidade',
        'natureza_infracao_id',
        'moeda_id',
    ];

    protected $table = 'valores_da_infracao';

    public static function search($search)
    {
        return ValoresDaInfracao::where("moeda_id", "like", "%" . $search . "%")
        ->orderBy("moeda_id")
        ->paginate(40);
    }
}
