<?php

use Illuminate\Database\Seeder;
use App\Models\People\ContactType;

class ContactTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactType::create(['name' => 'Padre']);
        ContactType::create(['name' => 'Madre']);
        ContactType::create(['name' => 'Hijo']);
        ContactType::create(['name' => 'Nieto']);
        ContactType::create(['name' => 'Otros']);
    }
}
