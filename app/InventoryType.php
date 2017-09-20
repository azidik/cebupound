<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryType extends Model
{
    public $table = 'inventory_type';

    protected $fillable = [
    	'name'
    ];
}
