<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

use App\Models\Groups;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Products;


class ActivityLog extends Model
{
    protected $table = 'activitylog';
    protected $fillable = [
        'user_id',
        'prod_id',
        'description',
        'type',
        'status',
    ];

    // BelongsTo Relation in laravel
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function products()
    {
        return $this->belongsTo(Products::class, 'prod_id', 'id');
    }
    
}
