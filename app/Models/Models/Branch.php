<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Branch extends Model
{
    // use HasFactory;
    protected $table = 'branch';
    protected $fillable = ['vendor_id', 'name', 'country', 'city', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }
}
