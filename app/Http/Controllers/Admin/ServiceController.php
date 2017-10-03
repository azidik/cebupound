<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PetService;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class ServiceController extends Controller
{
    public function index()
    {
        $serviceScheduleLists = PetService::where('status', 'Confirmed')->get();
        
        return view('dashboard.admin.services.list', compact('serviceScheduleLists'));
    }
    public function request()
    {
        $serviceRequests = PetService::where('status', 'Request')->get();
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
            if($serviceSchedule->pet->user->device_token != NULL || $serviceSchedule->pet->user->device_token != "" || $serviceSchedule->pet->user->device_token != 'undefined')
                $this->sendNotification($serviceSchedule);

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

    public function sendNotification($serviceSchedule)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);
        
        $notificationBuilder = new PayloadNotificationBuilder('Service Scheduled');
        $notificationBuilder->setBody("Hi! Your pet scheduled for services on". date('F j, Y', strtotime($serviceSchedule->schedule)))
                            ->setSound('default');
                            
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);
        
        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        
        $token = $serviceSchedule->pet->user->device_token;
        
        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
    }
}