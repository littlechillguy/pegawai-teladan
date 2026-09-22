<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Period;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
{
    $employee = Auth::user()->employee;

    $activePeriod = Period::where('status', 'active')->first();

    $candidates = $activePeriod
        ? Candidate::with('employee')
            ->where('period_id', $activePeriod->id)
            ->where('employee_id', '!=', $employee->id)
            ->latest()
            ->get()
        : collect();

    $assessedCandidateIds = $activePeriod
        ? \App\Models\Assessment::where('period_id', $activePeriod->id)
            ->where('evaluator_id', $employee->id)
            ->pluck('candidate_id')
            ->toArray()
        : [];

    return view('employee.dashboard', compact(
        'employee',
        'activePeriod',
        'candidates',
        'assessedCandidateIds'
    ));
}
}