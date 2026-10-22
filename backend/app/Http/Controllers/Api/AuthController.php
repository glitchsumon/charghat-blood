<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\SendVerificationCodeRequest;
use App\Models\User;
use App\Services\Verification\EmailCodeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(private readonly EmailCodeService $codes) {}

    public function sendVerificationCode(SendVerificationCodeRequest $request): JsonResponse
    {
        $code = $this->codes->issue($request->string('email')->toString());

        return response()->json([
            'message' => 'Verification code issued',
            'data' => ['demo_code' => app()->environment('local', 'testing') ? $code : null],
        ]);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        if (! $this->codes->verify($request->string('email')->toString(), $request->string('verification_code')->toString())) {
            return response()->json(['message' => 'Invalid verification code'], 422);
        }

        $user = User::query()->create([
            'name' => $request->string('name')->toString(),
            'phone' => $request->string('phone')->toString(),
            'email' => $request->string('email')->toString(),
            'date_of_birth' => $request->date('date_of_birth'),
            'blood_group_id' => $request->integer('blood_group_id'),
            'upazila_id' => $request->integer('upazila_id'),
            'password' => Hash::make($request->string('password')->toString()),
            'preferred_language' => 'en',
            'email_verified_at' => now(),
        ]);

        $token = $user->createToken($request->string('device_name', 'mobile-app')->toString())->plainTextToken;

        return response()->json(['message' => 'Registered successfully', 'data' => ['token' => $token, 'user' => $user]], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);

        if (! Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 422);
        }

        /** @var User $user */
        $user = Auth::user();
        $token = $user->createToken($request->string('device_name', 'mobile-app')->toString())->plainTextToken;

        return response()->json(['message' => 'Login successful', 'data' => compact('token', 'user')]);
    }

    public function logout(): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $user->currentAccessToken()?->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
