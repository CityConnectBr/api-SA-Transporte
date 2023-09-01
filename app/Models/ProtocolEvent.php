<?php

namespace App\Models;

use Carbon\Carbon;

trait ProtocolEvent {
    protected static function booted()
    {
        static::creating(function ($model) {
            self::generateProtocol($model);
        });
    }

    private static function generateProtocol($model)
    {
        $counter = CounterProtocol::firstOrCreate(
            ['year' => Carbon::now()->year],
            ['number' => 1]
        );
        (new CounterProtocol)->where('year', Carbon::now()->year)->increment('number');

        $model->protocol = $counter->year . '-' . $counter->number;
        $model->update();
    }
}
