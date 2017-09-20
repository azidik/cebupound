<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
	public $table = 'food_categories';

    protected $fillable = [
    	'name'
    ];
}
