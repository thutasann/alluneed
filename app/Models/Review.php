<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
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
