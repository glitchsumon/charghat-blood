<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateEmergencyRequest;
use App\Http\Resources\Api\EmergencyRequestResource;
use App\Jobs\SendEmergencyNotificationJob;
use App\Models\EmergencyRequest;
use App\Services\Verification\EmailCodeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmergencyController extends Controller
{
    public function __construct(private readonly EmailCodeService $codes) {}

    public function index(Request $request)
    {
        $query = EmergencyRequest::query()->with(['bloodGroup', 'upazila'])->latest('id');

        if ($request->boolean('mine')) {
            $query->where('user_id', $request->user()->id);
        }

        if ($request->filled('blood_group_id')) {
            $query->where('blood_group_id', $request->integer('blood_group_id'));
        }

        if ($request->filled('upazila_id')) {
            $query->where('upazila_id', $request->integer('upazila_id'));
        }

        return EmergencyRequestResource::collection($query->paginate(15));
    }

    public function store(CreateEmergencyRequest $request): JsonResponse
    {
        if (! $this->codes->verify($request->user()->email, $request->string('verification_code')->toString())) {
            return response()->json(['message' => 'Invalid verification code'], 422);
        }

        $payload = $request->safe()->except('verification_code');
        $emergency = EmergencyRequest::query()->create($payload + [
            'user_id' => $request->user()->id,
            'status' => 'active',
            'verified_at' => now(),
        ]);

        SendEmergencyNotificationJob::dispatch($emergency->id);

        return response()->json(['message' => 'Emergency request created', 'data' => new EmergencyRequestResource($emergency)], 201);
    }

    public function show(EmergencyRequest $emergencyRequest): EmergencyRequestResource
    {
        return new EmergencyRequestResource($emergencyRequest->load(['bloodGroup', 'upazila']));
    }

    public function respond(EmergencyRequest $emergencyRequest, Request $request): JsonResponse
    {
        $request->validate(['message' => ['required', 'string', 'max:500']]);

        return response()->json(['message' => 'Response recorded for admin follow-up']);
    }
}
