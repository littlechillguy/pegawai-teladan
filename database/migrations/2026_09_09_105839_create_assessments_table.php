<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assessments', function (Blueprint $table) {
    $table->id();

    $table->foreignId('period_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->foreignId('candidate_id')
        ->constrained('candidates')
        ->cascadeOnDelete();

    $table->foreignId('evaluator_id')
        ->constrained('employees')
        ->cascadeOnDelete();

    $table->timestamps();

    $table->unique([
        'period_id',
        'candidate_id',
        'evaluator_id'
    ]);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
