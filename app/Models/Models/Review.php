<?php

namespace App\Models\Models;

use App\Models\User;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // use HasFactory;
    protected $table = 'reviews';
    protected $fillable = [
        'user_id',
        'prod_id',
        'review',
    ];

    // BelongsTo Relation in laravel
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
