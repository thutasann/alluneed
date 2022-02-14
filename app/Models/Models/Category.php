<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'group_id',
        'name',
        'url',
        'description',
        'image',
        'icon',
        'status',
    ];

    // BelongsTo Relation in laravel
    public function group()
    {
        return $this->belongsTo(Groups::class, 'group_id', 'id');
    }
}
