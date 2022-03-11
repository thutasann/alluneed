<?php

namespace App\Models\Models;

use App\Models\User;
use App\Models\Models\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliTeam extends Model
{
    // use HasFactory;
    protected $table = 'deli_team';
    protected $fillable = ['vendor_id', 'branch_id', 'name', 'email', 'phone', 'schedule', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
}
