<?php

namespace App\Services;

use App\Models\Candidate;
use App\Models\Employee;
use App\Models\Period;
use Illuminate\Support\Facades\DB;

class WinnerCalculationService
{
    public function determineWinner(Period $period): ?Candidate
    {
        // Ambil semua kandidat pada periode
        $candidates = Candidate::where('period_id', $period->id)
            ->get();

        // Tidak ada kandidat
        if ($candidates->isEmpty()) {
            return null;
        }

        // Jumlah evaluator = semua pegawai aktif
        $totalEvaluators = Employee::where('status', 'active')->count();

        // Setiap kandidat tidak boleh menilai dirinya sendiri
        $requiredAssessments = max(0, $totalEvaluators - 1);

        // Pastikan semua kandidat sudah mendapatkan seluruh penilaian
        foreach ($candidates as $candidate) {

            $submittedAssessments = $candidate->assessments()
                ->whereNotNull('submitted_at')
                ->count();

            if ($submittedAssessments < $requiredAssessments) {
                // Masih ada kandidat yang belum lengkap
                return null;
            }

            // Attendance harus sudah diisi
            if ($candidate->attendance_percentage === null) {
                return null;
            }

            // Nilai akhir harus sudah tersedia
            if ($candidate->final_score === null) {
                return null;
            }
        }

        // Cari kandidat dengan nilai tertinggi
        $highestScore = $candidates->max('final_score');

        // Cari semua kandidat yang memiliki nilai tertinggi
        $highestCandidates = $candidates
            ->where('final_score', $highestScore);

        // Kalau terjadi nilai seri, jangan menentukan winner
        if ($highestCandidates->count() > 1) {
            return null;
        }

        $winner = $highestCandidates->first();

        DB::transaction(function () use ($period, $winner) {

            // Pastikan hanya ada satu winner dalam periode
            Candidate::where('period_id', $period->id)
                ->update([
                    'is_winner' => false,
                ]);

            $winner->update([
                'is_winner' => true,
            ]);
        });

        return $winner->fresh([
            'employee',
            'period',
        ]);
    }
}