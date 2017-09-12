<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetService extends Model
{
    public $table = 'pet_services';

     protected $fillable = [
        'pet_id', 'service_id', 'status', 'schedule',
    ];

    public function pet ()
    {
        return $this->belongsTo('App\Pet', 'pet_id');
    }
    public function service ()
    {
        return $this->belongsTo('App\Service', 'service_id');
    }
}
