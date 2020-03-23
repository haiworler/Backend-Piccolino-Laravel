<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user =  $user->create(['id' => 1,
        'name' => 'Admin',
        'email' => 'admin@piccolino.com',
        'email_verified_at' => now(),
        'profile_id'=> 1,
        'password' => Hash::make('111111'),
        'created_at' => now(),
        'updated_at' => now()]);
        $user->people()->attach(1);

    }
}
