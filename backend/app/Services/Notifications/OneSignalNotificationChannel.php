<?php

namespace App\Services\Notifications;

use Illuminate\Support\Facades\Http;

class OneSignalNotificationChannel implements NotificationChannel
{
    public function send(string $target, string $subject, string $body): void
    {
        $appId = config('services.onesignal.app_id');
        $apiKey = config('services.onesignal.api_key');

        if (! $appId || ! $apiKey) {
            return;
        }

        Http::withToken($apiKey)->post('https://onesignal.com/api/v1/notifications', [
            'app_id' => $appId,
            'headings' => ['en' => $subject],
            'contents' => ['en' => $body],
            'include_external_user_ids' => [$target],
        ]);
    }
}
