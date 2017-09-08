<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adopt extends Model
{
    public $table = 'adoptions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'impound_id', 'adopted_at','adopted_by','is_accepted'
    ];

    public function impound ()
    {
        return $this->belongsTo('App\Impound', 'impound_id');
    }

    public function user() 
    {
        return $this->belongsTo('App\User', 'adopted_by');
    }
}
