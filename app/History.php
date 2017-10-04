<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    public $table = 'histories';
    
    protected $fillable = [
        'user_id', 'description'
    ];
}
