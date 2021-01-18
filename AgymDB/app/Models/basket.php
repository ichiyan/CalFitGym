<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'quantity', 
        'order_id', 
        'item_id', 
        'batch_id', 
        'customize_id', 
        'membership_id'
    ];

    public function transactionDetails(){
        return $this->belongsTo('App\Models\Order');
    }

    public function boughtItems(){
        return $this->hasOne('App\Models\Item');
    }

    public function boughtMembership(){
        return $this->hasOne('App\Models\Membership');
    }
}
 