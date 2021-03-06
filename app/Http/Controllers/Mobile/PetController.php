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

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

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
            $file_data = $request->input('image');
            $file_name = 'image_'.time().'.png'; 
            @list($type, $file_data) = explode(';', $file_data);
            @list(, $file_data) = explode(',', $file_data); 
            if($file_data!="")
                \Storage::disk('public')->put($file_name,base64_decode($file_data));
            $params['pet_category_id'] = 1;
            $params['user_id'] = $params['user_id'];
            $params['is_accepted'] = 0;
            $params['birth_date'] = date('Y-m-d H:i:s', strtotime($params['birth_date']));
            $params['image'] = $file_name;
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
   
      
        // $data = [];
        // foreach ($pets as $key => $pet) {
        //     if(isset($pet))
        //         $pet['is_accepted'] = 1;
        //     else
        //         $pet['is_accepted'] = 0;
      
            
        //     $data[] = $pet;
        // }
        // return $data;
 
        return $pet;
    }
    public function update(Request $request, $id)
    {
        $params = $request->all();
        
        $validator = Validator::make($params, [
            'name' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'breed_id' => 'required',
            'color' => 'required',
            'image' => 'required'
        ]);
        if($validator->fails()) {
            return $validator->errors();
        } else {
            $params['pet_category_id'] = 1;
            $params['user_id'] = $params['user_id'];
            $pet = Pet::find($id);
            $pet->name     = $params['name'];
            $pet->age      = $params['age'];
            $pet->gender   = $params['gender'];
            $pet->breed_id = $params['breed_id'];
            $pet->color    = $params['color'];
            $file_data = $request->input('image');
            $file_name = 'image_'.time().'.png'; 
            @list($type, $file_data) = explode(';', $file_data);
            @list(, $file_data) = explode(',', $file_data); 
            if($file_data!="")
                \Storage::disk('public')->put($file_name,base64_decode($file_data));
            
            $pet->image    = $file_name;
            $pet->save();
            
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
        $data = [];
        foreach ($pets as $key => $pet) {
            if(isset($pet->impound))
                $pet['is_impound'] = 1;
            else
                $pet['is_impound'] = 0;
            
            if(isset($pet->impound->adopt))
                $pet['is_adopted'] = 1;
            else
                $pet['is_adopted'] = 0;
            if(isset($pet))
                 // if(isset($pet))
                $pet['is_accepted'] = 1;
            else
                $pet['is_accepted'] = 0;
            
            $data[] = $pet;
        }
        return $data;
    }
    public function schedules($id)
    {
        $pets = Pet::with('service', 'impound')->where('user_id', $id)->get();
        // return $pets;
        $services = Service::all();
        $data = [];
        foreach ($pets as $key => $pet) {
            if(!isset($pet->impound) && !isset($pet->impound->adopt) && $pet['is_accepted'] == 1 ){ 
                $data[] = $pet;
            }
        }
        
        $response = [
            'services' => $services,
            'pets' => $data
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
        $data = [];
        foreach ($notifications as $key => $notification) {
            $arr['created_at'] = date('Y-m-d', strtotime($notification->created_at)) . ' 9AM - 4PM';
            $arr['message'] = $notification->message;
            $data[] = $arr;
        }
        
        return $data;
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