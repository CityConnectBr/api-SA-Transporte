<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'id',
        'cep',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'municipio_id',
        'uf',
    ];

    public function municipio()
    {
        return $this->hasOne(Municipio::class, 'id', 'municipio_id');
    }

    //////////////////////////////////////
    public static function search($search)
    {
        return Endereco::where("endereco", "like", "%" . $search . "%")
            ->with("municipio")
            ->orderBy("endereco")
            ->simplePaginate(15);
    }

    public static function findComplete($id)
    {
        return Endereco::with("municipio")->find($id);
    }
}
