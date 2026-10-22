<?php

namespace App\Services\Notifications;

interface NotificationChannel
{
    public function send(string $target, string $subject, string $body): void;
}
