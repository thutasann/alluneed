<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Request_vendor extends Model
{
    // use HasFactory;
    protected $table = 'request_vendor';
    protected $fillable = [
        'user_id',
        'vendor_name',
        'description',
        'status',
        'confirm',
        'payment_mode',
        'payment_id',
        'payment_status',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
