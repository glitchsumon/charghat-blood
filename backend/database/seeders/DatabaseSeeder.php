<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BloodGroupSeeder::class,
            UpazilaSeeder::class,
            AppSettingSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@charghatblood.test',
            'role' => 'admin',
            'phone' => '01700000000',
        ]);
    }
}
