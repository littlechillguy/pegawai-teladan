<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criterion;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function index(Criterion $criterion)
    {
        $criterion->load([
            'questions' => function ($query) {
                $query->orderBy('order');
            },
            'questions.options' => function ($query) {
                $query->orderByDesc('score');
            },
        ]);

        return view('admin.questions.index', compact('criterion'));
    }

    public function create(Criterion $criterion)
    {
        return view('admin.questions.create', compact('criterion'));
    }

    public function store(Request $request, Criterion $criterion)
    {
        $validated = $request->validate([
            'question' => ['required', 'string'],
            'order' => ['required', 'integer', 'min:1'],
            'is_active' => ['required', 'boolean'],

            'options' => ['required', 'array', 'min:2'],
            'options.*.option' => ['required', 'string', 'max:255'],
            'options.*.score' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        DB::transaction(function () use ($validated, $criterion) {

            $question = Question::create([
                'criterion_id' => $criterion->id,
                'question' => $validated['question'],
                'order' => $validated['order'],
                'is_active' => $validated['is_active'],
            ]);

            foreach ($validated['options'] as $option) {
                $question->options()->create([
                    'option' => $option['option'],
                    'score' => $option['score'],
                ]);
            }
        });

        return redirect()
            ->route('admin.questions.index', $criterion)
            ->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function edit(Question $question)
    {
        $question->load([
            'criterion',
            'options' => function ($query) {
                $query->orderByDesc('score');
            },
        ]);

        return view('admin.questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'question' => ['required', 'string'],
            'order' => ['required', 'integer', 'min:1'],
            'is_active' => ['required', 'boolean'],

            'options' => ['required', 'array', 'min:2'],
            'options.*.id' => ['required', 'exists:question_options,id'],
            'options.*.option' => ['required', 'string', 'max:255'],
            'options.*.score' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        DB::transaction(function () use ($validated, $question) {

            $question->update([
                'question' => $validated['question'],
                'order' => $validated['order'],
                'is_active' => $validated['is_active'],
            ]);

            foreach ($validated['options'] as $option) {

                $question->options()
                    ->where('id', $option['id'])
                    ->update([
                        'option' => $option['option'],
                        'score' => $option['score'],
                    ]);
            }
        });

        return redirect()
            ->route('admin.questions.index', $question->criterion_id)
            ->with('success', 'Pertanyaan berhasil diperbarui.');
    }
}