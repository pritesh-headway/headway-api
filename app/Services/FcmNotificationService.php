<?php

namespace App\Services;

use App\Models\NotificationSetting;
use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Storage;
use App\Models\UserDevices;

class FcmNotificationService
{
    public function __construct() {}

    public function sendFcmNotification($body)
    {

        $isSendNotification = NotificationSetting::where('user_id', $body['receiver_id'])->where('status', '1')->get();

        if (is_array($body['receiver_id'])) {
            $user = UserDevices::whereIn('user_id', $body['receiver_id'])->where('status', '1')->get();
        } else {
            $user = UserDevices::where('user_id', $body['receiver_id'])->where('status', '1')->get();
        }
        // dd($user);
        $fcm = [];
        foreach ($user as $tokens) {
            $fcm[] = $tokens['device_token'];
        }
        // $fcm = isset($fcm) ? implode(', ',$fcm) : '';
        // dd($fcm);
        if (!$fcm) {
            return response()->json(['message' => 'User does not have a device token'], 400);
        }
        $title = $body['title'];
        $description = $body['message'];
        $newArrData = isset($body['data']) ? (object)$body['data'] : '';
        $newArrDataIos = isset($body['data']) ? $body['data'] : '';
        // dd($newArrData);
        $projectId = config('services.fcm.project_id'); # INSERT COPIED PROJECT ID

        $credentialsFilePath = Storage::path('json/google-services.json');

        $client = new GoogleClient();
        $client->setAuthConfig($credentialsFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->refreshTokenWithAssertion();
        $token = $client->getAccessToken();

        $access_token = $token['access_token'];

        $headers = [
            "Authorization: Bearer $access_token",
            'Content-Type: application/json'
        ];
        if ($isSendNotification->subscription_notification_push == 1) {
            $messages = [];
            foreach ($fcm as $token) {
                $messages[] = [
                    'message' => [
                        'token' => $token,
                        'notification' => [
                            'title' => $title,
                            'body'  => $description,

                        ],
                        "data" => $newArrData,
                        'apns' => [
                            'payload' => [
                                'aps' => [
                                    'sound' => 'default'
                                ],
                                "type" => "new_message",
                                "userInfo" => $newArrDataIos,
                            ]
                        ],
                        'android' => [
                            'priority' => 'high',
                        ],
                    ]
                ];
            }
            foreach ($messages as $message) {
                $payload = json_encode($message);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send");
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                curl_setopt($ch, CURLOPT_VERBOSE, true); // Enable verbose output for debugging
                $response = curl_exec($ch);
                $err = curl_error($ch);
                curl_close($ch);

                if ($err) {
                    response()->json([
                        'status' => false,
                        'message' => 'Curl Error: ' . $err
                    ], 500);
                } else {
                    response()->json([
                        'status' => true,
                        'message' => 'Notification has been sent',
                        'response' => json_decode($response, true)
                    ]);
                }
            }
        }
    }

    public function sendFcmAdminNotification($body)
    {
        if (is_array($body['receiver_id'])) {
            $user = UserDevices::whereIn('user_id', $body['receiver_id'])->where('status', '1')->where('device_token', '!=', '')->get();
        } else {
            $user = UserDevices::where('user_id', $body['receiver_id'])->where('status', '1')->where('device_token', '!=', '')->get();
        }
        // dd($user);
        $fcm = [];
        foreach ($user as $tokens) {
            $fcm[] = $tokens['device_token'];
        }
        // $fcm = isset($fcm) ? implode(', ',$fcm) : '';
        // dd($fcm);
        if (!$fcm) {
            return response()->json(['message' => 'User does not have a device token'], 400);
        }
        $title = $body['title'];
        $description = $body['message'];
        $type = $body['type'];
        $newArrData = isset($body['data']) ? (object)$body['data'] : '';
        // dd($newArrData);
        $projectId = config('services.fcm.project_id'); # INSERT COPIED PROJECT ID

        $credentialsFilePath = Storage::path('json/google-services.json');

        $client = new GoogleClient();
        $client->setAuthConfig($credentialsFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->refreshTokenWithAssertion();
        $token = $client->getAccessToken();

        $access_token = $token['access_token'];

        $headers = [
            "Authorization: Bearer $access_token",
            'Content-Type: application/json'
        ];

        $messages = [];
        foreach ($fcm as $token) {
            $messages[] = [
                'message' => [
                    'token' => $token,
                    'notification' => [
                        'title' => $title,
                        'body'  => $description,

                    ],
                    "data" => $newArrData,
                    'apns' => [
                        'payload' => [
                            'aps' => [
                                'sound' => isset($body['sound']) ? $body['sound'] : 'default'
                            ],
                            "type" => $type,
                        ]
                    ],
                    'android' => [
                        'priority' => 'high',
                    ],
                ]
            ];
        }
        // dd($messages);
        foreach ($messages as $message) {
            $payload = json_encode($message);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_VERBOSE, true); // Enable verbose output for debugging
            $response = curl_exec($ch);
            $err = curl_error($ch);
            curl_close($ch);

            if ($err) {
                response()->json([
                    'status' => false,
                    'message' => 'Curl Error: ' . $err
                ], 500);
            } else {
                response()->json([
                    'status' => true,
                    'message' => 'Notification has been sent',
                    'response' => json_decode($response, true)
                ]);
            }
        }
    }
}
