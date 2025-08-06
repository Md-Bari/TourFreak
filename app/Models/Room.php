<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'title',
        'image',
        'price',
        'description',
    ];
}
