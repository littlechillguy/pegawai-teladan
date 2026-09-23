<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criterion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CriterionController extends Controller
{
    public function index()
    {
        $criteria = Criterion::withCount('questions')
            ->orderBy('id')
            ->get();

        return view('admin.criteria.index', compact('criteria'));
    }

    /**
     * Update bobot semua kriteria sekaligus.
     * Total bobot wajib = 100%.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'weights' => ['required', 'array'],
            'weights.*' => ['required', 'numeric', 'min:0', 'max:100'],
        ], [
            'weights.*.required' => 'Bobot tidak boleh kosong.',
            'weights.*.numeric' => 'Bobot harus berupa angka.',
        ]);

        $totalWeight = collect($validated['weights'])->sum();

        // Validasi total harus tepat 100%
        if (round($totalWeight, 2) != 100) {
            return back()
                ->withInput()
                ->withErrors([
                    'weights' => "Total bobot harus 100%. Saat ini totalnya {$totalWeight}%.",
                ]);
        }

        foreach ($validated['weights'] as $criterionId => $weight) {
            Criterion::whereKey($criterionId)->update(['weight' => $weight]);
        }

        return redirect()
            ->route('admin.criteria.index')
            ->with('success', 'Bobot kriteria berhasil diperbarui.');
    }
}