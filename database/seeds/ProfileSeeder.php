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
        $profile->modules()->attach([1,14,15,17,18,19,20,25,27,28,29,32]);
        Profile::create(['name' => 'Maestr@/Estudiante']);
        Profile::create(['name' => 'Maestr@/Voluntario']);
    }
}
