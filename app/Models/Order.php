<?php

namespace App\Models;
use App\User;
use App\Models\Orderitem;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'tracking_no',
        'tracking_msg',
        'payment_mode',
        'payment_id',
        'payment_status',
        'cancel_reason',
        'notify',
    ];

    // BelongsTo Relation in laravel
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orderitems()
    {
        return $this->hasMany(Orderitem::class, 'order_id', 'id');
    }

}
