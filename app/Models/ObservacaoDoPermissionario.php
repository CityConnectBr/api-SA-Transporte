<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObservacaoDoPermissionario extends Model
{
    protected $fillable = [
        'permissionario_id',
        'titulo',
        'observacao',
        'data'
    ];

    protected $table = 'observacoes_permissionarios';

    //////////////////////////////////////
    public static function search($search)
    {
        return ObservacaoDoPermissionario::where("permissionario_id", $search)
            ->orderBy("created_at")
            ->simplePaginate(15);
    }
}
