<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json([
            'data' => [
                ['id' => 1, 'title' => 'Emergency alert', 'read' => false],
                ['id' => 2, 'title' => 'Donor request response', 'read' => true],
            ],
        ]);
    }

    public function updatePreferences(Request $request): JsonResponse
    {
        $data = $request->validate([
            'push_enabled' => ['required', 'boolean'],
            'email_enabled' => ['required', 'boolean'],
            'language' => ['required', 'in:en,bn'],
        ]);

        $request->user()->update(['preferred_language' => $data['language']]);

        return response()->json(['message' => 'Notification preferences updated']);
    }
}
