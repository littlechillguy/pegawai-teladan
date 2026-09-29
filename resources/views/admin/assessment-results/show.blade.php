<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-teal-600 text-white flex items-center justify-center shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Detail Hasil Penilaian</h2>
                    <p class="text-sm text-slate-500">Detail penilaian kandidat dan status evaluator.</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="min-h-[calc(100vh-4rem)] bg-slate-50 py-7">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Back --}}
            <div class="mb-5">
                <a href="{{ route('admin.assessment-results.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-teal-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Hasil Penilaian
                </a>
            </div>

            {{-- Candidate Profile --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
                <div class="h-1 bg-gradient-to-r from-teal-500 to-emerald-500"></div>

                <div class="px-6 py-5 border-b border-slate-200">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-teal-600">Informasi Kandidat</p>
                            <h3 class="text-lg font-bold text-slate-800 mt-1">{{ $candidate->period->name }}</h3>
                        </div>

                        @if ($candidate->is_winner)
                            <span class="inline-flex items-center gap-1.5 w-fit px-3 py-1.5 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-bold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3l2.09 4.26L19 8.27l-3.5 3.41.83 4.82L12 14.27l-4.33 2.23.83-4.82L5 8.27l4.91-1.01L12 3z"/>
                                </svg>
                                Pegawai Teladan
                            </span>
                        @endif
                    </div>
                </div>

                <div class="p-6 lg:p-7">
                    <div class="flex flex-col lg:flex-row lg:items-center gap-6">

                        {{-- Photo --}}
                        <div class="relative shrink-0">
                            @if ($candidate->employee->photo)
                                <img src="{{ asset('storage/' . $candidate->employee->photo) }}" alt="{{ $candidate->employee->name }}" class="w-28 h-28 rounded-2xl object-cover border border-slate-200 shadow-sm">
                            @else
                                <div class="w-28 h-28 rounded-2xl bg-teal-50 border border-teal-100 flex items-center justify-center">
                                    <span class="text-3xl font-bold text-teal-600">{{ strtoupper(substr($candidate->employee->name, 0, 1)) }}</span>
                                </div>
                            @endif

                            @if ($candidate->is_winner)
                                <div class="absolute -right-2 -bottom-2 w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center border-2 border-white shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3l2.09 4.26L19 8.27l-3.5 3.41.83 4.82L12 14.27l-4.33 2.23.83-4.82L5 8.27l4.91-1.01L12 3z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Employee Info --}}
                        <div class="flex-1 min-w-0">
                            <h4 class="text-2xl font-bold text-slate-900">{{ $candidate->employee->name }}</h4>

                            <p class="text-sm text-slate-500 mt-1">
                                {{ $candidate->employee->nip }}
                            </p>

                            <div class="flex flex-wrap items-center gap-2 mt-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-100 text-slate-600 text-xs font-semibold">
                                    {{ $candidate->employee->pokja ?? '-' }}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-100 text-slate-600 text-xs font-semibold">
                                    {{ $candidate->employee->position ?? '-' }}
                                </span>
                            </div>
                        </div>

                        {{-- Final Score --}}
                        <div class="lg:min-w-[180px] lg:border-l lg:border-slate-200 lg:pl-7">
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Nilai Akhir</p>
                            <p class="text-4xl font-extrabold {{ $candidate->is_winner ? 'text-emerald-600' : 'text-teal-600' }} mt-1">
                                {{ number_format($finalScore, 2) }}
                            </p>
                            <p class="text-xs text-slate-400 mt-1">Total seluruh kriteria</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Summary --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Kehadiran</p>
                            <p class="text-3xl font-extrabold text-slate-800 mt-2">
                                {{ $candidate->attendance_percentage !== null ? number_format($candidate->attendance_percentage, 2) : '-' }}
                                @if ($candidate->attendance_percentage !== null)
                                    <span class="text-base font-semibold text-slate-400">%</span>
                                @endif
                            </p>
                            <p class="text-xs text-slate-400 mt-1">Bobot kriteria 10%</p>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Nilai Akhir</p>
                            <p class="text-3xl font-extrabold {{ $candidate->is_winner ? 'text-emerald-600' : 'text-teal-600' }} mt-2">
                                {{ number_format($finalScore, 2) }}
                            </p>
                            <p class="text-xs text-slate-400 mt-1">Akumulasi seluruh kriteria</p>
                        </div>
                        <div class="w-10 h-10 rounded-xl {{ $candidate->is_winner ? 'bg-emerald-50 text-emerald-600' : 'bg-teal-50 text-teal-600' }} flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5-3v6a8 8 0 11-16 0V7a8 8 0 0116 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Status</p>

                            @if ($candidate->is_winner)
                                <p class="text-lg font-bold text-emerald-600 mt-2">Pegawai Teladan</p>
                                <p class="text-xs text-slate-400 mt-1">{{ $candidate->period->name }}</p>
                            @else
                                <p class="text-lg font-bold text-slate-800 mt-2">Selesai Dinilai</p>
                                <p class="text-xs text-slate-400 mt-1">Kandidat</p>
                            @endif
                        </div>

                        <div class="w-10 h-10 rounded-xl {{ $candidate->is_winner ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500' }} flex items-center justify-center">
                            @if ($candidate->is_winner)
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3l2.09 4.26L19 8.27l-3.5 3.41.83 4.82L12 14.27l-4.33 2.23.83-4.82L5 8.27l4.91-1.01L12 3z"/>
                                </svg>
                            @else
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Breakdown --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
                <div class="px-6 py-5 border-b border-slate-200">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 19V5m0 14h16M8 16v-5m4 5V8m4 8V4"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-800">Rincian Nilai</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Perhitungan berdasarkan masing-masing kriteria.</p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="px-6 py-3.5 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">Kriteria</th>
                                <th class="px-6 py-3.5 text-center text-[11px] font-bold uppercase tracking-wider text-slate-400">Nilai</th>
                                <th class="px-6 py-3.5 text-center text-[11px] font-bold uppercase tracking-wider text-slate-400">Bobot</th>
                                <th class="px-6 py-3.5 text-right text-[11px] font-bold uppercase tracking-wider text-slate-400">Nilai Berbobot</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @foreach ($details as $detail)
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="px-6 py-4">
                                        <span class="font-semibold text-sm text-slate-800">{{ $detail['criterion']->name }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex min-w-[64px] justify-center px-2.5 py-1 rounded-lg bg-slate-100 text-sm font-semibold text-slate-700">
                                            {{ number_format($detail['raw_score'], 2) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-sm font-medium text-slate-500">{{ number_format($detail['weight'], 0) }}%</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-sm font-bold text-slate-800">{{ number_format($detail['weighted_score'], 2) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr class="bg-slate-900">
                                <td colspan="3" class="px-6 py-4 text-right text-sm font-semibold text-slate-300">
                                    Nilai Akhir
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="text-xl font-extrabold text-white">{{ number_format($finalScore, 2) }}</span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            {{-- Pending Evaluators --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
                <div class="px-6 py-5 border-b border-slate-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div>
                            <div class="flex items-center gap-2">
                                <div class="w-9 h-9 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-base font-bold text-slate-800">Pegawai yang Belum Menilai</h3>
                            </div>
                            <p class="text-xs text-slate-500 mt-2 ml-11">
                                Daftar pegawai aktif yang belum memberikan penilaian kepada kandidat ini.
                            </p>
                        </div>

                        @if ($pendingEvaluators->isNotEmpty())
                            <span class="inline-flex items-center w-fit px-3 py-1.5 rounded-lg bg-amber-50 border border-amber-200 text-amber-700 text-xs font-bold">
                                {{ $pendingEvaluators->count() }} Belum Menilai
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 w-fit px-3 py-1.5 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-bold">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                Semua Sudah Menilai
                            </span>
                        @endif
                    </div>
                </div>

                @if ($pendingEvaluators->isEmpty())

                    <div class="px-6 py-12 text-center">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>

                        <h4 class="mt-4 text-sm font-bold text-slate-800">Semua pegawai sudah mengisi penilaian</h4>
                        <p class="text-sm text-slate-500 mt-1">Tidak ada pegawai yang masih menunggu untuk memberikan penilaian.</p>
                    </div>

                @else

                    <div class="divide-y divide-slate-100">
                        @foreach ($pendingEvaluators as $employee)
                            <div class="px-6 py-4 flex items-center justify-between gap-4 hover:bg-slate-50/70 transition">
                                <div class="flex items-center gap-3 min-w-0">
                                    @if ($employee->photo)
                                        <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}" class="w-11 h-11 rounded-xl object-cover border border-slate-200 shrink-0">
                                    @else
                                        <div class="w-11 h-11 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center shrink-0">
                                            <span class="text-sm font-bold text-slate-500">{{ strtoupper(substr($employee->name, 0, 1)) }}</span>
                                        </div>
                                    @endif

                                    <div class="min-w-0">
                                        <p class="font-semibold text-sm text-slate-800 truncate">{{ $employee->name }}</p>
                                        <div class="flex flex-wrap items-center gap-x-2 mt-1">
                                            <span class="text-xs text-slate-400">{{ $employee->nip }}</span>
                                            <span class="text-slate-300">•</span>
                                            <span class="text-xs text-slate-400">{{ $employee->pokja }}</span>
                                        </div>
                                    </div>
                                </div>

                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-amber-50 border border-amber-200 text-amber-700 text-[11px] font-semibold whitespace-nowrap">
                                    Belum Menilai
                                </span>
                            </div>
                        @endforeach
                    </div>

                @endif
            </div>

            {{-- Footer --}}
            <div class="flex justify-end">
                <a href="{{ route('admin.assessment-results.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-800 text-white text-sm font-semibold hover:bg-slate-900 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali
                </a>
            </div>

        </div>
    </div>
</x-app-layout>