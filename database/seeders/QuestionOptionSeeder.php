<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Database\Seeder;

class QuestionOptionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = Question::all();

        foreach ($questions as $question) {
            QuestionOption::create([
                'question_id' => $question->id,
                'option' => 'Sangat Baik',
                'score' => 100,
            ]);

            QuestionOption::create([
                'question_id' => $question->id,
                'option' => 'Baik',
                'score' => 80,
            ]);

            QuestionOption::create([
                'question_id' => $question->id,
                'option' => 'Cukup',
                'score' => 60,
            ]);

            QuestionOption::create([
                'question_id' => $question->id,
                'option' => 'Kurang',
                'score' => 40,
            ]);
        }
    }
}