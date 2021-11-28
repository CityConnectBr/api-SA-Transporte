<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VistoriaPonto extends Model
{
    protected $fillable = [
        'id_integracao',
        'data_vistoria',
        'condicoes_de_pintura',
        'condicoes_de_cobertura',
        'condicoes_de_emplacamento',
        'condicoes_de_sanitario',
        'observacoes',
        'vistoriador_id',
        'ponto_id',
    ];

    protected $table = 'vistoria_ponto';

    public static function search($search)
    {
        return VistoriaPonto::where("ponto_id", "like", "%" . $search . "%")
        ->orderBy("data_vistoria")
        ->paginate(15);
    }
}
