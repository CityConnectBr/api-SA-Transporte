<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AplicativoDoPermissionario extends Model
{
    protected $fillable = [
        'permissionario_id',
        'aplicativo_id'
    ];

    protected $table = 'aplicativos_do_permissionario';

    //////////////////////////////////////
    public static function search($search)
    {
        return AplicativoDoPermissionario::where("permissionario_id", $search)
            ->orderBy("created_at")
            ->simplePaginate(15);
    }
}
