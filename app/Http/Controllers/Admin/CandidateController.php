<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Period;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index()
    {
        $activePeriod = Period::where('status', 'active')->first();

        $candidates = $activePeriod
            ? Candidate::with('employee')
                ->where('period_id', $activePeriod->id)
                ->orderBy('created_at', 'desc')
                ->get()
            : collect();

        return view('admin.candidates.index', compact(
            'activePeriod',
            'candidates'
        ));
    }

    public function edit(Candidate $candidate)
    {
        $candidate->load([
            'employee',
            'period',
        ]);

        return view('admin.candidates.edit', compact('candidate'));
    }

    public function update(Request $request, Candidate $candidate)
    {
        $validated = $request->validate([
            'attendance_percentage' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100',
            ],
        ]);

        $candidate->update([
            'attendance_percentage' =>
                $validated['attendance_percentage'] ?? null,
        ]);

        return redirect()
            ->route('admin.candidates.index')
            ->with(
                'success',
                'Data kandidat berhasil diperbarui.'
            );
    }
}