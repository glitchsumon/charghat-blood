<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BannerResource;
use App\Http\Resources\Api\DonorResource;
use App\Http\Resources\Api\EmergencyRequestResource;
use App\Models\Banner;
use App\Models\DonorProfile;
use App\Models\EmergencyRequest;
use App\Models\HealthTip;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => [
                'carousel_interval_seconds' => (int) config('charghat.home_carousel_interval', 5),
                'banners' => BannerResource::collection(Banner::query()->where('is_active', true)->orderBy('display_order')->get()),
                'top_donors' => DonorResource::collection(DonorProfile::query()->whereNotNull('approved_at')->latest('id')->limit(10)->get()),
                'emergency_requests' => EmergencyRequestResource::collection(EmergencyRequest::query()->where('status', 'active')->latest('id')->limit(10)->get()),
                'health_tips' => HealthTip::query()->where('is_published', true)->latest('id')->limit(10)->get(['id', 'title', 'content', 'image_url']),
            ],
        ]);
    }
}
