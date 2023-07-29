<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CursoDoPermissionario extends Model
{
    protected $fillable = [
        'permissionario_id',
        'tipo_do_curso_id',
        'data_emissao',
        'data_validade',
        'nome',
        'descricao'
    ];

    protected $table = 'cursos_de_permissionarios';

    //////////////////////////////////////
    public function tipoDeCurso()
    {
        return $this->hasOne(TipoDeCurso::class, 'id', 'tipo_do_curso_id');
    }
    public function permissionario()
    {
        return $this->hasOne(Permissionario::class, 'id', 'permissionario_id');
    }
    public static function search($search)
    {
        return CursoDoPermissionario::where("permissionario_id", $search)
            ->with('tipoDeCurso')
            ->orderBy("created_at")
            ->simplePaginate(15);
    }
    public static function findCursosVencidos()
    {
        return CursoDoPermissionario::where('data_validade', '<', date('Y-m-d'))
            ->with('tipoDeCurso')
            ->with(['permissionario' => function ($query) {
                $query->select('id', 'nome_razao_social'); 
            }])
            ->orderBy("created_at")
            ->simplePaginate(15);
    }
}
