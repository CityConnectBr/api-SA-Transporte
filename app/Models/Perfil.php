<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $fillable = [
        'nome',
        'cadastro_usuario',
        'cadastro_perfil',
        'cadastro_principais',
        'cadastro_tabelas_base',
        'lancamentos',
        'impressos',
        'relatorios',
        'mensagens'
    ];

    protected $table = 'perfis';

    // /////////////////
    public static function search($search)
    {
        return Perfil::where("nome", "like", "%" . $search . "%")
            ->orderBy("nome")
            ->simplePaginate(15);
    }
}