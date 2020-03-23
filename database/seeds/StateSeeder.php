<?php

use Illuminate\Database\Seeder;
use App\Models\MasterTables\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::create(['name' => 'Activo']);
        State::create(['name' => 'Inactivo']);


    }
}
