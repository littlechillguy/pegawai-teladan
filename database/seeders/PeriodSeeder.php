<?php

namespace Database\Seeders;

use App\Models\Period;
use Illuminate\Database\Seeder;

class PeriodSeeder extends Seeder
{
    public function run(): void
    {
        Period::create([
            'name' => 'Periode Januari - Maret 2026',
            'start_date' => '2026-01-01',
            'end_date' => '2026-03-31',
            'status' => 'completed',
        ]);

        Period::create([
            'name' => 'Periode April - Juni 2026',
            'start_date' => '2026-04-01',
            'end_date' => '2026-06-30',
            'status' => 'completed',
        ]);

        Period::create([
            'name' => 'Periode Juli - September 2026',
            'start_date' => '2026-07-01',
            'end_date' => '2026-09-30',
            'status' => 'active',
        ]);

        Period::create([
            'name' => 'Periode Oktober - Desember 2026',
            'start_date' => '2026-10-01',
            'end_date' => '2026-12-31',
            'status' => 'upcoming',
        ]);
    }
}