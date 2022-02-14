<?php

namespace App\Models\Models;

use App\Models\User;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // use HasFactory;
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
