<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public $table = 'notifications';
    protected $fillable = [
    	'user_id', 'message', 'is_read'
    ];
}
