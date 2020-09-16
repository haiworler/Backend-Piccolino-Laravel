<?php

use Illuminate\Database\Seeder;
use App\Models\People\People;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        People::create([
            'names' => 'Luis Eduardo',
            'surnames' => 'Garizabalo Acosta',
            'type_document_id' => 1,
            'document_number' => '1082400585',
            'birth_date' => '1997-11-11',
            'birth_town_id' => 1,
            'gender_id' => 1,
            'phone' => null,
            'cell' => '3204781884',
            'email'  => 'Luisf5@hotmail.com.ar',
            'address_residence' => 'Carrera 113C # 47',
            'neighborhood_id' => 1,
            'occupation_id' => 1,
            'rh' => 'O+',
            'eps' => 'Nueva EPS',
            'observations' => null,
            'stratum' => 3,
            'level_sisben' => null,
            'type_people_id' => 5,
            'history' => null,
        ]);                                                                                                                                                                                                                                      
    }
}
