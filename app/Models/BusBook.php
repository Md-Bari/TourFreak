<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusBook extends Model
{
    protected $table = 'busbook';

    protected $fillable = [
        'start_location',
        'end_location',
        'journey_date',
        'journey_time',
        'user_id',
        'seat_number',
        'status',
    ];
}
