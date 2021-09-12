<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnexoDoPermissionario extends Model
{
    protected $fillable = [
        'permissionario_id',
        'id_integracao',
        'descricao'
    ];

    protected $table = 'anexos_do_permissionario';

    //////////////////////////////////////
    public static function search($search)
    {
        return AnexoDoPermissionario::where("permissionario_id", $search)
            ->orderBy("created_at")
            ->simplePaginate(15);
    }
}
