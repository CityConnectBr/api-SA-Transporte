<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CursoDoMonitor extends Model
{
    protected $fillable = [
        'monitor_id',
        'tipo_do_curso_id',
        'data_emissao',
        'data_validade',
        'nome',
        'descricao'
    ];

    protected $table = 'cursos_do_monitor';

    //////////////////////////////////////
    public function tipoDeCurso()
    {
        return $this->hasOne(TipoDeCurso::class, 'id', 'tipo_do_curso_id');
    }
    public function monitor()
    {
        return $this->hasOne(Monitor::class, 'id', 'monitor_id');
    }
    public static function search($search)
    {
        return CursoDoMonitor::where("monitor_id", $search)
            ->with('tipoDeCurso')
            ->orderBy("created_at")
            ->simplePaginate(15);
    }
    public static function findCursosVencidos()
    {
        return CursoDoMonitor::where('data_validade', '<', date('Y-m-d'))
            ->with('tipoDeCurso')
            ->with(['monitor' => function ($query) {
                $query->select('id', 'nome'); 
            }])
            ->orderBy("created_at")
            ->simplePaginate(15);
    }
}