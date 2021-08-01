<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{

    protected $fillable = [
        'nome',
        'incluir',
        'alterar',
        'excluir',
        'consultar',
        'imprimir',
    ];

    protected $table = 'perfis';

    // /////////////////
    public static function search($search)
    {
        return Perfil::where("nome", "like", "%" . $search . "%")
            ->orderBy("nome")
            ->paginate(20);
    }
}
