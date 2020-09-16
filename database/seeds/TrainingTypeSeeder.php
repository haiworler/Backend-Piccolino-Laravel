<?php

use Illuminate\Database\Seeder;
use App\Models\People\TrainingType;

class TrainingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TrainingType::create(['name' => 'Primaria']);
        TrainingType::create(['name' => 'Bachillerato']);
        TrainingType::create(['name' => 'Técnico']);
        TrainingType::create(['name' => 'Tecnológico']);
        TrainingType::create(['name' => 'Profesional']);
        TrainingType::create(['name' => 'Especialización']);
        TrainingType::create(['name' => 'Maestría']);
        TrainingType::create(['name' => 'Doctorado']);
        TrainingType::create(['name' => 'Diplomado']);
        TrainingType::create(['name' => 'Otros']);
    }
}
