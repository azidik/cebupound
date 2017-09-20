<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inventory;
use App\InventoryType;
use App\PetType;
use App\FoodCategory;
use App\MedicineCategory;
use App\Validator;

class InventoryController extends Controller
{
    public function foodList()
    {   
        $inventories = Inventory::all();

        return view('dashboard.admin.inventories.food.list', compact('inventories'));
    }

    public function medicineList()
    {   
        $inventories = Inventory::all();

        return view('dashboard.admin.inventories.medicine.list', compact('inventories'));
    }

    public function createFood(Request $request)
    {
        $types = PetType::all();
        $categories = FoodCategory::all();

        return view('dashboard.admin.inventories.food.create', compact('types', 'categories'));
    }

    public function createMedicine(Request $request)
    {
        $types = PetType::all();
        $categories = MedicineCategory::all();

        return view('dashboard.admin.inventories.medicine.create', compact('types', 'categories'));
    }
    
    public function store()
    {
        $params = $request->all();
        
        $validator = Validator::make($params, [
            'name' => 'required',
            'stock_in' => 'required|numeric',
            'expiry_date' => 'required'
        ]);

        if($validator->fails()) {
            return redirect('/dashboard/admin/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $params['pet_type_id'] = 1;
            $inventory = Inventory::create($params);
            if($inventory) {
                session()->flash('message', 'Pet updated...');
                return redirect('/dashboard/admin/inventories/food');
            } else {
                return redirect('/dashboard/admin/inventories/food/create');
            }
        }   
    }
}
