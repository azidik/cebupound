<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public $table = 'answers';
    
    protected $fillable = [
        'name', 'is_correct'
    ];

    public function question()
    {
        return $this->belongsTo('App\Question');
    }
}
