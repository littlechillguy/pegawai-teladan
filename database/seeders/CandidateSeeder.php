<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Employee;
use App\Models\Period;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    public function run(): void
    {
        $period = Period::where('name', 'Periode Juli - September 2026')->firstOrFail();

        $employees = Employee::where('nip', '!=', 'EMP001')
            ->where('status', 'active')
            ->get();

        foreach ($employees as $employee) {
            Candidate::create([
                'period_id' => $period->id,
                'employee_id' => $employee->id,
                'attendance_percentage' => 90,
                'final_score' => null,
                'is_winner' => false,
            ]);
        }
    }
}