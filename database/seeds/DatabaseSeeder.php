<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(TypePeopleSeeder::class);
         $this->call(CountrySeeder::class);
         $this->call(DepartmentSeeder::class);
         $this->call(TownSeeder::class);
         $this->call(LocalitySeeder::class);
         $this->call(NeighborhoodSeeder::class);
         $this->call(GenderSeeder::class);
         $this->call(OccupationSeeder::class);
         $this->call(TypeDocumentSeeder::class);
         $this->call(StateSeeder::class);
         $this->call(GradesSeeder::class);
         $this->call(CutSeeder::class);
         $this->call(PeopleSeeder::class);
         $this->call(ModuleSeeder::class);
         $this->call(ProfileSeeder::class);
         $this->call(UserSeeder::class);
         $this->call(DaySeeder::class);
         $this->call(HourSeeder::class);


    }
}
