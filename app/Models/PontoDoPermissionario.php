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

    public function permissionario()
    {
        return $this->hasOne(Permissionario::class, 'id', 'permissionario_id');
    }

    //////////////////////////////////////
    public static function search($search)
    {
        return PontoDoPermissionario::where("permissionario_id", $search)
            ->with('ponto')
            ->orderBy("created_at")
            ->simplePaginate(15);
    }

    public static function searchEscolar($search)
    {
        return PontoDoPermissionario::where(function ($query) {
            $query->whereHas('permissionario', function ($subQuery) {
                $subQuery->where('modalidade_id', 1);
            })
                ->orWhereHas('permissionario', function ($subQuery) {
                    $subQuery->where('modalidade_id', 2);
                });
        })
            ->whereHas('ponto', function ($query) use ($search) {
                $query->whereRaw("LOWER(descricao) like ?", ["%" . strtolower($search) . "%"]);
            })
            ->with([
                'ponto',
                'permissionario' => function ($query) {
                    $query->select('id', 'nome_razao_social');
                }
            ])
            ->orderBy("created_at")
            ->simplePaginate(15);
    }

    public static function searchTaxi($search)
    {
        return PontoDoPermissionario::whereHas('permissionario', function ($query) {
            $query->where('modalidade_id', 3);
        })
            ->with([
                'ponto',
                'permissionario' => function ($query) {
                    $query->select('id', 'nome_razao_social');
                }
            ])
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
