<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{

    protected $fillable = [
        'id_integracao',
        'nome',
        'uf',
    ];

    protected $table = 'municipios';

    public static function search($search)
    {
        return Municipio::where("nome", "like", "%" . $search . "%")
            ->orderBy("nome")
            ->paginate(40);
    }

    public static function searchByUf($uf, $search)
    {
        return Municipio::where("uf", "=", $uf)
            ->where("nome", "like", "%" . $search . "%")
            ->orderBy("nome")
            ->paginate(5);
    }

}
