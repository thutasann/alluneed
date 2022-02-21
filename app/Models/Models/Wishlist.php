<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    // use HasFactory;
    protected $table = 'whishlists';
    protected $fillables = [
        'user_id',
        'product_id',
        'status'
    ];

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id')->where('status', '0');
    }
}
