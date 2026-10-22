<?php

namespace App\Services\Notifications;

use Illuminate\Support\Facades\Mail;

class EmailNotificationChannel implements NotificationChannel
{
    public function send(string $target, string $subject, string $body): void
    {
        Mail::raw($body, static function ($message) use ($target, $subject): void {
            $message->to($target)->subject($subject);
        });
    }
}
