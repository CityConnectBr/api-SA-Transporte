<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoordenadorDoPonto extends Model
{
    protected $fillable = [
        'id_integracao',
        'data_inicial',
        'data_termino',
        'observacoes',
        'permissionario_id',
        'ponto_id'
    ];

    protected $table = 'coordenador_de_ponto';

    //////////////////////////////////////
    public static function search($search)
    {
        return CoordenadorDoPonto::where("ponto_id", $search)
            ->orderBy("created_at")
            ->simplePaginate(15);
    }
}
