<?php

use Illuminate\Database\Seeder;
use App\Models\MasterTables\TypePeople;

class TypePeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypePeople::create(['name' => 'Maestr@/Estudiante']);
        TypePeople::create(['name' => 'Egresad@']);
        TypePeople::create(['name' => 'Persona natural']);
        TypePeople::create(['name' => 'Voluntario/a']);
        TypePeople::create(['name' => 'Maestr@/Voluntario']);
        TypePeople::create(['name' => 'Secretari@']);
        TypePeople::create(['name' => 'Coordinador/a']);
        TypePeople::create(['name' => 'Contador/a']);
        TypePeople::create(['name' => 'Representante legal']);
    }
}
