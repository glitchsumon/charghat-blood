<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DonorSearchRequest;
use App\Http\Resources\Api\DonorResource;
use App\Models\DonorApplication;
use App\Models\DonorProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    public function index(DonorSearchRequest $request)
    {
        $query = DonorProfile::query()->with(['user', 'bloodGroup', 'upazila'])
            ->whereNotNull('approved_at');

        if ($request->filled('blood_group_id')) {
            $query->where('blood_group_id', $request->integer('blood_group_id'));
        }

        if ($request->filled('upazila_id')) {
            $query->where('upazila_id', $request->integer('upazila_id'));
        }

        if ($request->filled('availability_status')) {
            $query->where('availability_status', $request->string('availability_status')->toString());
        }

        if ($request->filled('q')) {
            $q = $request->string('q')->toString();
            $query->whereHas('user', fn ($sub) => $sub->where('name', 'like', "%{$q}%"));
        }

        return DonorResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function show(DonorProfile $donorProfile): DonorResource
    {
        return new DonorResource($donorProfile->load(['user', 'bloodGroup', 'upazila', 'reviews']));
    }

    public function submitApplication(Request $request): JsonResponse
    {
        $data = $request->validate([
            'blood_group_id' => ['required', 'exists:blood_groups,id'],
            'upazila_id' => ['required', 'exists:upazilas,id'],
            'weight_kg' => ['nullable', 'integer', 'min:35', 'max:150'],
            'medical_notes' => ['nullable', 'string', 'max:2000'],
            'last_donated_at' => ['nullable', 'date'],
            'availability_status' => ['required', 'in:available,unavailable,recently_donated'],
        ]);

        $application = DonorApplication::query()->create($data + ['user_id' => $request->user()->id, 'status' => 'pending']);

        return response()->json(['message' => 'Application submitted', 'data' => $application], 201);
    }
}
