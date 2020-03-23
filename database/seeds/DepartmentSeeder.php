<?php

use Illuminate\Database\Seeder;
use App\Models\MasterTables\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create(['name' => 'Cundinamarca', 'country_id' => 1]);

    }
}
