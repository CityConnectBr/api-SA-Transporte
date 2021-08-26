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

    public static function search($uf, $search)
    {
        return Municipio::where("uf", "=", $uf)
            ->where("nome", "like", "%" . $search . "%")
            ->orderBy("nome")
            ->paginate(40);
    }

}
