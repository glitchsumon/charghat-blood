<?php

namespace App\Services\Notifications;

use App\Models\EmergencyRequest;
use App\Models\NotificationTemplate;

class EmergencyNotificationService
{
    public function __construct(
        private readonly NotificationChannel $emailChannel,
        private readonly NotificationChannel $pushChannel,
    ) {}

    public function notifyGroup(EmergencyRequest $request): void
    {
        $template = NotificationTemplate::query()->where('name', 'emergency-group-alert')->first();
        $subject = $template?->subject ?? 'Emergency blood request';
        $body = strtr($template?->body ?? 'Emergency request for :blood_group at :hospital', [
            ':blood_group' => (string) $request->bloodGroup?->name,
            ':hospital' => $request->hospital_name,
        ]);

        // Placeholder: actual target resolution should use donor subscriptions and preference tables.
        $target = 'group:'.$request->blood_group_id;

        $this->emailChannel->send('alerts@charghatblood.test', $subject, $body);
        $this->pushChannel->send($target, $subject, $body);
    }
}
