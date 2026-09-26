<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Candidate;
use App\Models\Employee;
use App\Models\Period;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $activePeriod = Period::where('status', 'active')->first();

        $totalEmployees = Employee::where('status', 'active')->count();

        $totalCandidates = $activePeriod
            ? Candidate::where('period_id', $activePeriod->id)->count()
            : 0;

        $totalAssessments = $activePeriod
            ? Assessment::where('period_id', $activePeriod->id)
                ->whereNotNull('submitted_at')
                ->count()
            : 0;

        /*
        |--------------------------------------------------------------------------
        | Kandidat untuk Vote Admin
        |--------------------------------------------------------------------------
        */

        $employee = Auth::user()->employee;

        $candidates = $activePeriod
            ? Candidate::with('employee')
                ->where('period_id', $activePeriod->id)
                ->where('employee_id', '!=', $employee->id)
                ->latest()
                ->get()
            : collect();

        /*
        |--------------------------------------------------------------------------
        | Kandidat yang sudah dinilai oleh Admin
        |--------------------------------------------------------------------------
        */

        $assessedCandidateIds = $activePeriod
            ? Assessment::where('period_id', $activePeriod->id)
                ->where('evaluator_id', $employee->id)
                ->whereNotNull('submitted_at')
                ->pluck('candidate_id')
                ->toArray()
            : [];

        return view('admin.dashboard', compact(
            'activePeriod',
            'totalEmployees',
            'totalCandidates',
            'totalAssessments',
            'candidates',
            'assessedCandidateIds'
        ));
    }
}