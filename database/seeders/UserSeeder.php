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
        $admin = Employee::where('nip', 'EMP001')->first();

        User::create([
            'employee_id' => $admin->id,
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        $employees = Employee::where('nip', '!=', 'EMP001')
            ->get();

        foreach ($employees as $employee) {
            User::create([
                'employee_id' => $employee->id,
                'password' => Hash::make('password123'),
                'role' => 'employee',
            ]);
        }
    }
}