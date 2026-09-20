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
            'name' => 'Admin Perusahaan',
            'department' => 'IT',
            'position' => 'Administrator',
            'photo' => null,
            'phone' => '081234567890',
            'status' => 'active',
        ]);

        Employee::create([
            'nip' => 'EMP002',
            'name' => 'Andi Pratama',
            'department' => 'IT',
            'position' => 'Staff IT',
            'photo' => null,
            'phone' => '081234567891',
            'status' => 'active',
        ]);

        Employee::create([
            'nip' => 'EMP003',
            'name' => 'Budi Santoso',
            'department' => 'Finance',
            'position' => 'Staff Finance',
            'photo' => null,
            'phone' => '081234567892',
            'status' => 'active',
        ]);

        Employee::create([
            'nip' => 'EMP004',
            'name' => 'Citra Lestari',
            'department' => 'HRD',
            'position' => 'Staff HRD',
            'photo' => null,
            'phone' => '081234567893',
            'status' => 'active',
        ]);

        Employee::create([
            'nip' => 'EMP005',
            'name' => 'Dimas Saputra',
            'department' => 'Marketing',
            'position' => 'Staff Marketing',
            'photo' => null,
            'phone' => '081234567894',
            'status' => 'active',
        ]);

        Employee::create([
            'nip' => 'EMP006',
            'name' => 'Eka Putri',
            'department' => 'Operations',
            'position' => 'Staff Operations',
            'photo' => null,
            'phone' => '081234567895',
            'status' => 'active',
        ]);
    }
}