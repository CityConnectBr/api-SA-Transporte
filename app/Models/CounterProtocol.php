<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CounterProtocol extends Model
{
    protected $table = 'counter_protocol';
    public $timestamps = false;

    protected $fillable = [ 'year', 'number' ];
}
