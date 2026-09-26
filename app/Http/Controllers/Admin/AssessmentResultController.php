<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Employee;
use App\Models\Period;
use App\Services\ScoreCalculationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class AssessmentResultController extends Controller
{
    public function index()
    {
        $activePeriod = Period::where('status', 'active')->first();

        if (!$activePeriod) {
            return view('admin.assessment-results.index', [
                'activePeriod' => null,
                'candidates' => collect(),
                'totalEvaluators' => 0,
                'allComplete' => false,
            ]);
        }

        $candidates = Candidate::with('employee')
            ->withCount([
                'assessments as submitted_assessments_count' => function ($query) {
                    $query->whereNotNull('submitted_at');
                }
            ])
            ->where('period_id', $activePeriod->id)
            ->orderByDesc('final_score')
            ->get();

        $totalEvaluators = Employee::where('status', 'active')->count();

        foreach ($candidates as $candidate) {

            $candidate->total_evaluators = max(
                0,
                $totalEvaluators - 1
            );

            if ($candidate->total_evaluators > 0) {

                $candidate->assessment_progress = round(
                    (
                        $candidate->submitted_assessments_count
                        / $candidate->total_evaluators
                    ) * 100
                );

            } else {

                $candidate->assessment_progress = 100;
            }

            if ($candidate->attendance_percentage === null) {

                $candidate->result_status = 'attendance';

            } elseif ($candidate->assessment_progress < 100) {

                $candidate->result_status = 'assessment';

            } elseif ($candidate->final_score === null) {

                $candidate->result_status = 'calculation';

            } elseif ($candidate->is_winner) {

                $candidate->result_status = 'winner';

            } else {

                $candidate->result_status = 'complete';
            }
        }

        $allComplete = $candidates->isNotEmpty()
            && $candidates->every(function ($candidate) {
                return $candidate->attendance_percentage !== null
                    && $candidate->assessment_progress >= 100
                    && $candidate->final_score !== null;
            });

        return view(
            'admin.assessment-results.index',
            compact(
                'activePeriod',
                'candidates',
                'totalEvaluators',
                'allComplete'
            )
        );
    }


    public function show(
        Candidate $candidate,
        ScoreCalculationService $scoreCalculationService
    ) {
        $candidate->load([
            'employee',
            'period',
        ]);

        $employees = Employee::where('status', 'active')
            ->where('id', '!=', $candidate->employee_id)
            ->orderBy('name')
            ->get();

        $submittedEvaluatorIds = $candidate->assessments()
            ->whereNotNull('submitted_at')
            ->pluck('evaluator_id')
            ->toArray();

        $pendingEvaluators = $employees->whereNotIn(
            'id',
            $submittedEvaluatorIds
        );

        $result = $scoreCalculationService->breakdown($candidate);

        return view('admin.assessment-results.show', [
            'candidate' => $candidate,
            'details' => $result['details'],
            'finalScore' => $result['final_score'],
            'pendingEvaluators' => $pendingEvaluators,
            'submittedEvaluatorIds' => $submittedEvaluatorIds,
        ]);
    }


    /**
     * Menutup sesi voting/penilaian.
     *
     * Catatan:
     * - Data penilaian boleh belum lengkap.
     * - Periode tetap berstatus active.
     * - voting_completed menjadi true.
     * - Pemenang ditentukan dari final_score tertinggi
     *   jika nilainya tersedia dan tidak seri.
     */
    public function complete(Period $period): RedirectResponse
{
    if ($period->status !== 'active') {
        return redirect()
            ->route('admin.assessment-results.index')
            ->with(
                'error',
                'Periode tersebut tidak sedang aktif.'
            );
    }

    if ($period->voting_completed) {
        return redirect()
            ->route('admin.assessment-results.index')
            ->with(
                'error',
                'Sesi voting pada periode ini sudah diselesaikan.'
            );
    }

    $candidates = Candidate::where(
        'period_id',
        $period->id
    )->get();

    /*
    |--------------------------------------------------------------------------
    | Harus ada kandidat
    |--------------------------------------------------------------------------
    */

    if ($candidates->isEmpty()) {
        return redirect()
            ->route('admin.assessment-results.index')
            ->with(
                'error',
                'Sesi voting tidak dapat diselesaikan karena belum ada kandidat.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Ambil kandidat yang sudah memiliki nilai akhir
    |--------------------------------------------------------------------------
    */

    $candidatesWithScore = $candidates->filter(function ($candidate) {
        return $candidate->final_score !== null;
    });

    /*
    |--------------------------------------------------------------------------
    | Semua kandidat belum memiliki nilai
    |--------------------------------------------------------------------------
    */

    if ($candidatesWithScore->isEmpty()) {
        return redirect()
            ->route('admin.assessment-results.index')
            ->with(
                'error',
                'Sesi voting tidak dapat diselesaikan karena belum ada kandidat yang memiliki nilai akhir.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Cari nilai tertinggi
    |--------------------------------------------------------------------------
    */

    $highestScore = $candidatesWithScore->max('final_score');

    $topCandidates = $candidatesWithScore->filter(
        function ($candidate) use ($highestScore) {
            return (float) $candidate->final_score ===
                (float) $highestScore;
        }
    );

    /*
    |--------------------------------------------------------------------------
    | Jika nilai tertinggi sama
    |--------------------------------------------------------------------------
    */

    if ($topCandidates->count() > 1) {

        $names = $topCandidates
            ->map(function ($candidate) {
                return $this->candidateName($candidate);
            })
            ->implode(', ');

        return redirect()
            ->route('admin.assessment-results.index')
            ->with(
                'error',
                'Sesi voting tidak dapat diselesaikan karena nilai tertinggi sama antara: ' .
                $names .
                '.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Tentukan pemenang
    |--------------------------------------------------------------------------
    */

    $winner = $topCandidates->first();

    /*
    |--------------------------------------------------------------------------
    | Simpan hasil
    |--------------------------------------------------------------------------
    */

    DB::transaction(function () use ($period, $winner) {

        Candidate::where(
            'period_id',
            $period->id
        )->update([
            'is_winner' => false,
        ]);

        $winner->update([
            'is_winner' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Voting selesai, tetapi periode tetap ACTIVE
        |--------------------------------------------------------------------------
        */

        $period->update([
            'voting_completed' => true,
        ]);
    });

    return redirect()
        ->route('admin.assessment-results.index')
        ->with(
            'success',
            'Sesi voting periode "' .
            $period->name .
            '" berhasil diselesaikan. ' .
            $this->candidateName($winner) .
            ' ditetapkan sebagai Pegawai Teladan dengan nilai ' .
            number_format($winner->final_score, 2) .
            '.'
        );
}


    /**
     * Mendapatkan nama kandidat.
     */
    private function candidateName(Candidate $candidate): string
    {
        if (!$candidate->relationLoaded('employee')) {
            $candidate->load('employee');
        }

        return $candidate->employee?->name ?? 'Kandidat';
    }
}