<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'checking_date', 'amount_left', 'amount_sold', 'item_id'
    ];
}
