<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Models\Products;
use App\Models\Models\Order;

class Orderitem extends Model
{
    // use HasFactory;
    protected $table = 'order_items';
    protected $fillable = [
        'order_id',
        'product_id',
        'vendor_id',
        'price',
        'tax_amt',
        'quantity',

    ];

    // BelongsTo Relation in laravel
    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
