<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    // use HasFactory;
    protected $table = 'subcategorys';
    protected $fillable = [
        'category_id',
        'name',
        'url',
        'description',
        'image',
    ];

    // BelongsTo Relation in laravel
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(Groups::class, 'group_id', 'id');
    }

}
