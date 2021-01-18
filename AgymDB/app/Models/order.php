<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'amount_received', 
        'total_price', 
        'change', 
        'order_date', 
        'customer_id', 
        'employee_id'
    ];
}
