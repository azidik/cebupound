<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pet;
use Validator;
use Auth;
use App\Service;
use App\PetService;
use App\Notification;
use App\History;
use App\Breed;
use Log;

class PetController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->all();
    
        $validator = Validator::make($params, [
            'name' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'breed_id' => 'required',
            'color' => 'required',
            'birth_date' => 'required',
            // 'image' => 'required'
        ]);

        if($validator->fails()) {
            return $validator->errors();
        } else {
            Log::info($params);
            // if ($request->hasFile('image')) {
            //     $file = $request->file('image');
            //     $destinationPath = public_path('images');
            //     if (!File::exists($destinationPath)) {
            //         $fileDir = File::makeDirectory('images');
            //     }
            //     $image = $file->getClientOriginalName();
            //     $file->move($destinationPath, $image);
            //     $params['image'] = $image;
            // }
            $params['pet_category_id'] = 1;
            $params['user_id'] = $params['user_id'];
            $params['is_accepted'] = 0;
            $params['birth_date'] = date('Y-m-d H:i:s', strtotime($params['birth_date']));
            // $params['image'] = $params['image'];
            $pet = Pet::create($params);
            if($pet) {
                History::create([
                    'user_id' => $pet->user_id,
                    'description' => 'You have been created pet @'. $pet->name . '' .$pet->gender
                ]);
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
            'age' => 'required',
            'gender' => 'required',
            'breed' => 'required',
            'color' => 'required',
            'image' => 'required'
        ]);

        if($validator->fails()) {
            return $validator->errors();
        } else {
            Log::info($params);
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
                History::create([
                    'user_id' => $pet->user_id,
                    'description' => 'You have been updated pet @'. $pet->name . '' .$pet->gender
                ]);
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
            History::create([
                'user_id' => $pet_service->pet->user->id,
                'description' => 'You have been requested service '.$pet_service->service->name.'for pet @'. $pet->name . '' .$pet->gender
            ]);
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

    public function notifications($id)
    {
        $notifications = Notification::where('user_id', $id)->get();

        return $notifications;
    }
    public function histories($id)
    {
        $histories = History::where('user_id', $id)->get();

        return $histories;
    }

    public function breed($id)
    {
        $breeds = Breed::where('pet_type_id', $id)->get();

        return $breeds;
    }
}
