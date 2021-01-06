<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'content', 'remark_date', 'employee_id', 'customer_id'
    ];
}
