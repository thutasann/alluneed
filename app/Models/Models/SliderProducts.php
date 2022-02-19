<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Models\Products;

class SliderProducts extends Model
{
    // use HasFactory;
    protected $table = 'slider_products';
    protected $fillable = [
        'slider_id',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
}
