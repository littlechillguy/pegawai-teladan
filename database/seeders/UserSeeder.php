<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminEmployee = Employee::where('nip', 'EMP001')->first();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@pegawai.test',
            'password' => Hash::make('password'),
            'employee_id' => $adminEmployee->id,
            'role' => 'admin',
        ]);

        $evaluatorEmployee = Employee::where('nip', 'EMP002')->first();

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@pegawai.test',
            'password' => Hash::make('password'),
            'employee_id' => $evaluatorEmployee->id,
            'role' => 'evaluator',
        ]);
    }
}