<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            EmployeeSeeder::class,
            UserSeeder::class,
            PeriodSeeder::class,
            CriterionSeeder::class,
            QuestionSeeder::class,
            QuestionOptionSeeder::class,
            CandidateSeeder::class,
        ]);
    }
}