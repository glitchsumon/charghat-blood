<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HealthTip;
use App\Models\Hospital;
use App\Models\Medicine;
use Illuminate\Http\JsonResponse;

class DirectoryController extends Controller
{
    public function hospitals(): JsonResponse
    {
        return response()->json(['data' => Hospital::query()->where('is_active', true)->paginate(20)]);
    }

    public function medicines(): JsonResponse
    {
        return response()->json(['data' => Medicine::query()->where('is_active', true)->paginate(20)]);
    }

    public function healthTips(): JsonResponse
    {
        return response()->json(['data' => HealthTip::query()->where('is_published', true)->paginate(20)]);
    }
}
