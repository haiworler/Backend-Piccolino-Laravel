<?php

use Illuminate\Database\Seeder;
use App\Models\MasterTables\Neighborhood;

class NeighborhoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Neighborhood::create(['name' => 'Lisbora','locality_id' => 11]);
    }
}
