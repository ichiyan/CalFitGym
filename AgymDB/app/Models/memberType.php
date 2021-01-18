<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'member_type_name', 
        'member_type_price',
        'length'
    ];

    public function advantages(){
        return $this->hasMany('App\Models\Description');
    }
}
