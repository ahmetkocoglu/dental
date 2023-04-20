<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Ahmet Koçoğlu',
             'email' => 'akocoglu@gmail.com',
             'password' => bcrypt('12345678'),
             'email_verified_at' => now(),
             'status' => 1,
             'remember_token' => null,
             'created_at' => now(),
             'updated_at' => now(),
         ]);
    }
}
