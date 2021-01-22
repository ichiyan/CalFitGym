<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'category_name', 'price_priority'
    ];
}
