<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PassingRate extends Model
{
    public $table = 'passing_rates';

	protected $fillable = [
		'percent', 'count_question'
	];    
}
