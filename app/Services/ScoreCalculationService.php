<?php

namespace App\Services;

use App\Models\Candidate;
use App\Models\Criterion;

class ScoreCalculationService
{
    /**
     * Menghitung nilai akhir kandidat.
     */
    public function calculate(Candidate $candidate): float
    {
        $breakdown = $this->breakdown($candidate);

        return $breakdown['final_score'];
    }

    /**
     * Menghasilkan rincian nilai berdasarkan setiap kriteria.
     */
    public function breakdown(Candidate $candidate): array
    {
        $candidate->load([
            'assessments.answers.question.criterion',
        ]);

        $criteria = Criterion::orderBy('id')->get();

        $details = [];
        $totalScore = 0;

        foreach ($criteria as $criterion) {

            // Kehadiran berasal dari input admin
            if (strtolower($criterion->name) === 'kehadiran') {

                $criterionScore = (float) $candidate->attendance_percentage;

            } else {

                $answers = $candidate->assessments
                    ->flatMap(function ($assessment) {
                        return $assessment->answers;
                    })
                    ->filter(function ($answer) use ($criterion) {
                        return $answer->question
                            && $answer->question->criterion_id == $criterion->id;
                    });

                if ($answers->isEmpty()) {
                    $criterionScore = 0;
                } else {
                    $criterionScore = (float) $answers->avg('score');
                }
            }

            // Nilai berbobot
            $weightedScore = $criterionScore * ((float) $criterion->weight / 100);

            $totalScore += $weightedScore;

            $details[] = [
                'criterion' => $criterion,
                'raw_score' => round($criterionScore, 2),
                'weight' => (float) $criterion->weight,
                'weighted_score' => round($weightedScore, 2),
            ];
        }

        return [
            'details' => $details,
            'final_score' => round($totalScore, 2),
        ];
    }
}