<?php

use Illuminate\Database\Seeder;
use App\Models\MasterTables\Occupation;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Occupation::create(['name' => 'No registra']);                                                                                                                                                                                                                                      
        Occupation::create(['name' => 'Panadero']);                                                                                                                                                                                                                                      
        Occupation::create(['name' => 'Albañil']);                                                                                                                                                                                                                                      
        Occupation::create(['name' => 'Carpintero']);                                                                                                                                                                                                                                      
        Occupation::create(['name' => 'Plomero o Fontanero']);                                                                                                                                                                                                                                      
        Occupation::create(['name' => 'Electricista']);                                                                                                                                                                                                                                      
        Occupation::create(['name' => 'Mecánico']);                                                                                                                                                                                                                                      
        Occupation::create(['name' => 'Herrero']);                                                                                                                                                                                                                                      
        Occupation::create(['name' => 'Artesano']);                                                                                                                                                                                                                                      
        Occupation::create(['name' => 'Cerrajero']);                                                                                                                                                                                                                                      
        Occupation::create(['name' => 'Trabajador']);                                                                                                                                                                                                                                      
        Occupation::create(['name' => 'Ama de casa']);                                                                                                                                                                                                                                      
        Occupation::create(['name' => 'Oficios varios']);                                                                                                                                                                                                                                      
    }
}
