<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    public $table = 'pets';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'name', 'age', 'gender', 'image', 'pet_type_id', 'breed', 'pet_category_id', 'color', 'user_id'
    ];

    public function type ()
    {
        return $this->belongsTo('App\PetType', 'pet_type_id');
    }
}
