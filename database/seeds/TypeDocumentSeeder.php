<?php

use Illuminate\Database\Seeder;
use App\Models\MasterTables\TypeDocument;

class TypeDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeDocument::create(['name' => 'Cédula de ciudadanía']);
        TypeDocument::create(['name' => 'Registro Civil']);
        TypeDocument::create(['name' => 'Tarjeta de identidad']);
        TypeDocument::create(['name' => 'Menor sin identificación']);
        TypeDocument::create(['name' => 'Adulto sin identidad']);

    }
}
