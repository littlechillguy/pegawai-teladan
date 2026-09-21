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
        $employees = Employee::latest()->get();

        return view('admin.employees.index', compact('employees'));
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
            'department' => [
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
                'department' => $validated['department'],
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
        'department' => [
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
            'department' => $validated['department'],
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
}