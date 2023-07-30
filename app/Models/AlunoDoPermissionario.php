<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlunoDoPermissionario extends Model
{
    protected $fillable = [
        'nome',
        'data_nascimento',
        'telefone',
        'hora_entrada',
        'hora_saida',
        'email',
        'permissionario_id',
        'ponto_id',
    ];

    protected $table = 'alunos';

    ////////////////////////////////////////////////////////////////////////////////////
    public function permissionario()
    {
        return $this->belongsTo(Permissionario::class);
    }
    public function ponto()
    {
        return $this->belongsTo(Ponto::class);
    }

    //////////////////////////////////////
    public static function search($search)
    {
        return AlunoDoPermissionario::where("permissionario_id", $search)
            ->with("permissionario", "ponto")
            ->orderBy("created_at")
            ->simplePaginate(15);
    }
}
