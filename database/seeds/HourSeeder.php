<?php

use Illuminate\Database\Seeder;
use App\Models\Schools\Hour;

class HourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hour::create(['name' => 'Primera']);
        Hour::create(['name' => 'Segunda']);
        Hour::create(['name' => 'Tercera']);
        Hour::create(['name' => 'Cuarta']);
        Hour::create(['name' => 'Quinta']);
        Hour::create(['name' => 'Sexta']);
        Hour::create(['name' => 'Séptima']);
        Hour::create(['name' => 'Octava']);
        Hour::create(['name' => 'Descanso']);
    }
}
