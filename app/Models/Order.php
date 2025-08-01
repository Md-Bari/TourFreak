<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'title',
        'price',
        'person_count',
        'extra_package',
        'total_price',
        'user_name',
        'user_phone',
        'user_id',
    ];
}
