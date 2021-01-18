<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'fname',
        'lname', 
        'birthday', 
        'street_address',
        'barangay',
        'city', 
        'email_address', 
        'phone_number', 
        'emergency_contact_name', 
        'emergency_contact_number', 
        'emergency_contact_relationship', 
        'photo', 
        'user_id'
    ];
}
