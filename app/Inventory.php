<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public $tables = 'inventories';

    protected $fillable = [
        'item_code', 'item','description','price', 'stock_in', 'stock_out'
    ];

}
