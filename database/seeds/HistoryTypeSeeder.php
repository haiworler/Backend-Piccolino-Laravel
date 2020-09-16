<?php

use Illuminate\Database\Seeder;
use App\Models\People\HistoryType;
class HistoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HistoryType::create(['name' => 'Gestion']);
        HistoryType::create(['name' => 'Cargos']);
        HistoryType::create(['name' => 'Asignaturas']);
        HistoryType::create(['name' => 'Otros']);
    }
}
