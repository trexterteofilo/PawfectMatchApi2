<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\NotificationScheduleJob;
use App\Models\Notification;
use SebastianBergmann\Type\TrueType;


class NotificationController extends Controller
{
    static public function savenotif($type, $title, $body, $recipient_id, $sender_id)
    {
        //save to database

        $save = Notification::create([
            'type' => $type,
            'title' => $title,
            'body' => $body,
            'recipient_id' => $recipient_id,
            'sender_id' => $sender_id,
            'notification_status' => 'Unseen',
            'route' => 'default',

        ]);

        return [
            $save

        ];

    }
    static public function notify($type, $title, $body, $device_key, $recipient_id, $sender_id)
    {
        $url = "https://fcm.googleapis.com/fcm/send";

        $serverKey = env('FCM_SERVER_KEY', 'async');

        $dataArr = [
            "click_action" => "FLUTTER_NOTIFICATION_CLICK",
            "status" => "done"
        ];

        $data = [
            "registration_ids" => [
                $device_key,
            ],
            "notification" => [
                "title" => $title,
                "body" => $body,
                "sound" => "default",
            ],
            "data" => $dataArr,
            "priority" => "high",

        ];
        $encodedData = json_encode($data);

        $headers = [
            "Authorization:key=" . $serverKey,
            "Content-Type: application/json",
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        //disale ssl  certificate support temorarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

        //execute post

        $result = curl_exec($ch);

        if ($result === FALSE) {
            return [
                'message' => 'failed',
                'r' => $result,
                'success' => false
            ];
        }


        curl_close($ch);

        // $output = NotificationController::savenotif($type, $title, $body, $recipient_id, $sender_id);

        if ($result === TRUE) {



            return [
                'message' => 'success',
                'r' => $result,
                'success' => true,
                // $output
            ];
        }






    }

    public function testqueues(Request $request)
    {
        $users = User::whereNotNull('device_ket')->whereNotNull('delay')->get();

        foreach ($users as $user) {
            dispatch(new NotificationScheduleJob($user->userID, $user->email, $user->device_key))->delay(now()->addMinutes($user->delay));
        }
    }


    public function savenotifss(Request $request)
    {
        $save = Notification::create([
            'type' => $request->type,
            'title' => $request->title,
            'body' => $request->body,
            'recipient_id' => $request->recipient_id,
            'sender_id' => $request->sender_id,
            'notification_status' => 'Unseen',
            'route' => 'default',

        ]);

        return [
            $save

        ];
    }


    public function notifyapp(Request $request)
    {
        return [
            $this->notify($request->type, $request->title, $request->body, $request->device_key, $request->recipient_id, $request->sender_id),

            'title' => $request->title,
            'body' => $request->body,
            'key' => $request->device_key,
            'this' => $this
        ];
    }

    public function notifunc($type, $title, $body, $device_key, $recipient_id, $sender_id)
    {
        return [
            $this->notify($type, $title, $body, $device_key, $recipient_id, $sender_id),
        ];
    }




}
