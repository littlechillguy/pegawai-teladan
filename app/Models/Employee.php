<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'name',
        'pokja',
        'position',
        'photo',
        'phone',
        'status',
    ];

    /**
     * Akun login milik pegawai
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    /**
     * Kandidat yang pernah diikuti pegawai
     */
    public function candidates(): HasMany
    {
        return $this->hasMany(Candidate::class);
    }

    /**
     * Penilaian yang diberikan pegawai kepada kandidat
     */
    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class, 'evaluator_id');
    }
}