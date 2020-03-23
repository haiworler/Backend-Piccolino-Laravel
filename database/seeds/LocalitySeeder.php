<?php

use Illuminate\Database\Seeder;
use App\Models\MasterTables\Locality;


class LocalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Locality::create(['name' => 'Usaquén','town_id'=>1]);
        Locality::create(['name' => 'Chapinero','town_id'=>1]);
        Locality::create(['name' => 'Santa Fe','town_id'=>1]);
        Locality::create(['name' => 'San Cristóbal','town_id'=>1]);
        Locality::create(['name' => 'Usme','town_id'=>1]);
        Locality::create(['name' => 'Tunjuelito','town_id'=>1]);
        Locality::create(['name' => 'Bosa','town_id'=>1]);
        Locality::create(['name' => 'Kennedy','town_id'=>1]);
        Locality::create(['name' => 'Fontibón','town_id'=>1]);
        Locality::create(['name' => 'Engativá','town_id'=>1]);
        Locality::create(['name' => 'Suba','town_id'=>1]);
        Locality::create(['name' => 'Barrios Unidos','town_id'=>1]);
        Locality::create(['name' => 'Teusaquillo','town_id'=>1]);
        Locality::create(['name' => 'Los Mártires','town_id'=>1]);
        Locality::create(['name' => 'Antonio Nariño','town_id'=>1]);
        Locality::create(['name' => 'Puente Aranda','town_id'=>1]);
        Locality::create(['name' => 'La Candelaria','town_id'=>1]);
        Locality::create(['name' => 'Rafael Uribe Uribe','town_id'=>1]);
        Locality::create(['name' => 'Ciudad Bolívar','town_id'=>1]);
        Locality::create(['name' => 'Sumapaz','town_id'=>1]);
    }
}
