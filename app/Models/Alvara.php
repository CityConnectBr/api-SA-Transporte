<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alvara extends Model
{
    protected $fillable = [
        'data_emissao',
        'data_vencimento',
        'data_retorno',
        'observacao_retorno',
        'permissionario_id',
    ];

    protected $table = 'alvara_do_permissionario';

    //////////////////////////////////////
    public static function search($search)
    {
        return Alvara::where("permissionario_id", $search)
            ->orderBy("created_at", "desc")
            ->simplePaginate(20);
    }
}
