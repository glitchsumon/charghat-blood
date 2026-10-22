<?php

namespace App\Jobs;

use App\Models\EmergencyRequest;
use App\Services\Notifications\EmergencyNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendEmergencyNotificationJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public readonly int $emergencyRequestId) {}

    public function handle(EmergencyNotificationService $service): void
    {
        $request = EmergencyRequest::query()->find($this->emergencyRequestId);

        if ($request) {
            $service->notifyGroup($request);
        }
    }
}
