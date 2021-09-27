<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnexoDoMonitor extends Model
{
    protected $fillable = [
        'monitor_id',
        'id_integracao',
        'file_name',
        'original_file_name',
        'descricao'
    ];

    protected $table = 'anexos_do_monitor';

    //////////////////////////////////////
    public static function search($search)
    {
        return AnexoDoMonitor::where("monitor_id", $search)
            ->orderBy("created_at")
            ->simplePaginate(15);
    }
}
