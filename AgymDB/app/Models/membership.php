<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'member_type_id', 'membership_history_id', 'order_id'
    ];
}
