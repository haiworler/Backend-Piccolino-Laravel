<?php

use Illuminate\Database\Seeder;
use App\Models\MasterTables\Grade;

class GradesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grade::create(['name' => 'Primero','code'=>'0001']);
        Grade::create(['name' => 'Segundo','code'=>'0002']);
        Grade::create(['name' => 'Tercero','code'=>'0003']);
        Grade::create(['name' => 'Cuarto','code'=>'0004']);
        Grade::create(['name' => 'Quinto','code'=>'0005']);
        Grade::create(['name' => 'Sexto','code'=>'0006']);
        Grade::create(['name' => 'Septimo','code'=>'0007']);
        Grade::create(['name' => 'Octavo','code'=>'0008']);
        Grade::create(['name' => 'Noveno','code'=>'0009']);
        Grade::create(['name' => 'Decimo','code'=>'0010']);
        Grade::create(['name' => 'Once','code'=>'0011']);

    }
}
