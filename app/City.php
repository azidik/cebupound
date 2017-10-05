<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    
    protected $fillable = [
        'id', 'psgc_code', 'description'
    ];

    public function barangays()
    {
        return $this->hasMany('App\Barangay');
    }
}
