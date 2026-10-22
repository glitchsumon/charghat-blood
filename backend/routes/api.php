<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ConversationController;
use App\Http\Controllers\Api\DirectoryController;
use App\Http\Controllers\Api\DonorController;
use App\Http\Controllers\Api\EmergencyController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SettingsController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::middleware('throttle:api-otp')->post('/auth/send-verification-code', [AuthController::class, 'sendVerificationCode']);
    Route::middleware('throttle:api-auth')->post('/auth/register', [AuthController::class, 'register']);
    Route::middleware('throttle:api-auth')->post('/auth/login', [AuthController::class, 'login']);

    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/donors', [DonorController::class, 'index']);
    Route::get('/donors/{donorProfile}', [DonorController::class, 'show']);
    Route::get('/emergency-requests', [EmergencyController::class, 'index']);
    Route::get('/emergency-requests/{emergencyRequest}', [EmergencyController::class, 'show']);
    Route::get('/directory/hospitals', [DirectoryController::class, 'hospitals']);
    Route::get('/directory/medicines', [DirectoryController::class, 'medicines']);
    Route::get('/directory/health-tips', [DirectoryController::class, 'healthTips']);
    Route::get('/settings', [SettingsController::class, 'index']);

    Route::middleware('auth:sanctum')->group(function (): void {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [ProfileController::class, 'show']);
        Route::patch('/profile', [ProfileController::class, 'update']);

        Route::post('/donor-applications', [DonorController::class, 'submitApplication']);

        Route::post('/emergency-requests', [EmergencyController::class, 'store']);
        Route::post('/emergency-requests/{emergencyRequest}/respond', [EmergencyController::class, 'respond']);

        Route::get('/conversations', [ConversationController::class, 'index']);
        Route::get('/conversations/{conversation}', [ConversationController::class, 'show']);
        Route::post('/conversations/{conversation}/messages', [ConversationController::class, 'storeMessage']);

        Route::get('/notifications', [NotificationController::class, 'index']);
        Route::patch('/notification-preferences', [NotificationController::class, 'updatePreferences']);
    });
});
