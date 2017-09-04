<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Impound extends Model
{
    public $table = 'impoundings';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'pet_id', 'place_founded','surrendered_at','surrendered_by'
    ];

    public function type ()
    {
        return $this->belongsTo('App\PetType', 'pet_type_id');
    }
}
