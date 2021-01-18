<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'entry', 
        'exit', 
        'person_id', 
        'logger_id'
    ];

    public function logs(){
        return $this->belongsTo('App\Models\Person');
    }
}
