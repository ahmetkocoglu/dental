<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = \App\Models\User::create([
             'name' => 'Ahmet Koçoğlu',
             'email' => 'akocoglu@gmail.com',
             'password' => bcrypt('12345678'),
             'email_verified_at' => now(),
             'status' => 1,
             'remember_token' => null,
             'created_at' => now(),
             'updated_at' => now(),
         ]);


        $role = Role::create(['name' => 'Clinic']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);

        $role = Role::create(['name' => 'Super Clinic']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        \App\Models\Clinic::factory(2)->create();
        \App\Models\Doctor::factory(100)->create();
        \App\Models\Treatment::factory(100)->create();
    }
}
