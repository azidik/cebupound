<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    public $table = 'donors';
    
    protected $fillable = [
        'firstname',
        'lastname',
        'contact_no'
    ];
}
