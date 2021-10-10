<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntidadeCurso extends Model
{
    protected $fillable = [
        'id_integracao',
        'descricao',
        'base_legal'
    ];

    protected $table = 'entidades_curso';

    ///////////////////

    public static function search($search)
    {
        return EntidadeCurso::where("descricao", "like", "%" . $search . "%")
        ->orderBy("descricao")
        ->paginate(15);
    }

}
