<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CursoDoCondutor extends Model
{
    protected $fillable = [
        'condutor_id',
        'tipo_do_curso_id',
        'data_emissao',
        'data_validade',
        'nome',
        'descricao'
    ];

    protected $table = 'cursos_do_condutor';

    //////////////////////////////////////
    public function tipoDeCurso()
    {
        return $this->hasOne(TipoDeCurso::class, 'id', 'tipo_do_curso_id');
    }    
    public function condutor()
    {
        return $this->hasOne(Condutor::class, 'id', 'condutor_id');
    }
    public static function search($search)
    {
        return CursoDoCondutor::where("condutor_id", $search)
            ->with('tipoDeCurso')
            ->orderBy("created_at")
            ->simplePaginate(15);
    }
    public static function findCursosVencidos()
    {
        return CursoDoCondutor::where('data_validade', '<', date('Y-m-d'))
            ->with('tipoDeCurso')            
            ->with(['condutor' => function ($query) {
                $query->select('id', 'nome'); 
            }])
            ->orderBy("created_at")
            ->simplePaginate(15);
    }
}