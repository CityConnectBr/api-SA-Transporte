<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CursoDoCondutor extends Model
{
    protected $fillable = [
        'condutor_id',
        'tipo_do_curso_id',
        'data_emissao'
    ];

    protected $table = 'cursos_de_condutores';

    //////////////////////////////////////
    public static function search($search)
    {
        return CursoDoCondutor::where("condutor_id", $search)
            ->orderBy("created_at")
            ->simplePaginate(15);
    }
}
