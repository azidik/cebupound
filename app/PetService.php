<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetService extends Model
{
    public $table = 'pet_services';

     protected $fillable = [
        'pet_id', 'service_id', 'status', 'schedule',
    ];
}
