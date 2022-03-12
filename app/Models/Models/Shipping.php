<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Shipping extends Model
{
    // use HasFactory;
    protected $table = 'shipping';
    protected $fillable = [
        'shipping_tracking_no',
        'shipping_date',
        'vendor_id',
        'team_id',
        'order_id',
        'received_date',
        'receiver_id',
        'status',
    ];

    // BelongsTo Relation in laravel
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
