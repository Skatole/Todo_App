<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use function Sodium\increment;

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
        User::factory()->count(2)->create()->each(function($user) {
            $user->assignRole('Manager');
        });

        User::factory()->count(1)->create([
           'name'=>'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin'),
        ])->each(function ($admin) {
            $admin->assignRole('Admin');
        });

        foreach (range(1, 10) as $index) {
        $randomNum = rand(11, 12);
        $post_id = 1;
        $ref_id = 1;
        if ($randomNum !== $index) {
            $ref_id = $randomNum;
        }
        DB::table('post_user')->insert([
            'user_id' => $index,
            'reference_id' => $ref_id,
            'post_id' => $index,
        ]);
        }





    }
}
