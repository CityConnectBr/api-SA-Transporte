<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alvara extends Model
{
    use SoftDeletes;

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

    public static function findByPermissionario($permissionario_id)
    {
        return Alvara::where("permissionario_id", $permissionario_id)
            ->orderBy("created_at", "desc")
            ->get();
    }
}
