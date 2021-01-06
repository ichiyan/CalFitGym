<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'quantity', 'order_id', 'item_id', 'batch_id', 'customize_id', 'membership_id'
    ];
}
 