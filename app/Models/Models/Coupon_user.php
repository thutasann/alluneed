<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Models\Coupon;

class Coupon_user extends Model
{
    // use HasFactory;
    protected $table = 'coupon_user';
    protected $fillable = [
        'coupon_id',
        'coupon_id',
    ];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id', 'id');
    }
}
