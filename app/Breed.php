<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    public $tables = 'breeds';

    protected $fillable = [
        'pet_type_id',
    	'name'
    ];

    public function petType()
    {
        return $this->belongsTo('App\PetType');
    }
}
