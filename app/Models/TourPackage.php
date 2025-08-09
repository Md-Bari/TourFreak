<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'class',
        'image',
        'features',
        'description',
        'price',
        'duration_day',
        'duration_night',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'package_id');
    }
}
