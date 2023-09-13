<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionarioHistorico extends Model
{
    protected $table = 'permissionario_historicos';

    protected $fillable = [
        'permissionario_id',
        'campo',
        'valor_antigo',
        'valor_novo',
    ];

    protected $hidden = [
        'permissionario_id',
    ];

    public function permissionario()
    {
        return $this->belongsTo(Permissionario::class);
    }

    public static function search($permissionario_id = null)
    {
        $query = PermissionarioHistorico::with("permissionario:id,nome_razao_social")
            ->orderBy("created_at", "desc");


        if ($permissionario_id) {
            $query->where("permissionario_id", "=", $permissionario_id);
        }

        return $query->simplePaginate(15);

    }
}
