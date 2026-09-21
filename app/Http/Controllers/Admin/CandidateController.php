<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Employee;
use App\Models\Period;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CandidateController extends Controller
{
    public function index()
    {
        $periods = Period::orderBy('start_date', 'desc')->get();

        $activePeriod = Period::where('status', 'active')->first();

        $candidates = $activePeriod
            ? Candidate::with('employee')
                ->where('period_id', $activePeriod->id)
                ->latest()
                ->get()
            : collect();

        return view('admin.candidates.index', compact(
            'periods',
            'activePeriod',
            'candidates'
        ));
    }

    public function create()
    {
        $activePeriod = Period::where('status', 'active')->first();

        if (!$activePeriod) {
            return redirect()
                ->route('admin.candidates.index')
                ->with('error', 'Belum ada periode aktif.');
        }

        $selectedEmployeeIds = Candidate::where('period_id', $activePeriod->id)
            ->pluck('employee_id');

        $employees = Employee::where('status', 'active')
            ->whereNotIn('id', $selectedEmployeeIds)
            ->orderBy('name')
            ->get();

        return view('admin.candidates.create', compact(
            'activePeriod',
            'employees'
        ));
    }

    public function store(Request $request)
    {
        $activePeriod = Period::where('status', 'active')->first();

        if (!$activePeriod) {
            return redirect()
                ->route('admin.candidates.index')
                ->with('error', 'Belum ada periode aktif.');
        }

        $validated = $request->validate([
            'employee_id' => ['required', 'exists:employees,id'],
            'attendance_percentage' => [
                'required',
                'numeric',
                'min:0',
                'max:100',
            ],
        ]);

        $alreadyCandidate = Candidate::where('period_id', $activePeriod->id)
            ->where('employee_id', $validated['employee_id'])
            ->exists();

        if ($alreadyCandidate) {
            throw ValidationException::withMessages([
                'employee_id' => 'Pegawai tersebut sudah menjadi kandidat pada periode ini.',
            ]);
        }

        Candidate::create([
            'period_id' => $activePeriod->id,
            'employee_id' => $validated['employee_id'],
            'attendance_percentage' => $validated['attendance_percentage'],
            'final_score' => null,
            'is_winner' => false,
        ]);

        return redirect()
            ->route('admin.candidates.index')
            ->with('success', 'Kandidat berhasil ditambahkan.');
    }

    public function edit(Candidate $candidate)
    {
        $candidate->load('employee', 'period');

        return view('admin.candidates.edit', compact('candidate'));
    }

    public function update(Request $request, Candidate $candidate)
    {
        $validated = $request->validate([
            'attendance_percentage' => [
                'required',
                'numeric',
                'min:0',
                'max:100',
            ],
        ]);

        $candidate->update([
            'attendance_percentage' => $validated['attendance_percentage'],
        ]);

        return redirect()
            ->route('admin.candidates.index')
            ->with('success', 'Data kandidat berhasil diperbarui.');
    }
}