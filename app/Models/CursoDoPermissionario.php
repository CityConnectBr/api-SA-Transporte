<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CursoDoPermissionario extends Model
{
    protected $fillable = [
        'permissionario_id',
        'tipo_do_curso_id'
    ];

    protected $table = 'cursos_de_permissionarios';

    //////////////////////////////////////
    public static function search($search)
    {
        return CursoDoPermissionario::where("permissionario_id", $search)
            ->orderBy("created_at")
            ->simplePaginate(15);
    }
}
