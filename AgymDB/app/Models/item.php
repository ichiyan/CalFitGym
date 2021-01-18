<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'item_name', 
        'is_customizable',
        'has_variations',
        'has_different_prices',
        'price', 
        'description', 
        'item_pic'
    ];

}