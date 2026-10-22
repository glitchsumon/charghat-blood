<?php

namespace Tests\Feature;

use App\Models\BloodGroup;
use App\Models\DonorProfile;
use App\Models\Upazila;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DonorSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_donor_search_filters_by_blood_group(): void
    {
        $aPos = BloodGroup::query()->create(['name' => 'A+']);
        $oNeg = BloodGroup::query()->create(['name' => 'O-']);
        $upazila = Upazila::query()->create(['name' => 'Charghat', 'district' => 'Rajshahi']);

        $userA = User::factory()->create();
        DonorProfile::query()->create([
            'user_id' => $userA->id,
            'blood_group_id' => $aPos->id,
            'upazila_id' => $upazila->id,
            'approved_at' => now(),
        ]);

        $userO = User::factory()->create();
        DonorProfile::query()->create([
            'user_id' => $userO->id,
            'blood_group_id' => $oNeg->id,
            'upazila_id' => $upazila->id,
            'approved_at' => now(),
        ]);

        $response = $this->getJson('/api/v1/donors?blood_group_id='.$oNeg->id);

        $response->assertOk();
        $items = $response->json('data');
        $this->assertCount(1, $items);
        $this->assertSame('O-', $items[0]['blood_group']);
    }
}
