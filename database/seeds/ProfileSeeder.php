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
        Profile::create(['name' => 'Administrador']);
        Profile::create(['name' => 'Maestro']);
        Profile::create(['name' => 'Estudiante']);
    }
}
