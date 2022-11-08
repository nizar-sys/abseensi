<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Rayon;
use App\Models\Rombel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'uuid' => Str::uuid(),
            'name' => 'admin',
            'email' => 'nizarid04@gmail.com',
            'password' => Hash::make('password'),
            'created_at' => now()
        ]);

        Rayon::factory(100)->create();
        Rombel::factory(100)->create();
    }
}
