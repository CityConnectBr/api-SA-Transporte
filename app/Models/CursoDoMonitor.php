<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CursoDoMonitor extends Model
{
    protected $fillable = [
        'monitor_id',
        'tipo_do_curso_id',
        'data_emissao'
    ];

    protected $table = 'cursos_do_monitor';

    //////////////////////////////////////
    public static function search($search)
    {
        return CursoDoMonitor::where("monitor_id", $search)
            ->orderBy("created_at")
            ->simplePaginate(15);
    }
}
