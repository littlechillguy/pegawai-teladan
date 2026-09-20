<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessment_answers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('assessment_id')
                ->constrained('assessments')
                ->cascadeOnDelete();

            $table->foreignId('question_id')
                ->constrained('questions')
                ->cascadeOnDelete();

            $table->foreignId('question_option_id')
                ->constrained('question_options')
                ->cascadeOnDelete();

            $table->decimal('score', 5, 2);

            $table->timestamps();

            $table->unique([
                'assessment_id',
                'question_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_answers');
    }
};