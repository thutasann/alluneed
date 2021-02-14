<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orderitem extends Model
{
    protected $table = 'order_items';
    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'tax_amt',
        'quantity',
        
    ];

    // BelongsTo Relation in laravel
    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

}
