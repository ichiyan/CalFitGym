<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_amount', 
        'amt_left_batch', 
        'expiry_date', 
        'date_received', 
        'item_id', 
        'employee_id'
    ];
    
}
