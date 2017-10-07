<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $table = 'barangays';
    
    protected $fillable = [
        'id', 'psgc_code', 'description',  'city_id'
    ];

    public function city()
    {
        return $this->belongsTo('App\City');
    }
}
