<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Employee;
use App\Models\Period;

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

        /*
        |--------------------------------------------------------------------------
        | Jumlah evaluator
        |--------------------------------------------------------------------------
        */

        $totalEvaluators = Employee::where('status', 'active')->count();

        /*
        |--------------------------------------------------------------------------
        | Hitung progress setiap kandidat
        |--------------------------------------------------------------------------
        */

        foreach ($candidates as $candidate) {

            // Kandidat tidak boleh menilai dirinya sendiri
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

                $candidate->assessment_progress = 0;

            }

            /*
            |--------------------------------------------------------------------------
            | Status kandidat
            |--------------------------------------------------------------------------
            */

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

        /*
        |--------------------------------------------------------------------------
        | Apakah seluruh kandidat sudah lengkap?
        |--------------------------------------------------------------------------
        */

        $allComplete = $candidates->isNotEmpty()
            && $candidates->every(function ($candidate) {

                return $candidate->attendance_percentage !== null
                    && $candidate->assessment_progress >= 100
                    && $candidate->final_score !== null;

            });

        return view('admin.assessment-results.index', compact(
            'activePeriod',
            'candidates',
            'totalEvaluators',
            'allComplete'
        ));
    }
}