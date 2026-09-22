<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Candidate;
use App\Models\Period;
use App\Models\Question;
use App\Services\ScoreCalculationService;
use App\Services\WinnerCalculationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AssessmentController extends Controller
{
    public function create(Candidate $candidate)
    {
        $employee = Auth::user()->employee;

        $activePeriod = Period::where('status', 'active')->first();

        if (!$activePeriod) {
            abort(404, 'Tidak ada periode penilaian aktif.');
        }

        if ($candidate->period_id !== $activePeriod->id) {
            abort(404, 'Kandidat tidak tersedia pada periode aktif.');
        }

        if ($candidate->employee_id === $employee->id) {
            abort(403, 'Anda tidak dapat menilai diri sendiri.');
        }

        $alreadyAssessed = Assessment::where('period_id', $activePeriod->id)
            ->where('candidate_id', $candidate->id)
            ->where('evaluator_id', $employee->id)
            ->exists();

        if ($alreadyAssessed) {
            return redirect()
                ->route('dashboard')
                ->with('error', 'Anda sudah memberikan penilaian untuk kandidat tersebut.');
        }

        $questions = Question::with([
            'criterion',
            'options' => function ($query) {
                $query->orderByDesc('score');
            },
        ])
            ->where('is_active', true)
            ->orderBy('criterion_id')
            ->orderBy('order')
            ->get();

        return view('employee.assessments.create', compact(
            'employee',
            'activePeriod',
            'candidate',
            'questions'
        ));
    }

    public function store(
        Request $request,
        Candidate $candidate,
        ScoreCalculationService $scoreCalculationService,
        WinnerCalculationService $winnerCalculationService
    ) {
        $employee = Auth::user()->employee;

        $activePeriod = Period::where('status', 'active')->first();

        if (!$activePeriod) {
            abort(404, 'Tidak ada periode penilaian aktif.');
        }

        if ($candidate->period_id !== $activePeriod->id) {
            abort(404, 'Kandidat tidak tersedia pada periode aktif.');
        }

        if ($candidate->employee_id === $employee->id) {
            abort(403, 'Anda tidak dapat menilai diri sendiri.');
        }

        $alreadyAssessed = Assessment::where('period_id', $activePeriod->id)
            ->where('candidate_id', $candidate->id)
            ->where('evaluator_id', $employee->id)
            ->exists();

        if ($alreadyAssessed) {
            return redirect()
                ->route('dashboard')
                ->with('error', 'Anda sudah memberikan penilaian untuk kandidat tersebut.');
        }

        $questions = Question::with('options')
            ->where('is_active', true)
            ->get();

        $request->validate([
            'answers' => ['required', 'array'],
        ]);

        $answers = $request->input('answers', []);

        foreach ($questions as $question) {

            if (!isset($answers[$question->id])) {
                throw ValidationException::withMessages([
                    'answers' => 'Semua pertanyaan wajib dijawab.',
                ]);
            }

            $optionExists = $question->options
                ->where('id', $answers[$question->id])
                ->isNotEmpty();

            if (!$optionExists) {
                throw ValidationException::withMessages([
                    'answers' => 'Terdapat pilihan jawaban yang tidak valid.',
                ]);
            }
        }

        DB::transaction(function () use (
            $activePeriod,
            $candidate,
            $employee,
            $questions,
            $answers
        ) {

            $assessment = Assessment::create([
                'period_id' => $activePeriod->id,
                'candidate_id' => $candidate->id,
                'evaluator_id' => $employee->id,
                'submitted_at' => now(),
            ]);

            foreach ($questions as $question) {

                $option = $question->options
                    ->where('id', $answers[$question->id])
                    ->first();

                $assessment->answers()->create([
                    'question_id' => $question->id,
                    'question_option_id' => $option->id,
                    'score' => $option->score,
                ]);
            }
        });

        /*
        |--------------------------------------------------------------------------
        | Hitung ulang nilai kandidat
        |--------------------------------------------------------------------------
        */

        $finalScore = $scoreCalculationService->calculate($candidate);

        $candidate->update([
            'final_score' => $finalScore,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Cek apakah semua kandidat sudah selesai
        |--------------------------------------------------------------------------
        */

        $winner = $winnerCalculationService->determineWinner($activePeriod);

        if ($winner) {
            return redirect()
                ->route('dashboard')
                ->with(
                    'success',
                    'Penilaian berhasil dikirim. Seluruh penilaian telah selesai dan '
                    . $winner->employee->name
                    . ' ditetapkan sebagai Pegawai Teladan.'
                );
        }

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Penilaian berhasil dikirim.'
            );
    }
}