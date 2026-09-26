<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Candidate;
use App\Models\Period;
use App\Models\Question;
use App\Services\ScoreCalculationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AssessmentController extends Controller
{
    /**
     * Menampilkan halaman penilaian kandidat.
     */
    public function create(Candidate $candidate)
    {
        $employee = Auth::user()->employee;

        $activePeriod = Period::where('status', 'active')->first();

        if (!$activePeriod) {
            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'Tidak ada periode penilaian yang sedang aktif.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Voting sudah diselesaikan
        |--------------------------------------------------------------------------
        */

        if ($activePeriod->voting_completed) {
            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'Sesi voting pada periode ini sudah diselesaikan. Penilaian tidak dapat dilakukan lagi.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Pastikan kandidat berasal dari periode aktif
        |--------------------------------------------------------------------------
        */

        if ($candidate->period_id !== $activePeriod->id) {
            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'Kandidat tersebut tidak tersedia pada periode aktif.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Tidak boleh menilai diri sendiri
        |--------------------------------------------------------------------------
        */

        if ($candidate->employee_id === $employee->id) {
            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'Anda tidak dapat menilai diri sendiri.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Cek apakah sudah pernah menilai kandidat
        |--------------------------------------------------------------------------
        */

        $alreadyAssessed = Assessment::where('period_id', $activePeriod->id)
            ->where('candidate_id', $candidate->id)
            ->where('evaluator_id', $employee->id)
            ->exists();

        if ($alreadyAssessed) {
            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'Anda sudah memberikan penilaian untuk kandidat tersebut.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil pertanyaan aktif
        |--------------------------------------------------------------------------
        */

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

    /**
     * Menyimpan penilaian kandidat.
     */
    public function store(
        Request $request,
        Candidate $candidate,
        ScoreCalculationService $scoreCalculationService
    ) {
        $employee = Auth::user()->employee;

        $activePeriod = Period::where('status', 'active')->first();

        if (!$activePeriod) {
            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'Tidak ada periode penilaian yang sedang aktif.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Jangan izinkan penilaian setelah voting selesai
        |--------------------------------------------------------------------------
        */

        if ($activePeriod->voting_completed) {
            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'Sesi voting pada periode ini sudah diselesaikan. Penilaian tidak dapat dilakukan lagi.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Pastikan kandidat berasal dari periode aktif
        |--------------------------------------------------------------------------
        */

        if ($candidate->period_id !== $activePeriod->id) {
            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'Kandidat tersebut tidak tersedia pada periode aktif.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Tidak boleh menilai diri sendiri
        |--------------------------------------------------------------------------
        */

        if ($candidate->employee_id === $employee->id) {
            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'Anda tidak dapat menilai diri sendiri.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Cek apakah sudah pernah menilai
        |--------------------------------------------------------------------------
        */

        $alreadyAssessed = Assessment::where('period_id', $activePeriod->id)
            ->where('candidate_id', $candidate->id)
            ->where('evaluator_id', $employee->id)
            ->exists();

        if ($alreadyAssessed) {
            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'Anda sudah memberikan penilaian untuk kandidat tersebut.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil semua pertanyaan aktif
        |--------------------------------------------------------------------------
        */

        $questions = Question::with('options')
            ->where('is_active', true)
            ->orderBy('criterion_id')
            ->orderBy('order')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Validasi jawaban
        |--------------------------------------------------------------------------
        */

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

        /*
        |--------------------------------------------------------------------------
        | Simpan assessment
        |--------------------------------------------------------------------------
        */

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
        | Hitung ulang nilai akhir kandidat
        |--------------------------------------------------------------------------
        |
        | Nilai akhir menggunakan seluruh kriteria, termasuk:
        |
        | Kehadiran × bobot Kehadiran
        | + seluruh nilai assessment × bobot masing-masing
        |
        */

        $finalScore = $scoreCalculationService->calculate($candidate);

        $candidate->update([
            'final_score' => $finalScore,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Jangan menentukan winner di sini
        |--------------------------------------------------------------------------
        |
        | Winner hanya ditentukan ketika admin menekan
        | "Selesaikan Penilaian" pada halaman Hasil Penilaian.
        |
        */

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Penilaian berhasil dikirim.'
            );
    }
}