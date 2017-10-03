<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PetService;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\Notification;

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

        $serviceSchedule = PetService::where('id', $params['id'])->first();
        $serviceSchedule->schedule = date('Y-m-d H:i:s', strtotime($params['scheduleDate']));
        $serviceSchedule->status = 'Confirmed';
        $serviceSchedule->save();

        return $serviceSchedule;

        // $notification = new Notification;
        // $notification->user_id = $serviceSchedule['pet']['user']['id'];
        // $notification->mesage = 'Your pet has been scheduled for service on'. date('F j, Y', strtotime($serviceSchedule['schedule']));
        // $notification->is_read = 0;
        // $notification->save();

        // // if($notification) {
        //     $optionBuilder = new OptionsBuilder();
        //     $optionBuilder->setTimeToLive(60*20);
            
        //     $notificationBuilder = new PayloadNotificationBuilder('Service Scheduled');
        //     $notificationBuilder->setBody("Hi! Your pet scheduled for services on". date('F j, Y', strtotime($serviceSchedule['schedule'])))
        //                         ->setSound('default');
                                
        //     $dataBuilder = new PayloadDataBuilder();
        //     $dataBuilder->addData(['a_data' => 'my_data']);
            
        //     $option = $optionBuilder->build();
        //     $notification = $notificationBuilder->build();
        //     $data = $dataBuilder->build();
            
        //     $token = 'f3NSEhMsdUE:APA91bFnBij9TZUKmCJms0gP904Oj1Dz2YmumMv4TghfiTi2tPxbeuuJUkteyU0o6QljtD5M2GvzO-ZTv-2gq-lPs2nH080quBbGGOeeQigPvu39OW-EQB80GzvpWT7OhaY5idYXBiRb';
            
        //     $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        // // }

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

    public function sendNotification($serviceSchedule)
    {   
        $notification = new Notification;
        $notification->user_id = $serviceSchedule['pet']['user']['id'];
        $notification->mesage = 'Your pet has been scheduled for service on'. date('F j, Y', strtotime($serviceSchedule['schedule']));
        $notification->is_read = 0;
        $notification->save();

        if($notification) {
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60*20);
            
            $notificationBuilder = new PayloadNotificationBuilder('Service Scheduled');
            $notificationBuilder->setBody("Hi! Your pet scheduled for services on". date('F j, Y', strtotime($serviceSchedule['schedule'])))
                                ->setSound('default');
                                
            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData(['a_data' => 'my_data']);
            
            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();
            
            $token = $serviceSchedule['pet']['user']['device_token'];
            
            $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        }
    }
}