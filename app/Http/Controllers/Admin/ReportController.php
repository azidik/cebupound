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
use App\Barangay;
use App\Donor;
use Validator;


class ReportController extends Controller
{
    public function index()
    {
        $clients = User::all();
        $pets = Pet::all();
        $impound_pets = Impound::all();
        $impound_pets_count_sheltered = Impound::whereHas('pet', function($pet) {
            $pet->whereHas('category', function ($query) {
                $query->where('id', 1);
            });
        })->get();

        // return $impound_pets_count_stray;
        $impound_pets_count_stray = Impound::whereHas('pet', function($pet) {
            $pet->whereHas('category', function ($query) {
                $query->where('id', 2);
            });
        })->get();
        $adopted_pets = Adopt::all();
        $questions = Question::all();
        $foods = Inventory::where('inventory_type_id', 1)->get();
        $medicines = Inventory::where('inventory_type_id', 2)->get();
        $deworming = PetService::where('service_id', 1)->get();
        $treatement = PetService::where('service_id', 2)->get();
        $spray = PetService::where('service_id', 3)->get();
        $rabies = PetService::where('service_id', 4)->get();

        // foreach ($rabies as $key => $rab) {
        //     echo $rab->pet->user->barangay->description;
        // }
        // return;
        $barangays = Barangay::where('city_id', 72217)->get();
        $medical = PetService::where('service_id', 5)->get();
        return view('dashboard.admin.reports.inventoryReports.list', compact('clients', 'pets', 'impound_pets', 'adopted_pets', 'questions', 'foods', 'medicines', 'deworming', 'treatement', 'spray', 'rabies', 'medical', 'barangays', 'impound_pets_count_sheltered', 'impound_pets_count_stray'));
    }

    public function foodList()
    {   
        $inventories = Inventory::where('inventory_type_id', 1)->get();
        return view('dashboard.admin.reports.food.list', compact('inventories'));
    }

    public function medicineList()
    {   
        $inventories = Inventory::where('inventory_type_id', 2)->get();
        return view('dashboard.admin.reports.medicine.list', compact('inventories'));
    }

    public function donorList()
    {   
        $donors = Donor::all();
        return view('dashboard.admin.reports.donor.list', compact('donors'));
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
    
    public function createDonor(Request $request)
    {
        $donors = Donor::all();
        return view('dashboard.admin.reports.donor.create', compact('donors'));
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
                session()->flash('message', 'Inventory food created...');
                return redirect('/dashboard/admin/inventory/foodList');
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
            return redirect('/dashboard/admin/inventory/createMedicine')
                ->withErrors($validator)
                ->withInput();
        } else {
            $params['pet_type_id'] = 1;
            $params['stock_out'] = 0;
            $params['inventory_type_id'] = 2;
            $params['expiry_date'] = date('Y-m-d H:i:s', strtotime($params['expiry_date']));
            $inventory = Inventory::create($params);
            if($inventory) {
                session()->flash('message', 'Inventory medicine created...');
                return redirect('/dashboard/admin/inventory/medicineList');
            } else {
                return redirect('/dashboard/admin/reports/medicine/create');
            }
        }   
    }

     public function storeDonor(Request $request)
    {
        $params = $request->all();
        
        $validator = Validator::make($params, [
            'firstname' => 'required',
            'lastname' => 'required',
            'contact_no' => 'required'
        ]);

        if($validator->fails()) {
            return redirect('/dashboard/admin/inventory/createDonor')
                ->withErrors($validator)
                ->withInput();
        } else {
            $inventory = Inventory::create($params);
            if($inventory) {
                session()->flash('message', 'Invetory donor created...');
                return redirect('/dashboard/admin/inventory/donorList');
            } else {
                return redirect('/dashboard/admin/reports/donor/create');
            }
        }   
    }

    public function updateFood(Request $request, $id)
    {
        $params = $request->all();
        
        $validator = Validator::make($params, [
            'name' => 'required',
            'stock_in' => 'required|numeric',
            'expiry_date' => 'required'
        ]);

        if($validator->fails()) {
            return redirect('/dashboard/admin/inventory/foodList/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
            $params['pet_type_id'] = 1;
            $params['stock_out'] = 0;
            $params['inventory_type_id'] = 1;
            $params['expiry_date'] = date('Y-m-d H:i:s', strtotime($params['expiry_date']));
            $inventory = Inventory::find($id)->update($params);
            if($inventory) {
                session()->flash('message', 'Food updated...');
                return redirect('/dashboard/admin/inventory/foodList');
            } else {
                return redirect('/dashboard/admin/inventory/foodList/' .$id);
            }
        }

     public function updateMedicine(Request $request, $id)
    {
        $params = $request->all();
        
        $validator = Validator::make($params, [
            'name' => 'required',
            'stock_in' => 'required|numeric',
            'expiry_date' => 'required'
        ]);

        if($validator->fails()) {
            return redirect('/dashboard/admin/inventory/medicineList/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
            $params['pet_type_id'] = 1;
            $params['stock_out'] = 0;
            $params['inventory_type_id'] = 1;
            $params['expiry_date'] = date('Y-m-d H:i:s', strtotime($params['expiry_date']));
            $inventory = Inventory::find($id)->update($params);
            if($inventory) {
                session()->flash('message', 'Medicine updated...');
                return redirect('/dashboard/admin/inventory/medicineList');
            } else {
                return redirect('/dashboard/admin/inventory/medicineList/' .$id);
            }
        }

        
    public function checkReport($barangayId, $report_name)
    {   
        switch ($report_name) {
            case 'deworming':
                $service_id = 1;
                break;
            case 'mange_treatment':
                $service_id = 2;
                break;
            case 'spay_neuter':
                $service_id = 3;
                break;
            case 'rabies_vaccination':
                $service_id = 4;
                break;
            case 'basic_medical_consultation':
                $service_id = 5;
                break;
            default:
                # code...
                break;
        }

        $reports = PetService::where('service_id', $service_id)->get();
        $count = 0;
        foreach ($reports as $report) {
            if($report->pet->user->barangay->id == $barangayId) {
                $count++;
            }
        }
        return $count;

    }

      public function petReport($barangayId)
    {   
        $reports = User::where('pet_id', $pet_id)->get();
        $count = 0;
        foreach ($reports as $report) {
            if($report->pet->user->barangay->id == $barangayId) {
                $count++;
            }
        }
        return $count;

    }
}
