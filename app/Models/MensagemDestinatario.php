<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MensagemDestinatario extends Model
{
    protected $fillable = [
        'mensagem_id',
        'permissionario_id',
        'condutor_id',
        'monitor_id',
        'fiscal_id',
        'enviado_email',
        'enviado_push'
    ];

    protected $table = 'mensagem_destinatario';

    //////////////////////////////////////

    

}
