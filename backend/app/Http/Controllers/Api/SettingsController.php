<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Illuminate\Http\JsonResponse;

class SettingsController extends Controller
{
    public function index(): JsonResponse
    {
        $keys = ['home_carousel_interval', 'support_developer_url', 'share_app_url', 'admin_domain'];

        return response()->json(['data' => AppSetting::query()->whereIn('key', $keys)->pluck('value', 'key')]);
    }
}
