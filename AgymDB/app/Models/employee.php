<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'date_hired', 
        'date_separated', 
        'monthly_salary', 
        'no_of_trainees', 
        'person_id'
    ];

    public function work_attendance(){
        return $this->hasMany('App\Models\EntryLog');
    }
}
