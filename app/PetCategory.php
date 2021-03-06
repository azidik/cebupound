<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetCategory extends Model
{
    public $table = 'pet_categories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'name'
    ];
}
