<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    use Uuids;

    protected $fillable = [
        'origem'
    ];
}
