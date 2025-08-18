<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ad_id',
    ];

    /**
     * Get the ad that the wishlist item belongs to.
     */
    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}
