<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)->create()->each(function($user) {
            $user->assignRole('Developer');
        });
        User::factory()->count(1)->create()->each(function($user) {
            $user->assignRole('Manager');
        });

        User::factory()->count(1)->create([
           'name'=>'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin'),
        ])->each(function ($admin) {
            $admin->assignRole('Admin');
        });

    }
}
