<?php

namespace Database\Seeders;

use App\Models\BloodGroup;
use Illuminate\Database\Seeder;

class BloodGroupSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $index => $group) {
            BloodGroup::query()->updateOrCreate(['name' => $group], ['display_order' => $index]);
        }
    }
}
