<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ponto extends Model
{
    protected $fillable = [
        'id_integracao',
        'descricao',
        'telefone',
        'data_criacao',
        'data_extincao',
        'ocupacao_atual',
        'observacao',
        'modalidade_id',
        'endereco_id',
    ];

    protected $table = 'pontos';

    public function modalidade()
    {
        return $this->hasOne(Modalidade::class, 'id', 'modalidade_id');
    }

    //////////////////////////////////////
    public static function search($search)
    {
        return Ponto::where("descricao", "like", "%" . $search . "%")
            ->orderBy("descricao")
            ->simplePaginate(15);
    }

    public static function getByDescricao($search)
    {
        return Ponto::where("descricao", "like", $search)
            ->orderBy("descricao")
            ->get();
    }
}
