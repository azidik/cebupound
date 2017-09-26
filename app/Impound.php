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
        'pet_id', 'place_founded','surrendered_at','surrendered_by', 'is_accepted', 'reason'
    ];

    public function type ()
    {
        return $this->belongsTo('App\PetType', 'pet_type_id');
    }

    public function pet ()
    {
        return $this->belongsTo('App\Pet', 'pet_id');
    }
    public function adopt()
    {
        return $this->HasOne('App\Adopt', 'impound_id');
    }
    
}
