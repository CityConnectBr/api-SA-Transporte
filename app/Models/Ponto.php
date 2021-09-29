<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ponto extends Model
{
    protected $fillable = [
        'descricao',
        'telefone',
        'data_criacao',
        'data_extincao',
        'ocupacao_atual',
        'observacao',
        'modalidade_transporte',
        'endereco_id',
    ];

    protected $table = 'pontos';

    //////////////////////////////////////
    public static function search($search)
    {
        return Ponto::where("descricao", "like", "%" . $search . "%")
            ->orderBy("descricao")
            ->simplePaginate(40);
    }
}
