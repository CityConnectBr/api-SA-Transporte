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

    public function ponto()
    {
        return $this->hasOne(Ponto::class, 'id', 'ponto_id');
    }

    //////////////////////////////////////
    public static function search($search)
    {
        return PontoDoPermissionario::where("permissionario_id", $search)
            ->with('ponto')
            ->orderBy("created_at")
            ->simplePaginate(15);
    }

    public static function getAllByPermissionario($permissionarioId)
    {
        return PontoDoPermissionario::where("permissionario_id", $permissionarioId)
            ->with('ponto')
            ->orderBy("created_at")
            ->get();
    }

    public static function findPontoByPermissionario($permissionarioId)
    {
        return PontoDoPermissionario::where("permissionario_id", $permissionarioId)
            ->with('ponto')
            ->first();
    } 
    public static function findPontosByPermissionario($permissionarioId)
    {
        return PontoDoPermissionario::where("permissionario_id", $permissionarioId)
            ->with('ponto')
            ->get();
    }
}