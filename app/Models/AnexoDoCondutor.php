<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnexoDoCondutor extends Model
{
    protected $fillable = [
        'condutor_id',
        'id_integracao',
        'file_name',
        'original_file_name',
        'descricao'
    ];

    protected $table = 'anexos_do_condutor';

    //////////////////////////////////////
    public static function search($search)
    {
        return AnexoDoCondutor::where("condutor_id", $search)
            ->orderBy("created_at")
            ->simplePaginate(15);
    }
}
