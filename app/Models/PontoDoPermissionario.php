<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PontoDoPermissionario extends Model
{
    protected $fillable = [
        'permissionario_id',
        'ponto_id'
    ];

    protected $table = 'pontos_do_permissionario';

    //////////////////////////////////////
    public static function search($search)
    {
        return PontoDoPermissionario::where("permissionario_id", $search)
            ->orderBy("created_at")
            ->simplePaginate(15);
    }
}
