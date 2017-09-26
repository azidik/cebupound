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
        'name', 'age', 'gender', 'image', 'pet_type_id', 'breed', 'pet_category_id', 'color', 'user_id', 'is_accepted', 'birth_date'
    ];

    public function type ()
    {
        return $this->belongsTo('App\PetType', 'pet_type_id');
    }

    public function impound ()
    {
        return $this->hasOne('App\Impound', 'pet_id');
    }

    public function adopt ()
    {
        return $this->belongsTo('App\Adopt', 'impound_id');
    }

    public function category ()
    {
        return $this->belongsTo('App\PetCategory', 'pet_category_id');
    }

    public function user ()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function service()
    {
        return $this->belongsToMany('App\Service', 'pet_services', 'pet_id', 'service_id')->withPivot('schedule', 'status');
    }
}
