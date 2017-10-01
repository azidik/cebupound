<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PetService;
class ServiceController extends Controller
{
    public function index()
    {
        $serviceScheduleLists = PetService::where('status', 'Confirmed')->get();
        
        return view('dashboard.admin.services.list', compact('serviceScheduleLists'));
    }
    public function request()
    {
        $serviceRequests = PetService::where('status', 'Request')->first();
        echo $serviceRequests->pet->image;
        exit;
        return view('dashboard.admin.services.request', compact('serviceRequests'));
    }
    public function setDateSchedule(Request $request)
    {
        $params = $request->all();
        // return date('Y-m-d  ', strtotime($params['scheduleDate']));   
        // $date = strtr($params['scheduleDate'], '/', '-');
        // return date('Y-m-d H:i:s', strtotime($date));
        // return DateTime::createFromFormat('d/m/Y', $date1);
        $serviceSchedule = PetService::find($params['id'])->update([
            'schedule' => date('Y-m-d H:i:s', strtotime($params['scheduleDate'])), 
            'status' => 'Confirmed'
        ]);
        if($serviceSchedule){
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