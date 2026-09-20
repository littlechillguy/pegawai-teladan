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
            'description' => 'Penilaian berdasarkan tingkat kehadiran pegawai.',
        ]);

        Criterion::create([
            'name' => 'Inovasi dan Kreativitas',
            'weight' => 20,
            'description' => 'Kemampuan pegawai dalam memberikan ide dan solusi kreatif.',
        ]);

        Criterion::create([
            'name' => 'Kemampuan Bekerja Sama',
            'weight' => 20,
            'description' => 'Kemampuan pegawai dalam bekerja sama dengan rekan kerja.',
        ]);

        Criterion::create([
            'name' => 'Penampilan Saat Bekerja',
            'weight' => 10,
            'description' => 'Penampilan dan kerapian pegawai saat bekerja.',
        ]);

        Criterion::create([
            'name' => 'Integritas',
            'weight' => 20,
            'description' => 'Kejujuran, tanggung jawab, dan sikap profesional pegawai.',
        ]);

        Criterion::create([
            'name' => 'Sasaran Kerja Pegawai',
            'weight' => 20,
            'description' => 'Pencapaian target dan sasaran kerja pegawai.',
        ]);
    }
}