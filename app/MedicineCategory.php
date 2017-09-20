<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicineCategory extends Model
{
    public $table = 'medicine_categories';

    protected $fillable = [
    	'name'
    ];
}
