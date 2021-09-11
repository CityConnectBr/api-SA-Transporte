<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alvara extends Model
{
    protected $fillable = [
        'data_emissao',
        'data_vencimento',
        'data_retorno',
        'observacao_retorno',
    ];

    protected $table = 'alvara_do_permissionario';
}
