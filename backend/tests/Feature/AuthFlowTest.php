<?php

namespace Tests\Feature;

use App\Models\BloodGroup;
use App\Models\Upazila;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_request_verification_code(): void
    {
        $response = $this->postJson('/api/v1/auth/send-verification-code', [
            'email' => 'newuser@example.com',
        ]);

        $response->assertOk()->assertJsonPath('message', 'Verification code issued');
    }

    public function test_register_fails_with_invalid_verification_code(): void
    {
        $bloodGroup = BloodGroup::query()->create(['name' => 'A+']);
        $upazila = Upazila::query()->create(['name' => 'Charghat', 'district' => 'Rajshahi']);

        $response = $this->postJson('/api/v1/auth/register', [
            'name' => 'Demo User',
            'phone' => '01700000000',
            'email' => 'demo@example.com',
            'date_of_birth' => '1999-01-01',
            'blood_group_id' => $bloodGroup->id,
            'upazila_id' => $upazila->id,
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'verification_code' => '000000',
        ]);

        $response->assertStatus(422)->assertJsonPath('message', 'Invalid verification code');
    }
}
