<?php

use Illuminate\Database\Seeder;
use App\Models\Schools\CostEnrolled;

class CostEnrolledSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CostEnrolled::create(['value' => '50000']);
    }
}
