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
        TypePeople::create(['name' => 'Estudiante']);
        TypePeople::create(['name' => 'Egresado']);
        TypePeople::create(['name' => 'Voluntario(General)']);
        TypePeople::create(['name' => 'Voluntario(Maestro)']);
        TypePeople::create(['name' => 'Representante legal']);
    }
}
