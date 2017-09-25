<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pet;
use App\PetService;
use App\Impound;
use App\Inventory;
use App\InventoryType;
use App\PetType;
use App\FoodCategory;
use App\MedicineCategory;
use App\Validator;

class ReportController extends Controller
{
    public function index()
    {
        $pets = Pet::all();
        $impoundings = Impound::with('pet')->get();
        $pet_shelter = [];

        foreach($impoundings as $impounding) {
                
            $pet_shelter[] = $impounding->pet->where('pet_category_id', 1)->first();
            $pet_stray[] = $impounding->pet->where('pet_category_id', 2)->first();
        }

        $pet_services = PetService::where('status', 'Confirmed')->get();
        return view('dashboard.admin.inventoryReports.reports.list', compact('pets', 'impoundings', 'pet_shelter', 'pet_stray', 'pet_services'));
    }

    public function foodList()
    {   
        $inventories = Inventory::all();

        return view('dashboard.admin.inventoryReports.food.list', compact('inventories'));
    }

    public function medicineList()
    {   
        $inventories = Inventory::all();

        return view('dashboard.admin.inventoryReports.medicine.list', compact('inventories'));
    }

    public function createFood(Request $request)
    {
        $types = PetType::all();
        $categories = FoodCategory::all();

        return view('dashboard.admin.inventoryReports.food.create', compact('types', 'categories'));
    }

    public function createMedicine(Request $request)
    {
        $types = PetType::all();
        $categories = MedicineCategory::all();

        return view('dashboard.admin.inventoryReports.medicine.create', compact('types', 'categories'));
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
                return redirect('/dashboard/admin/inventoryReports/food');
            } else {
                return redirect('/dashboard/admin/inventoryReports/food/create');
            }
        }   
    }
}
