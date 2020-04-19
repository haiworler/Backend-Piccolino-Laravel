<?php

use Illuminate\Database\Seeder;
use App\Models\Security\Profile;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $profile = Profile::create(['name' => 'Administrador']);
       $profile->modules()->attach([2,3,5,6,7,8,13,15,16,17,20]);
        Profile::create(['name' => 'Maestro']);
        Profile::create(['name' => 'Estudiante']);
    }
}
