<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Weight;


class NotificationController extends Controller
{
    use GeneralTrait;


    public function storeToken(Request $request)
    {
        $user = auth()->user();
        User::find($user -> id)->update(['device_key'=>$request->token]);
        return $this -> returnSuccessMessage('Token successfully stored.');
    }


    public function sendNotification($FcmToken, $title, $body){
        //         $FcmToken = collect();
        // $FcmToken -> push(User::find(1) -> device_key);

            //  $FcmToken -> push(User::whereNotNull('device_key')-> where('id',1)->pluck('device_key'));
            //  $FcmToken -> push(User::whereNotNull('device_key')-> where('id',4)->pluck('device_key'));
            // User::whereNotNull('fcm_token')->pluck('fcm_token')
             // return $request -> FcmToken;
//$Token = "d4k4-W9-T3ig7GNYU0ZGGK:APA91bHlx0zbkCKdBs0Vl2H3WwvibfLo7mI_1_n9YdnM1B1SEenj4VmvLdF7B32-gv5yNHXBrQoCw6x0t2ZSCITgp6KUGZBcJ47uXpnDBui1PIIreUTBL2qxIvumIoLNjbmXetJMlepG";
                $url = 'https://fcm.googleapis.com/fcm/send';
                $SERVER_API_KEY = "AAAAqRZOc5o:APA91bFHKje5Q3i9mw03ZZQ2h8rv8pW_Vv0BStejnWjdbSXG4BWmAZ8zT86y9QVmk_oLOLRI7j71dEmtZFeWQY5eSHG7sOwNOz17NXMzanFs9t8wUY3eVI1Yx_eTfE2NTLtM7EZWj0f0";
                $data = [
                    "registration_ids" => $FcmToken,

                    "notification" => [
                        "title" => $title,
                        "body" => $body,
                        "sound" => "default"   //For notification sound in ios
                    ]
                ];

                    $encodedData = json_encode($data);

                    $headers =[
                        'Authorization:key=' . $SERVER_API_KEY,
                        'Content-Type: application/json',
                    ];

                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
                    // curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                    // // Disabling SSL Certificate support temporarly
                    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                    // Execute post
                    $result = curl_exec($ch);

                    if ($result === FALSE) {
                        die('Curl failed: ' . curl_error($ch));
                    }

                    // Close connection
                    curl_close($ch);
                    // dd($result);

                    return $result;

            }



//     public function sendNotification(Request $request){
// //         $FcmToken = collect();
// // $FcmToken -> push(User::find(1) -> device_key);

//     //  $FcmToken -> push(User::whereNotNull('device_key')-> where('id',1)->pluck('device_key'));
//     //  $FcmToken -> push(User::whereNotNull('device_key')-> where('id',4)->pluck('device_key'));
//     // User::whereNotNull('fcm_token')->pluck('fcm_token')
//      // return $request -> FcmToken;

//         $url = 'https://fcm.googleapis.com/fcm/send';
//         $SERVER_API_KEY = "AAAAqRZOc5o:APA91bFHKje5Q3i9mw03ZZQ2h8rv8pW_Vv0BStejnWjdbSXG4BWmAZ8zT86y9QVmk_oLOLRI7j71dEmtZFeWQY5eSHG7sOwNOz17NXMzanFs9t8wUY3eVI1Yx_eTfE2NTLtM7EZWj0f0";
//         $data = [
//             "registration_ids" => [$request -> FcmToken],

//             "notification" => [
//                 "title" => 'محمد',
//                 "body" => 'تم مرور 20 يوم على استخدام الدايت الحالي. يرجى الاطلاع ',
//                 "sound" => "default"   //For notification sound in ios
//             ]
//         ];

//             $encodedData = json_encode($data);

//             $headers =[
//                 'Authorization:key=' . $SERVER_API_KEY,

//                 'Content-Type: application/json',
//             ];

//             $ch = curl_init();

//             curl_setopt($ch, CURLOPT_URL, $url);
//             curl_setopt($ch, CURLOPT_POST, true);
//             curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//             curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//             curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
//             // curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
//             // // Disabling SSL Certificate support temporarly
//             // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

//             // Execute post
//             $result = curl_exec($ch);

//             if ($result === FALSE) {
//                 die('Curl failed: ' . curl_error($ch));
//             }

//             // Close connection
//             curl_close($ch);
//             // dd($result);

//             return $result;

//     }

}

