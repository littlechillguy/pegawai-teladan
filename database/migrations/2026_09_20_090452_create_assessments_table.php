<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('period_id')
                ->constrained('periods')
                ->cascadeOnDelete();

            $table->foreignId('candidate_id')
                ->constrained('candidates')
                ->cascadeOnDelete();

            $table->foreignId('evaluator_id')
                ->constrained('employees')
                ->cascadeOnDelete();

            $table->timestamp('submitted_at')->nullable();

            $table->timestamps();

            $table->unique([
                'period_id',
                'candidate_id',
                'evaluator_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};