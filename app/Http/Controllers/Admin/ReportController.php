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
use App\User;
use App\Adopt;
use App\Question;
use Validator;


class ReportController extends Controller
{
    public function index()
    {
        // $pets = Pet::all();
        // $impoundings = Impound::with('pet')->get();
        // $pet_shelter = [];

        // foreach($impoundings as $impounding) {
                
        //     $pet_shelter[] = $impounding->pet->where('pet_category_id', 1)->first();
        //     $pet_stray[] = $impounding->pet->where('pet_category_id', 2)->first();
        // }

        // $pet_services = PetService::where('status', 'Confirmed')->get();
        $clients = User::all();
        $pets = Pet::all();
        $impound_pets = Impound::all();
        $adopted_pets = Adopt::all();
        $questions = Question::all();
        $foods = Inventory::where('inventory_type_id', 1)->get();
        $medicines = Inventory::where('inventory_type_id', 2)->get();
        return view('dashboard.admin.reports.inventoryReports.list', compact('clients', 'pets', 'impound_pets', 'adopted_pets', 'questions', 'foods', 'medicines'));
    }

    public function foodList()
    {   
        $inventories = Inventory::all();

        return view('dashboard.admin.reports.food.list', compact('inventories'));
    }

    public function medicineList()
    {   
        $inventories = Inventory::all();

        return view('dashboard.admin.reports.medicine.list', compact('inventories'));
    }

    public function createFood(Request $request)
    {
        $types = PetType::all();
        $categories = FoodCategory::all();

        return view('dashboard.admin.reports.food.create', compact('types', 'categories'));
    }

    public function createMedicine(Request $request)
    {
        $types = PetType::all();
        $categories = MedicineCategory::all();

        return view('dashboard.admin.reports.medicine.create', compact('types', 'categories'));
    }
    
    public function storeFood(Request $request)
    {
        $params = $request->all();
        
        $validator = Validator::make($params, [
            'name' => 'required',
            'stock_in' => 'required|numeric',
            'expiry_date' => 'required'
        ]);

        if($validator->fails()) {
            return redirect('/dashboard/admin/inventory/createFood')
                ->withErrors($validator)
                ->withInput();
        } else {
            $params['pet_type_id'] = 1;
            $params['stock_out'] = 0;
            $params['inventory_type_id'] = 1;
            $params['expiry_date'] = date('Y-m-d H:i:s', strtotime($params['expiry_date']));
            $inventory = Inventory::create($params);
            if($inventory) {
                session()->flash('message', 'Invetory food created...');
                return redirect('/dashboard/admin/reports/food');
            } else {
                return redirect('/dashboard/admin/reports/food/create');
            }
        }   
    }
    public function storeMedicine(Request $request)
    {
        $params = $request->all();
        
        $validator = Validator::make($params, [
            'name' => 'required',
            'stock_in' => 'required|numeric',
            'expiry_date' => 'required'
        ]);

        if($validator->fails()) {
            return redirect('/dashboard/admin/reports/createMedicine')
                ->withErrors($validator)
                ->withInput();
        } else {
            $params['pet_type_id'] = 1;
            $params['stock_out'] = 0;
            $params['inventory_type_id'] = 3;
            $params['expiry_date'] = date('Y-m-d H:i:s', strtotime($params['expiry_date']));
            $inventory = Inventory::create($params);
            if($inventory) {
                session()->flash('message', 'Invetory medicine created...');
                return redirect('/dashboard/admin/reports/medicineList');
            } else {
                return redirect('/dashboard/admin/reports/createFood');
            }
        }   
    }
}
