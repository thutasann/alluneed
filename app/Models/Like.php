<?php

namespace App\Models;
use App\User;


use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'like';
    protected $fillable = [
        'user_id',
        'prod_id',
    ];

    // BelongsTo Relation in laravel
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
