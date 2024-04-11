<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(DaysTableSeeder::class);
        $this->call(SecurityQuestionsSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(AcademicPeriodsTableSeeder::class);

        // App data seeders
        $this->call(RoomsTableSeeder::class);
        $this->call(TimeslotsTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(ProfessorsTableSeeder::class);
        $this->call(ClassesTableSeeder::class);
    }
}
