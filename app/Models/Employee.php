<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $fillable = [
        'nip',
        'name',
        'department_id',
        'position_id',
        'golongan',
        'status',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function candidates(): HasMany
    {
        return $this->hasMany(Candidate::class);
    }

    public function assessmentsAsEvaluator(): HasMany
    {
        return $this->hasMany(Assessment::class, 'evaluator_id');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}