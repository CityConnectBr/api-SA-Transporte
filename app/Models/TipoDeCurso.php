<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDeCurso extends Model
{
    protected $fillable = [
        'id_integracao',
        'descricao',
        'modalidade',
    ];

    protected $table = 'tipos_de_curso';

    //////////////////////////////////////
    public static function search($search)
    {
        return TipoDeCurso::where("descricao", "like", "%" . $search . "%")
            ->orderBy("descricao")
            ->simplePaginate(40);
    }
}
