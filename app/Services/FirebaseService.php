<?php

namespace App\Services;

use Kreait\Firebase\Factory;

class FirebaseService
{
    protected $firebase;

    public function __construct()
    {
        $this->firebase = (new Factory)
            ->withServiceAccount(public_path().'/json/file.json');
    }

    public function sendNotification($fcmToken, $title, $body, $data = [])
    {
        $messaging = $this->firebase->createMessaging();

        $notification = [
            'title' => $title,
            'body' => $body,
        ];

        $message = [
            'token' => $fcmToken,
            'notification' => $notification,
            'data' => $data, // Optional custom data payload
        ];

        try {
            $messaging->send($message);
            return ['success' => true, 'message' => 'Notification sent successfully!'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
