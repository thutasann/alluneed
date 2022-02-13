<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    // use HasFactory;
    protected $table = 'groups';
    protected $fillable = ['name', 'url', 'descrip', 'status'];
}
