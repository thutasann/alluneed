<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Slider extends Model
{
    // use HasFactory;
    protected $table = 'sliders';
    protected $fillable = [
        'heading',
        'vendor_id',
        'description',
        'link',
        'link_name',
        'image',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }
}
