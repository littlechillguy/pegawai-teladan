<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeriodController extends Controller
{
    /**
     * Menampilkan semua periode.
     */
    public function index()
    {
        $periods = Period::orderBy('start_date', 'desc')->get();

        return view('admin.periods.index', compact('periods'));
    }

    /**
     * Form tambah periode.
     */
    public function create()
    {
        return view('admin.periods.create');
    }

    /**
     * Membuat periode baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'start_date' => ['required', 'date'],

            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],
        ]);

        /*
         * Periode baru tidak langsung mengambil alih
         * periode aktif yang sedang berjalan.
         *
         * Jika sudah ada periode aktif:
         *     periode baru = upcoming
         *
         * Jika belum ada periode aktif:
         *     periode baru bisa menjadi active apabila
         *     tanggal mulai sudah tiba.
         */
        $hasActivePeriod = Period::where('status', 'active')->exists();

        $startDate = Carbon::parse($validated['start_date']);
        $today = Carbon::today();

        if ($hasActivePeriod) {
            $status = 'upcoming';
        } else {
            $status = $startDate->greaterThan($today)
                ? 'upcoming'
                : 'active';
        }

        Period::create([
            'name' => $validated['name'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => $status,
        ]);

        return redirect()
            ->route('admin.periods.index')
            ->with('success', 'Periode berhasil ditambahkan.');
    }

    /**
     * Form edit periode.
     */
    public function edit(Period $period)
    {
        return view('admin.periods.edit', compact('period'));
    }

    /**
     * Update periode.
     *
     * Status tidak diubah melalui form edit.
     */
    public function update(Request $request, Period $period)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'start_date' => ['required', 'date'],

            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],
        ]);

        $period->update([
            'name' => $validated['name'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
        ]);

        return redirect()
            ->route('admin.periods.index')
            ->with('success', 'Periode berhasil diperbarui.');
    }

    /**
     * Mengaktifkan periode upcoming.
     */
    public function activate(Period $period)
{
    if ($period->status === 'active') {
        return redirect()
            ->route('admin.periods.index')
            ->with('error', 'Periode "' . $period->name . '" sudah aktif.');
    }

    $activePeriod = Period::where('status', 'active')
        ->where('id', '!=', $period->id)
        ->first();

    DB::transaction(function () use ($activePeriod, $period) {

        // Nonaktifkan periode yang sedang aktif
        if ($activePeriod) {

            $hasWinner = $activePeriod->candidates()
                ->where('is_winner', true)
                ->exists();

            $activePeriod->update([
                'status' => $hasWinner
                    ? 'completed'
                    : 'upcoming',
            ]);
        }

        // Hanya mengubah status periode yang dipilih
        // DATA LAIN TIDAK DIUBAH
        $period->update([
            'status' => 'active',
        ]);
    });

    return redirect()
        ->route('admin.periods.index')
        ->with(
            'success',
            'Periode "' . $period->name . '" berhasil diaktifkan untuk melihat data.'
        );
}

    /**
     * Menghapus periode.
     */
    public function destroy(Period $period)
    {
        /*
         * Periode yang sudah memiliki kandidat
         * tidak boleh dihapus karena menyimpan
         * riwayat pemilihan.
         */
        $hasCandidates = $period->candidates()->exists();

        if ($hasCandidates) {
            return redirect()
                ->route('admin.periods.index')
                ->with(
                    'error',
                    'Periode "' . $period->name .
                    '" tidak dapat dihapus karena sudah memiliki data kandidat.'
                );
        }

        /*
         * Periode aktif juga sebaiknya tidak
         * dihapus.
         */
        if ($period->status === 'active') {
            return redirect()
                ->route('admin.periods.index')
                ->with(
                    'error',
                    'Periode yang sedang aktif tidak dapat dihapus.'
                );
        }

        $name = $period->name;

        $period->delete();

        return redirect()
            ->route('admin.periods.index')
            ->with(
                'success',
                'Periode "' . $name . '" berhasil dihapus.'
            );
    }

    /**
     * Menampilkan pemenang dari periode yang sudah selesai.
     */
    public function winner(Period $period)
    {
        $winner = $period->candidates()
            ->where('is_winner', true)
            ->with('employee')
            ->first();

        if (!$winner) {
            return redirect()
                ->route('admin.periods.index')
                ->with(
                    'error',
                    'Periode tersebut belum memiliki Pegawai Teladan.'
                );
        }

        return view(
            'admin.periods.winner',
            compact('period', 'winner')
        );
    }
}