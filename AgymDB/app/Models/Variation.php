<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name', 'price', 'description', 'item_id'
    ];
    
    public function chosenProduct(){
        return $this->belongsToMany('App\Models\Basket');
    }

}
