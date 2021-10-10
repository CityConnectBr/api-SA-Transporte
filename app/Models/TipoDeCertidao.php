<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDeCertidao extends Model
{

    protected $fillable = [
        'descricao',
    ];

    protected $table = 'tipos_de_certidao';

    ///////////////////

    public static function search($search)
    {
        return TipoDeCertidao::where("descricao", "like", "%" . $search . "%")
        ->orderBy("descricao")
        ->paginate(40);
    }
}
