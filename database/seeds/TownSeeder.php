<?php

use Illuminate\Database\Seeder;
use App\Models\MasterTables\Town;

class TownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Town::create(['name' => 'Bogotá Distrito Capital (D. C.)','department_id' => 1]);
    }
}
