<?php

namespace Database\Seeders;

use App\Models\Criterion;
use Illuminate\Database\Seeder;

class CriterionSeeder extends Seeder
{
    public function run(): void
    {
        Criterion::create([
            'name' => 'Kehadiran',
            'weight' => 10,
        ]);

        Criterion::create([
            'name' => 'Inovasi dan Kreativitas',
            'weight' => 20,
        ]);

        Criterion::create([
            'name' => 'Kemampuan Bekerja Sama',
            'weight' => 20,
        ]);

        Criterion::create([
            'name' => 'Penampilan Saat Bekerja',
            'weight' => 10,
        ]);

        Criterion::create([
            'name' => 'Integritas',
            'weight' => 20,
        ]);

        Criterion::create([
            'name' => 'Sasaran Kerja Pegawai',
            'weight' => 20,
        ]);
    }
}