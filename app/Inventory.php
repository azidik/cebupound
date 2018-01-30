<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public $tables = 'inventories';

    protected $fillable = [
        'pet_type_id', 'inventory_type_id','name','description', 'stock_in', 'stock_out', 'expiry_date', 'food_category_id', 'medicine_category_id'
    ];

    public function pettype()
    {
    	return $this->belongsTo('App\PetType', 'pet_type_id');
    }

    public function fcategorytype()
    {
        return $this->belongsTo('App\FoodCategory', 'food_category_id');
    }

    public function mcategorytype()
    {
        return $this->belongsTo('App\MedicineCategory', 'medicine_category_id');
    }
}
