<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        Employee::create([
            'nip' => 'EMP001',
            'name' => 'Admin Perusahaan IT',
            'pokja' => 'IT',
            'position' => 'Administrator',
            'photo' => null,
            'phone' => '081234567890',
            'status' => 'active',
        ]);

        Employee::create([
            'nip' => 'EMP002',
            'name' => 'Andi Pratama',
            'pokja' => 'IT',
            'position' => 'Staff IT',
            'photo' => null,
            'phone' => '081234567891',
            'status' => 'active',
        ]);

        Employee::create([
            'nip' => 'EMP003',
            'name' => 'Budi Santoso',
            'pokja' => 'Keuangan',
            'position' => 'Staff Keuangan',
            'photo' => null,
            'phone' => '081234567892',
            'status' => 'active',
        ]);

        Employee::create([
            'nip' => 'EMP004',
            'name' => 'Citra Lestari',
            'pokja' => 'SDM',
            'position' => 'Staff SDM',
            'photo' => null,
            'phone' => '081234567893',
            'status' => 'active',
        ]);

        Employee::create([
            'nip' => 'EMP005',
            'name' => 'Dimas Saputra',
            'pokja' => 'Humas',
            'position' => 'Staff Humas',
            'photo' => null,
            'phone' => '081234567894',
            'status' => 'active',
        ]);

        Employee::create([
            'nip' => 'EMP006',
            'name' => 'Eka Putri',
            'pokja' => 'Operasional',
            'position' => 'Staff Operasional',
            'photo' => null,
            'phone' => '081234567895',
            'status' => 'active',
        ]);
    }
}