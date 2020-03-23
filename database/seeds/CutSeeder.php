<?php

use Illuminate\Database\Seeder;
use App\Models\MasterTables\Cut;

class CutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cut::create(['name' => 'Corte 1']);
        Cut::create(['name' => 'Corte 2']);
        Cut::create(['name' => 'Corte 3']);
    }
}
