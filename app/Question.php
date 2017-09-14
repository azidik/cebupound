<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $table = 'questions';
    
    protected $fillable = [
        'name'
    ];

    public function answers()
    {
        return $this->hasMany('App\Answer', 'question_id');
    }
}
