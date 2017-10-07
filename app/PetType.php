<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetType extends Model
{
    public $table = 'pet_types';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function breed()
    {
        return $this->hasOne('App\Breed');
    }
    
}
