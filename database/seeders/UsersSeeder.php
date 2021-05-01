<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
    }
}
