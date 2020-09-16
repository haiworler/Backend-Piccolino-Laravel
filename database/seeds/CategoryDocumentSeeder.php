<?php

use Illuminate\Database\Seeder;
use App\Models\People\CategoryDocument;

class CategoryDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryDocument::create(['name' => 'Certificado']);
        CategoryDocument::create(['name' => 'Otros']);
    }
}
