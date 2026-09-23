<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class PeriodController extends Controller
{
    public function index()
    {
        $periods = Period::orderBy('start_date', 'desc')->get();

        return view('admin.periods.index', compact('periods'));
    }

    public function create()
    {
        return view('admin.periods.create');
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'start_date' => ['required', 'date'],
        'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        'status' => [
            'required',
            Rule::in(['upcoming', 'active', 'completed']),
        ],
    ]);

    DB::transaction(function () use ($validated) {

        // Kalau periode baru ini langsung diset "aktif",
        // nonaktifkan periode lain yang sedang aktif.
        if ($validated['status'] === 'active') {
            Period::where('status', 'active')
                ->update(['status' => 'completed']);
        }

        Period::create($validated);
    });

    return redirect()
        ->route('admin.periods.index')
        ->with('success', 'Periode berhasil ditambahkan.');
}

    public function edit(Period $period)
    {
        return view('admin.periods.edit', compact('period'));
    }

   public function update(Request $request, Period $period)
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'start_date' => ['required', 'date'],
        'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        'status' => [
            'required',
            Rule::in(['upcoming', 'active', 'completed']),
        ],
    ]);

    DB::transaction(function () use ($validated, $period) {

        // Kalau periode ini diset "aktif", nonaktifkan
        // periode lain (selain dirinya sendiri) yang sedang aktif.
        if ($validated['status'] === 'active') {
            Period::where('status', 'active')
                ->where('id', '!=', $period->id)
                ->update(['status' => 'completed']);
        }

        $period->update($validated);
    });

    return redirect()
        ->route('admin.periods.index')
        ->with('success', 'Periode berhasil diperbarui.');
}

public function destroy(Period $period)
{
    $hasCandidates = $period->candidates()->exists();

    if ($hasCandidates) {
        return redirect()
            ->route('admin.periods.index')
            ->with(
                'error',
                'Periode "' . $period->name . '" tidak dapat dihapus karena sudah memiliki data kandidat.'
            );
    }

    $name = $period->name;

    $period->delete();

    return redirect()
        ->route('admin.periods.index')
        ->with('success', 'Periode "' . $name . '" berhasil dihapus.');
}
}