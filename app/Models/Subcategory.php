<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
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
