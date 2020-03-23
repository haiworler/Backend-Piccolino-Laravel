<?php

use Illuminate\Database\Seeder;
use App\Models\MasterTables\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create(['name' => 'Colombia']);
    }
}
