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
        $period = Period::where(
            'name',
            'Periode Januari - Maret 2026'
        )->firstOrFail();

        $employees = Employee::where('nip', '!=', 'EMP001')
            ->where('status', 'active')
            ->get();

        foreach ($employees as $employee) {

            $isWinner = $employee->nip === 'EMP002';

            Candidate::create([
                'period_id' => $period->id,
                'employee_id' => $employee->id,
                'attendance_percentage' => 90,
                'final_score' => $isWinner ? 92.50 : 85.00,
                'is_winner' => $isWinner,
            ]);
        }
    }
}