<?php

use Illuminate\Database\Seeder;
use App\Models\MasterTables\Gender;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gender::create(['name' => 'Masculino']);
        Gender::create(['name' => 'Femenino']);
    }
}
