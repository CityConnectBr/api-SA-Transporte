<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiposDeUsuarios extends Model
{
    protected $fillable = [
        'id',
        'nome'
    ];
    
    //
    
    public static function findByName($name)
    {
        return TiposDeUsuarios::where("nome", $name)->first();
    }
}
