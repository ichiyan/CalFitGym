<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'height',
        'weight',
        'pre_existing_conditions',
        'start_date',
        'end_date',
        'member_type_id',
        'assigned_employee_id',
        'person_id'
    ];

    public function subscribes(){
        return $this->hasMany('App\Models\Membership');
    }

    public function ordered(){
        return $this->hasMany('App\Models\Order');
    }

    public function attendance(){
        return $this->hasMany('App\Models\EntryLog');
    }
}
