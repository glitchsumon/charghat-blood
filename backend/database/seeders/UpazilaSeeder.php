<?php

namespace Database\Seeders;

use App\Models\Upazila;
use Illuminate\Database\Seeder;

class UpazilaSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Charghat', 'Bagha', 'Puthia', 'Boalia', 'Tanore'] as $name) {
            Upazila::query()->updateOrCreate(['name' => $name, 'district' => 'Rajshahi']);
        }
    }
}
