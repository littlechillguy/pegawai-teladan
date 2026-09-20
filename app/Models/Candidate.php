<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'period_id',
        'employee_id',
        'attendance_percentage',
        'final_score',
        'is_winner',
    ];

    protected function casts(): array
    {
        return [
            'attendance_percentage' => 'decimal:2',
            'final_score' => 'decimal:2',
            'is_winner' => 'boolean',
        ];
    }

    /**
     * Kandidat ini berada pada periode tertentu
     */
    public function period(): BelongsTo
    {
        return $this->belongsTo(Period::class);
    }

    /**
     * Kandidat ini adalah seorang pegawai
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Penilaian yang diterima kandidat
     */
    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class);
    }
}