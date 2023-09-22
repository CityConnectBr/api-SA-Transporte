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

}
