<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'height', 'weight', 'pre_existing_conditions', 'member_type_id', 'assigned_employee_id', 'person_id'
    ];
}
