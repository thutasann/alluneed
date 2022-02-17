<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Models\Products;
use App\Models\User;


class ActivityLog extends Model
{
    // use HasFactory;
    protected $table = 'activitylog';
    protected $fillable = [
        'user_id',
        'prod_id',
        'vendor_id',
        'description',
        'type',
        'status',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function products()
    {
        return $this->belongsTo(Products::class, 'prod_id', 'id');
    }
}
