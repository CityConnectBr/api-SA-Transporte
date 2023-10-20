<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    protected $fillable = [
        'assunto',
        'conteudo',
        'email',
        'push'
    ];

    protected $table = 'mensagens';

    ///////////////////

    public static function search($search, $orderDescAsc)
    {
        return Mensagem::where("assunto", "like", "%" . $search . "%")
            ->orderBy('created_at', 'desc')
            ->simplePaginate(15);
    }


}