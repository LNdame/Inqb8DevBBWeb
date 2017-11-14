<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's clear the users table first
        // User::truncate();

        $faker = \Faker\Factory::create();

        // Let's make sure everyone has the same password and
        // let's hash it before the loop, or else our seeder
        // will be too slow.
        $password = Hash::make('test');
        $admin_user = Hash::make('beerly_bru');
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Beerly',
            'username' => 'admin',
            'email' => 'admin@beerly.co.za',
            'password' => $admin_user,
        ]);

        // And now let's generate a few dozen users for our app:
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'first_name' => $faker->name,
                'last_name' => $faker->name,
                'username' => $faker->name,
                'email' => $faker->email,

                'password' => $password,
            ]);
        }
    }
}
