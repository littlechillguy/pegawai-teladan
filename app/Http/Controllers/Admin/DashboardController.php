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

        /*
        |--------------------------------------------------------------------------
        | Data Chart: Perbandingan Nilai Akhir Kandidat (Periode Aktif)
        |--------------------------------------------------------------------------
        */

        $candidateScores = $activePeriod
            ? Candidate::with('employee')
                ->where('period_id', $activePeriod->id)
                ->orderByDesc('final_score')
                ->get()
                ->map(function ($candidate) {
                    return [
                        'name' => $candidate->employee->name,
                        'score' => $candidate->final_score ?? 0,
                    ];
                })
            : collect();

        /*
        |--------------------------------------------------------------------------
        | Data Chart: Distribusi Pegawai per Pokja
        |--------------------------------------------------------------------------
        */

        $pokjaDistribution = Employee::where('status', 'active')
            ->selectRaw('pokja, count(*) as total')
            ->groupBy('pokja')
            ->orderByDesc('total')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Data Progress Penilaian per Kandidat (Periode Aktif)
        |--------------------------------------------------------------------------
        */

        $totalEvaluators = max($totalEmployees - 1, 1);

        $candidateProgress = $activePeriod
            ? Candidate::with('employee')
                ->where('period_id', $activePeriod->id)
                ->get()
                ->map(function ($candidate) use ($totalEvaluators) {
                    $submitted = Assessment::where('candidate_id', $candidate->id)
                        ->whereNotNull('submitted_at')
                        ->count();

                    $percentage = min(
                        round(($submitted / $totalEvaluators) * 100),
                        100
                    );

                    return [
                        'name' => $candidate->employee->name,
                        'submitted' => $submitted,
                        'total' => $totalEvaluators,
                        'percentage' => $percentage,
                    ];
                })
                ->sortByDesc('percentage')
                ->values()
            : collect();

        return view('admin.dashboard', compact(
            'activePeriod',
            'totalEmployees',
            'totalCandidates',
            'totalAssessments',
            'candidates',
            'assessedCandidateIds',
            'candidateScores',
            'pokjaDistribution',
            'candidateProgress'
        ));
    }
}