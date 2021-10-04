<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnexoDoVeiculo extends Model
{
    protected $fillable = [
        'veiculo_id',
        'id_integracao',
        'file_name',
        'original_file_name',
        'descricao'
    ];

    protected $table = 'anexos_do_veiculo';

    //////////////////////////////////////
    public static function search($search)
    {
        return AnexoDoVeiculo::where("veiculo_id", $search)
            ->orderBy("created_at")
            ->simplePaginate(15);
    }
}
