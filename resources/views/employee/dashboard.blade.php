<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                Dashboard Pegawai
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Selamat datang, {{ $employee->name }}
            </p>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50/50 min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- SUCCESS ALERT --}}
            @if(session('success'))
                <div
                    class="mb-6 rounded-2xl border border-emerald-200/80 bg-emerald-50/60 p-4 shadow-sm"
                    x-data="{ show: true }"
                    x-show="show"
                >
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="p-1.5 bg-emerald-100 rounded-lg text-emerald-700 shrink-0">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-emerald-800">
                                {{ session('success') }}
                            </p>
                        </div>

                        <button
                            type="button"
                            @click="show = false"
                            class="text-emerald-500 hover:text-emerald-700 text-lg transition-colors"
                        >
                            &times;
                        </button>
                    </div>
                </div>
            @endif

            {{-- PERIODE AKTIF --}}
            @if($activePeriod)

                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 mb-7">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-teal-50 border border-teal-100 text-teal-600 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="1.7" stroke-linecap="round" d="M8 2v4m8-4v4M3 10h18"/>
                                    <rect x="3" y="4" width="18" height="17" rx="2"/>
                                </svg>
                            </div>

                            <div>
                                <p class="text-xs font-bold uppercase tracking-wider text-teal-600">
                                    Periode Penilaian Aktif
                                </p>
                                <h3 class="text-xl font-bold text-slate-800 mt-1">
                                    {{ $activePeriod->name }}
                                </h3>
                                <p class="text-sm text-slate-500 mt-1">
                                    {{ $activePeriod->start_date->format('d M Y') }}
                                    —
                                    {{ $activePeriod->end_date->format('d M Y') }}
                                </p>
                            </div>
                        </div>

                        @if($activePeriod->voting_completed)
                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-50 border border-emerald-200 text-sm font-semibold text-emerald-700">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                Penilaian Telah Selesai
                            </span>
                        @else
                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-teal-50 border border-teal-200 text-sm font-semibold text-teal-700">
                                <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                                Penilaian Sedang Berlangsung
                            </span>
                        @endif
                    </div>
                </div>

                {{-- DATA CHART --}}
                @php
                    $chartCandidates = $candidates->filter(function ($candidate) {
                        return $candidate->final_score !== null;
                    });

                    $chartLabels = $chartCandidates->map(function ($candidate) {
                        return $candidate->employee->name;
                    })->values();

                    $chartScores = $chartCandidates->map(function ($candidate) {
                        return (float) $candidate->final_score;
                    })->values();
                @endphp

                {{-- DOUGHNUT CHART --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 mb-7">
                    <div class="flex items-start justify-between gap-4 mb-6">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">
                                Perbandingan Nilai Akhir
                            </h3>
                            <p class="text-sm text-slate-500 mt-1">
                                Perbandingan nilai akhir masing-masing kandidat pada periode aktif.
                            </p>
                        </div>

                        <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="1.7" stroke-linecap="round" d="M11 3a9 9 0 109 9h-9V3z"/>
                                <path stroke="currentColor" stroke-width="1.7" stroke-linecap="round" d="M15 3.5A9 9 0 0120.5 9H15V3.5z"/>
                            </svg>
                        </div>
                    </div>

                    @if($chartCandidates->count())
                        <div class="flex flex-col lg:flex-row items-center gap-8">

                            {{-- CHART --}}
                            <div class="w-full lg:w-1/2 flex justify-center">
                                <div class="relative w-[280px] h-[280px]">
                                    <canvas id="candidateScoreChart"></canvas>
                                </div>
                            </div>

                            {{-- LEGEND --}}
                            <div class="w-full lg:w-1/2">
                                <div class="space-y-3">
                                    @foreach($chartCandidates as $index => $candidate)
                                        @php
                                            $chartColors = [
                                                '#0d9488',
                                                '#14b8a6',
                                                '#2dd4bf',
                                                '#5eead4',
                                                '#99f6e4',
                                                '#0f766e',
                                                '#115e59',
                                                '#134e4a',
                                            ];

                                            $color = $chartColors[$index % count($chartColors)];
                                        @endphp

                                        <div class="flex items-center justify-between gap-4 p-3 rounded-xl bg-slate-50 border border-slate-100">
                                            <div class="flex items-center gap-3 min-w-0">
                                                <span
                                                    class="w-3 h-3 rounded-full shrink-0"
                                                    style="background-color: {{ $color }}"
                                                ></span>

                                                <div class="min-w-0">
                                                    <div class="flex items-center gap-2 min-w-0">
                                                        <p class="text-sm font-semibold text-slate-700 truncate">
                                                            {{ $candidate->employee->name }}
                                                        </p>

                                                        @if($candidate->is_winner)
                                                            <span class="shrink-0 text-[9px] font-bold text-amber-600">
                                                                PEMENANG
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <p class="text-xs text-slate-400 truncate">
                                                        {{ $candidate->employee->position ?? '-' }}
                                                    </p>
                                                </div>
                                            </div>

                                            <span class="text-sm font-bold text-slate-800 shrink-0">
                                                {{ number_format($candidate->final_score, 2) }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="py-12 text-center">
                            <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-400 mx-auto mb-4">
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="1.7" stroke-linecap="round" d="M11 3a9 9 0 109 9h-9V3z"/>
                                    <path stroke="currentColor" stroke-width="1.7" stroke-linecap="round" d="M15 3.5A9 9 0 0120.5 9H15V3.5z"/>
                                </svg>
                            </div>

                            <h3 class="text-base font-bold text-slate-700">
                                Nilai akhir belum tersedia
                            </h3>

                            <p class="text-sm text-slate-400 mt-1">
                                Nilai akhir kandidat akan ditampilkan setelah proses penilaian berlangsung.
                            </p>
                        </div>
                    @endif
                </div>

                {{-- KANDIDAT HEADER --}}
                <div class="mb-5">
                    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-2">
                        <div>
                            <h3 class="text-xl font-bold text-slate-800">
                                Kandidat Pegawai Teladan
                            </h3>

                            @if($activePeriod->voting_completed)
                                <p class="text-sm text-slate-500 mt-1">
                                    Berikut kandidat dan pemenang pada periode ini.
                                </p>
                            @else
                                <p class="text-sm text-slate-500 mt-1">
                                    Pilih kandidat yang ingin Anda berikan penilaian.
                                </p>
                            @endif
                        </div>

                        <span class="text-xs font-semibold text-slate-400">
                            {{ $candidates->count() }} kandidat
                        </span>
                    </div>
                </div>

                {{-- DAFTAR KANDIDAT --}}
                @if($candidates->count())

                    <div class="flex flex-wrap gap-5">

                        @foreach($candidates as $candidate)

                            @php
                                $isSelf = (int) $candidate->employee_id === (int) $employee->id;
                                $isWinner = (bool) $candidate->is_winner;
                                $hasAssessed = in_array($candidate->id, $assessedCandidateIds);
                            @endphp

                            <div class="w-full sm:w-[calc(50%-10px)] xl:w-[calc(33.333%-14px)] bg-white rounded-2xl border {{ $isWinner ? 'border-amber-200' : 'border-slate-200/80' }} shadow-sm overflow-hidden hover:shadow-md transition-all duration-200">

                                {{-- STATUS --}}
                                @if($isWinner)
                                    <div class="bg-amber-50 border-b border-amber-200 px-5 py-2.5">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-amber-500" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M12 3l2.1 4.26 4.7.68-3.4 3.31.8 4.68L12 13.7l-4.2 2.23.8-4.68-3.4-.68L12 3z"/>
                                            </svg>

                                            <span class="text-xs font-bold text-amber-700">
                                                PEGAWAI TELADAN
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <div class="h-1 bg-teal-500"></div>
                                @endif

                                <div class="p-5">

                                    {{-- IDENTITAS --}}
                                    <div class="flex items-center gap-4">

                                        @if($candidate->employee->photo)
                                            <img
                                                src="{{ asset('storage/' . $candidate->employee->photo) }}"
                                                alt="{{ $candidate->employee->name }}"
                                                class="w-16 h-16 rounded-2xl object-cover border {{ $isWinner ? 'border-amber-200' : 'border-slate-200' }} shadow-sm shrink-0"
                                            >
                                        @else
                                            <div class="w-16 h-16 rounded-2xl {{ $isWinner ? 'bg-amber-50 border-amber-200' : 'bg-teal-50 border-teal-100' }} border flex items-center justify-center shrink-0">
                                                <span class="text-xl font-bold {{ $isWinner ? 'text-amber-600' : 'text-teal-700' }}">
                                                    {{ strtoupper(substr($candidate->employee->name, 0, 1)) }}
                                                </span>
                                            </div>
                                        @endif

                                        <div class="min-w-0 flex-1">
                                            <div class="flex items-center gap-2">
                                                <h4 class="text-base font-bold text-slate-800 truncate">
                                                    {{ $candidate->employee->name }}
                                                </h4>

                                                @if($isSelf)
                                                    <span class="shrink-0 px-2 py-1 rounded-lg bg-blue-50 border border-blue-100 text-[9px] font-bold text-blue-600">
                                                        ANDA
                                                    </span>
                                                @endif
                                            </div>

                                            <p class="text-xs text-slate-500 mt-1 truncate">
                                                {{ $candidate->employee->position ?? '-' }}
                                            </p>

                                            <p class="text-[11px] text-slate-400 mt-0.5 truncate">
                                                {{ $candidate->employee->pokja ?? '-' }}
                                            </p>
                                        </div>
                                    </div>

                                    {{-- NILAI AKHIR --}}
                                    <div class="mt-5 flex items-center justify-between gap-3 p-3 rounded-xl {{ $isWinner ? 'bg-amber-50 border-amber-200' : 'bg-slate-50 border-slate-100' }} border">

                                        <div>
                                            <p class="text-[10px] uppercase tracking-wider font-bold {{ $isWinner ? 'text-amber-500' : 'text-slate-400' }}">
                                                Nilai Akhir
                                            </p>

                                            @if($candidate->final_score !== null)
                                                <p class="text-xl font-extrabold {{ $isWinner ? 'text-amber-700' : 'text-slate-800' }} mt-1">
                                                    {{ number_format($candidate->final_score, 2) }}
                                                </p>
                                            @else
                                                <p class="text-sm font-semibold text-slate-400 mt-1">
                                                    Belum dihitung
                                                </p>
                                            @endif
                                        </div>

                                        @if($isWinner)
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg bg-amber-100 border border-amber-200 text-[10px] font-bold text-amber-700">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M12 3l2.1 4.26 4.7.68-3.4.68-3.4 3.31.8 4.68L12 13.7l-4.2 2.23.8-4.68-3.4-.68L12 3z"/>
                                                </svg>
                                                Pemenang
                                            </span>
                                        @else
                                            <span class="text-[10px] font-bold text-slate-400">
                                                Kandidat
                                            </span>
                                        @endif

                                    </div>

                                    {{-- AKSI --}}
                                    <div class="mt-4">

                                        @if($isSelf)

                                            <div class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-amber-50 border border-amber-200 text-sm font-semibold text-amber-600">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86l-8.2 14A2 2 0 003.82 21h16.36a2 2 0 001.73-3.14l-8.2-14a2 2 0 00-3.42-3.14z"/>
                                                </svg>
                                                Tidak dapat menilai diri sendiri
                                            </div>

                                        @elseif($hasAssessed)

                                            <div class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-50 border border-emerald-200 text-sm font-semibold text-emerald-700">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                Sudah Dinilai
                                            </div>

                                        @elseif($activePeriod->voting_completed)

                                            <div class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-slate-100 border border-slate-200 text-sm font-semibold text-slate-400">
                                                Penilaian Ditutup
                                            </div>

                                        @else

                                            <a
                                                href="{{ route('assessment.create', $candidate) }}"
                                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-900 text-white rounded-xl text-sm font-semibold shadow-sm hover:bg-teal-600 transition-all active:scale-[0.98]"
                                            >
                                                Nilai Kandidat

                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </a>

                                        @endif

                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="bg-white rounded-2xl border border-slate-200/80 p-8 text-center shadow-sm">
                        <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center text-slate-400 mx-auto mb-3">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>

                        <h3 class="text-base font-bold text-slate-700">
                            Belum ada kandidat
                        </h3>

                        <p class="text-xs text-slate-400 mt-1">
                            Belum ada kandidat yang tersedia pada periode ini.
                        </p>
                    </div>

                @endif

            @else

                {{-- TIDAK ADA PERIODE AKTIF --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 p-10 text-center shadow-sm">
                    <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-400 mx-auto mb-4">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="1.7" stroke-linecap="round" d="M8 7V3m8 4V3m-9 8h10"/>
                            <path stroke="currentColor" stroke-width="1.7" stroke-linecap="round" d="M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>

                    <h3 class="text-base font-bold text-slate-700">
                        Belum ada periode aktif
                    </h3>

                    <p class="text-sm text-slate-400 mt-1">
                        Penilaian pegawai belum dibuka.
                    </p>
                </div>

            @endif

        </div>
    </div>

    {{-- CHART.JS --}}
    @if($activePeriod && $chartCandidates->count())
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const canvas = document.getElementById('candidateScoreChart');

                if (!canvas) return;

                const labels = @json($chartLabels);
                const scores = @json($chartScores);

                const colors = [
                    '#0d9488',
                    '#14b8a6',
                    '#2dd4bf',
                    '#5eead4',
                    '#99f6e4',
                    '#0f766e',
                    '#115e59',
                    '#134e4a'
                ];

                new Chart(canvas, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: scores,
                            backgroundColor: colors.slice(0, scores.length),
                            borderColor: '#ffffff',
                            borderWidth: 4,
                            hoverOffset: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '65%',
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        return ' ' + context.label + ': ' + Number(context.raw).toFixed(2);
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>
    @endif

</x-app-layout>