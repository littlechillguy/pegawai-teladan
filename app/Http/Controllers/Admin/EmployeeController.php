<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index()
    {
        $activePeriod = \App\Models\Period::where('status', 'active')->first();

        $employees = Employee::latest()->get();

        $candidateEmployeeIds = $activePeriod
            ? \App\Models\Candidate::where('period_id', $activePeriod->id)
                ->pluck('employee_id')
                ->toArray()
            : [];

        return view('admin.employees.index', compact(
            'employees',
            'activePeriod',
            'candidateEmployeeIds'
        ));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => [
                'required',
                'string',
                'max:255',
                'unique:employees,nip',
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'pokja' => [
                'required',
                'string',
                'max:255',
            ],
            'position' => [
                'required',
                'string',
                'max:255',
            ],
            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],
            'status' => [
                'required',
                Rule::in(['active', 'inactive']),
            ],
            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        DB::transaction(function () use ($request, $validated) {

            $photoPath = null;

            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')
                    ->store('employees', 'public');
            }

            $employee = Employee::create([
                'nip' => $validated['nip'],
                'name' => $validated['name'],
                'pokja' => $validated['pokja'],
                'position' => $validated['position'],
                'photo' => $photoPath,
                'phone' => $validated['phone'] ?? null,
                'status' => $validated['status'],
            ]);

            User::create([
                'employee_id' => $employee->id,
                'password' => Hash::make($validated['password']),
                'role' => 'employee',
            ]);
        });

        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'nip' => [
                'required',
                'string',
                'max:255',
                'unique:employees,nip,' . $employee->id,
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'pokja' => [
                'required',
                'string',
                'max:255',
            ],
            'position' => [
                'required',
                'string',
                'max:255',
            ],
            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],
            'status' => [
                'required',
                Rule::in(['active', 'inactive']),
            ],
            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        DB::transaction(function () use ($request, $validated, $employee) {

            $photoPath = $employee->photo;

            if ($request->hasFile('photo')) {

                if ($employee->photo) {
                    Storage::disk('public')->delete($employee->photo);
                }

                $photoPath = $request->file('photo')
                    ->store('employees', 'public');
            }

            $employee->update([
                'nip' => $validated['nip'],
                'name' => $validated['name'],
                'pokja' => $validated['pokja'],
                'position' => $validated['position'],
                'photo' => $photoPath,
                'phone' => $validated['phone'] ?? null,
                'status' => $validated['status'],
            ]);

            $user = $employee->user;

            if ($user) {

                $user->update([
                    'password' => !empty($validated['password'])
                        ? Hash::make($validated['password'])
                        : $user->password,
                ]);

            }
        });

        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function destroy(Employee $employee)
{
    // Hapus file foto dari storage kalau ada
    if ($employee->photo) {
        Storage::disk('public')->delete($employee->photo);
    }

    $name = $employee->name;

    // Hapus data pegawai. Berkat cascadeOnDelete di migration,
    // akun login, riwayat kandidat, dan riwayat penilaian
    // miliknya akan ikut terhapus otomatis.
    $employee->delete();

    return redirect()
        ->route('admin.employees.index')
        ->with('success', $name . ' berhasil dihapus secara permanen.');
}

    public function selectCandidate(Employee $employee)
    {
        $activePeriod = \App\Models\Period::where('status', 'active')->first();

        if (!$activePeriod) {
            return redirect()
                ->route('admin.employees.index')
                ->with('error', 'Belum ada periode aktif.');
        }

        if ($employee->status !== 'active') {
            return redirect()
                ->route('admin.employees.index')
                ->with('error', 'Pegawai tidak aktif tidak dapat menjadi kandidat.');
        }

        $alreadyCandidate = \App\Models\Candidate::where('period_id', $activePeriod->id)
            ->where('employee_id', $employee->id)
            ->exists();

        if ($alreadyCandidate) {
            return redirect()
                ->route('admin.employees.index')
                ->with('error', 'Pegawai tersebut sudah menjadi kandidat pada periode ini.');
        }

        \App\Models\Candidate::create([
            'period_id' => $activePeriod->id,
            'employee_id' => $employee->id,
            'attendance_percentage' => null,
            'final_score' => null,
            'is_winner' => false,
        ]);

        return redirect()
            ->route('admin.employees.index')
            ->with(
                'success',
                $employee->name . ' berhasil dipilih sebagai kandidat untuk ' . $activePeriod->name . '.'
            );
    }

    public function cancelCandidate(Employee $employee)
    {
        $activePeriod = \App\Models\Period::where('status', 'active')->first();

        if (!$activePeriod) {
            return redirect()
                ->route('admin.employees.index')
                ->with('error', 'Belum ada periode aktif.');
        }

        $candidate = \App\Models\Candidate::where('period_id', $activePeriod->id)
            ->where('employee_id', $employee->id)
            ->first();

        if (!$candidate) {
            return redirect()
                ->route('admin.employees.index')
                ->with('error', 'Pegawai tersebut bukan kandidat pada periode aktif.');
        }

        $hasAssessment = $candidate->assessments()
            ->whereNotNull('submitted_at')
            ->exists();

        if ($hasAssessment) {
            return redirect()
                ->route('admin.employees.index')
                ->with(
                    'error',
                    'Kandidat tidak dapat dibatalkan karena sudah memiliki penilaian.'
                );
        }

        $candidate->delete();

        return redirect()
            ->route('admin.employees.index')
            ->with(
                'success',
                $employee->name . ' berhasil dibatalkan sebagai kandidat.'
            );
    }
}