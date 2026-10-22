<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        return response()->json(['data' => $request->user()->load(['bloodGroup', 'upazila', 'donorProfile'])]);
    }

    public function update(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:120'],
            'phone' => ['sometimes', 'string', 'max:20'],
            'preferred_language' => ['sometimes', 'in:en,bn'],
        ]);

        $request->user()->update($data);

        return response()->json(['message' => 'Profile updated', 'data' => $request->user()->fresh()]);
    }
}
