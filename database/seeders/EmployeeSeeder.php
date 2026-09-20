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
            'name' => 'Andi Saputra',
            'department_id' => 1,
            'position_id' => 1,
            'golongan' => 'III/a',
            'status' => 'active',
        ]);

        Employee::create([
            'nip' => 'EMP002',
            'name' => 'Budi Santoso',
            'department_id' => 1,
            'position_id' => 2,
            'golongan' => 'III/b',
            'status' => 'active',
        ]);

        Employee::create([
            'nip' => 'EMP003',
            'name' => 'Citra Lestari',
            'department_id' => 2,
            'position_id' => 1,
            'golongan' => 'III/a',
            'status' => 'active',
        ]);

        Employee::create([
            'nip' => 'EMP004',
            'name' => 'Dedi Kurniawan',
            'department_id' => 3,
            'position_id' => 1,
            'golongan' => 'III/a',
            'status' => 'active',
        ]);

        Employee::create([
            'nip' => 'EMP005',
            'name' => 'Eka Pratama',
            'department_id' => 4,
            'position_id' => 3,
            'golongan' => 'III/c',
            'status' => 'active',
        ]);
    }
}