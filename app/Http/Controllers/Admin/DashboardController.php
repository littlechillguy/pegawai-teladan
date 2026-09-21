<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Candidate;
use App\Models\Employee;
use App\Models\Period;

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

        return view('admin.dashboard', compact(
            'activePeriod',
            'totalEmployees',
            'totalCandidates',
            'totalAssessments'
        ));
    }
}