<?php

use Illuminate\Database\Seeder;
use App\Models\Schools\Day;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Day::create(['name' => 'Lunes']);
        Day::create(['name' => 'Martes']);
        Day::create(['name' => 'Miércoles']);
        Day::create(['name' => 'Jueves']);
        Day::create(['name' => 'Viernes']);
        Day::create(['name' => 'Sábado']);
        Day::create(['name' => 'Domingo']);
    }
}
