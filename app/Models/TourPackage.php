<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    protected $fillable = [
        'title', 'class', 'image', 'features', 'description', 'price',
    ];
}
