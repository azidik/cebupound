<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pet;
use Validator;
use Auth;
use App\Service;
use App\PetService;

class PetController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->all();
    
        $validator = Validator::make($params, [
            'name' => 'required',
            'age' => 'required|numeric',
            'gender' => 'required',
            'breed' => 'required',
            'color' => 'required',
            'image' => 'required'
        ]);

        if($validator->fails()) {
            return $validator->errors();
        } else {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $destinationPath = public_path('images');
                if (!File::exists($destinationPath)) {
                    $fileDir = File::makeDirectory('images');
                }
                $image = $file->getClientOriginalName();
                $file->move($destinationPath, $image);
                $params['image'] = $image;
            }
            $params['pet_category_id'] = 1;
            $params['user_id'] = $params['user_id'];
            $pet = Pet::create($params);
            if($pet) {
                $response = [
                    'status' => 1
                ];
            } else {
                $response = [
                    'status' => 0
                ];
            }
            return $response;
        }
    }
    public function show($id) 
    {
        $pet = Pet::find($id);

        return $pet;
    }
    public function update(Request $request, $id)
    {
        $params = $request->all();
        
        $validator = Validator::make($params, [
            'name' => 'required',
            'age' => 'required|numeric',
            'gender' => 'required',
            'breed' => 'required',
            'color' => 'required',
            'image' => 'required'
        ]);

        if($validator->fails()) {
            return $validator->errors();
        } else {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $destinationPath = public_path('images');
                if (!File::exists($destinationPath)) {
                    $fileDir = File::makeDirectory('images');
                }
                $image = $file->getClientOriginalName();
                $file->move($destinationPath, $image);
                $params['image'] = $image;
            }
            $params['pet_category_id'] = 1;
            $params['user_id'] = $params['user_id'];
            $pet = Pet::find($id)->update($params);
            if($pet) {
                $response = [
                    'status' => 1
                ];
            } else {
                $response = [
                    'status' => 0
                ];
            }

            return $response;
        }
    }
    public function mypets($userId)
    {
        $pets = Pet::with('type')->where('user_id', $userId)->get();
        return $pets;
    }

    public function schedules($id)
    {
        $pets = Pet::with('service')->where('user_id', $id)->get();
        // return $pets;
        $services = Service::all();

        $response = [
            'services' => $services,
            'pets' => $pets
        ];

        return $response;
    }

    public function createPetService(Request $request)
    {
        $params = $request->all();

        $pet_service  = PetService::create([
            'pet_id' => $params['pet_id'],
            'service_id' => $params['service_id'],
            'status' => 'Request'
        ]);

        if($pet_service) {
            $response = [
                'status' => 1,
                'pet_service' => $pet_service 
            ];
        } else {
            $response = [
                'status' => 0   
            ];
        }
        return $response;
    }
}
