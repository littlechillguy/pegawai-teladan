<x-app-layout>

    <div class="min-h-screen bg-slate-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

            {{-- ========================================================= --}}
            {{-- HEADER / WELCOME --}}
            {{-- ========================================================= --}}
            <section class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-900 via-emerald-800 to-teal-800 shadow-lg">
                <div class="absolute -right-20 -top-20 w-72 h-72 rounded-full bg-white/5"></div>
                <div class="absolute -right-10 -bottom-24 w-80 h-80 rounded-full bg-white/5"></div>

                <div class="relative z-10 p-6 sm:p-8 lg:p-10">
                    <div class="max-w-3xl">
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/10 text-xs font-semibold text-emerald-100 backdrop-blur-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-300"></span>
                            Sistem Informasi Penilaian
                        </span>

                        <h1 class="mt-4 text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight text-white">
                            Selamat Datang,
                            {{ auth()->user()->employee?->name ?? auth()->user()->name }}
                        </h1>

                        <p class="mt-3 text-sm sm:text-base leading-relaxed text-emerald-100 max-w-2xl">
                            Kelola dan pantau proses pemilihan pegawai teladan
                            melalui panel utama
                            <span class="font-semibold text-white">Ruang Keteladanan</span>.
                        </p>
                    </div>
                </div>
            </section>

            {{-- ========================================================= --}}
            {{-- STATISTICS --}}
            {{-- ========================================================= --}}
            <section>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                    {{-- TOTAL PEGAWAI --}}
                    <div class="group bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:shadow-md transition-all duration-200">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                    Pegawai Aktif
                                </p>
                                <p class="mt-2 text-3xl font-bold text-slate-800">
                                    {{ $totalEmployees ?? 0 }}
                                </p>
                            </div>

                            <div class="flex items-center justify-center w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 group-hover:bg-emerald-100 transition-colors">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-4a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4 4 4 0 004 4z"/>
                                </svg>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-t border-slate-100">
                            <p class="text-xs text-slate-500">
                                Pegawai yang terdaftar dan aktif
                            </p>
                        </div>
                    </div>

                    {{-- KANDIDAT --}}
                    <div class="group bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:shadow-md transition-all duration-200">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                    Kandidat Aktif
                                </p>
                                <p class="mt-2 text-3xl font-bold text-slate-800">
                                    {{ $totalCandidates ?? 0 }}
                                </p>
                            </div>

                            <div class="flex items-center justify-center w-11 h-11 rounded-xl bg-amber-50 text-amber-600 group-hover:bg-amber-100 transition-colors">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15a4 4 0 100-8 4 4 0 000 8zm0 0v6m-6-3h12"/>
                                </svg>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-t border-slate-100">
                            <p class="text-xs text-slate-500">
                                Kandidat pada periode aktif
                            </p>
                        </div>
                    </div>

                    {{-- PENILAIAN --}}
                    <div class="group bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:shadow-md transition-all duration-200">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                    Penilaian Masuk
                                </p>
                                <p class="mt-2 text-3xl font-bold text-slate-800">
                                    {{ $totalAssessments ?? 0 }}
                                </p>
                            </div>

                            <div class="flex items-center justify-center w-11 h-11 rounded-xl bg-blue-50 text-blue-600 group-hover:bg-blue-100 transition-colors">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-t border-slate-100">
                            <p class="text-xs text-slate-500">
                                Penilaian yang telah dikirim
                            </p>
                        </div>
                    </div>

                    {{-- STATUS PERIODE --}}
                    <div class="group bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:shadow-md transition-all duration-200">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                    Status Periode
                                </p>

                                <p class="mt-2 text-2xl font-bold text-slate-800">
                                    {{ isset($activePeriod) && $activePeriod ? 'Aktif' : 'Tidak Ada' }}
                                </p>
                            </div>

                            <div class="flex items-center justify-center w-11 h-11 rounded-xl bg-purple-50 text-purple-600 group-hover:bg-purple-100 transition-colors">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-t border-slate-100">
                            <p class="text-xs text-slate-500">
                                Periode yang sedang digunakan
                            </p>
                        </div>
                    </div>

                </div>
            </section>

            {{-- ========================================================= --}}
            {{-- NILAI & DAFTAR KANDIDAT --}}
            {{-- ========================================================= --}}
            @if(isset($activePeriod) && $activePeriod)

                <section class="grid grid-cols-1 lg:grid-cols-5 gap-6">

                    {{-- ===================================================== --}}
                    {{-- CHART NILAI --}}
                    {{-- ===================================================== --}}
                    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                        <div class="px-6 py-5 border-b border-slate-100">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h2 class="text-lg font-bold text-slate-800">
                                        Nilai Akhir Kandidat
                                    </h2>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Perbandingan nilai akhir kandidat pada periode aktif.
                                    </p>
                                </div>

                                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 3a9 9 0 109 9h-9V3z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 3.5A9 9 0 0120.5 9H15V3.5z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">

                            @if(isset($candidateScores) && count($candidateScores))

                                <div class="relative w-full max-w-sm mx-auto">
                                    <div class="aspect-square">
                                        <canvas id="candidateScoreChart"></canvas>
                                    </div>
                                </div>

                                <div class="mt-5 pt-5 border-t border-slate-100">
                                    <div class="flex items-center justify-between gap-4 text-xs">
                                        <span class="text-slate-500">
                                            Periode
                                        </span>

                                        <span class="font-semibold text-slate-700 text-right">
                                            {{ $activePeriod->name }}
                                        </span>
                                    </div>

                                    @php
                                        $winner = isset($candidates)
                                            ? $candidates->firstWhere('is_winner', true)
                                            : null;
                                    @endphp

                                    @if($winner)
                                        <div class="mt-3 flex items-center justify-between gap-4 text-xs">
                                            <span class="text-slate-500">
                                                Pegawai Teladan
                                            </span>

                                            <span class="inline-flex items-center gap-1.5 font-bold text-amber-600 text-right">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3l2.1 4.26 4.7.68-3.4 3.31.8 4.68L12 13.7l-4.2 2.23.8-4.68-3.4-.68L12 3z"/>
                                                </svg>
                                                {{ $winner->employee?->name ?? 'Pemenang' }}
                                            </span>
                                        </div>
                                    @endif
                                </div>

                            @else

                                <div class="py-14 text-center">
                                    <div class="mx-auto w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400">
                                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-6m3 6V7m3 10v-3m3 3V4M5 20h14"/>
                                        </svg>
                                    </div>

                                    <h3 class="mt-4 text-sm font-semibold text-slate-700">
                                        Belum Ada Data Nilai
                                    </h3>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Belum ada nilai kandidat yang dapat ditampilkan.
                                    </p>
                                </div>

                            @endif

                        </div>
                    </div>

                    {{-- ===================================================== --}}
                    {{-- DAFTAR KANDIDAT --}}
                    {{-- ===================================================== --}}
                    <div class="lg:col-span-3 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                        <div class="px-6 py-5 border-b border-slate-100">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                                <div>
                                    <h2 class="text-lg font-bold text-slate-800">
                                        Daftar Kandidat Pegawai Teladan
                                    </h2>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Pantau kandidat dan hasil penilaian pada periode aktif.
                                    </p>
                                </div>

                                <span class="inline-flex items-center justify-center px-3 py-1.5 rounded-lg bg-slate-100 border border-slate-200 text-xs font-semibold text-slate-600 whitespace-nowrap">
                                    {{ isset($candidates) ? $candidates->count() : 0 }}
                                    Kandidat
                                </span>

                            </div>
                        </div>

                        @if(!isset($candidates) || $candidates->isEmpty())

                            <div class="px-6 py-16 text-center">

                                <div class="mx-auto w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400">
                                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-6 4h3m-6 4h12a2 2 0 002-2V5a2 2 0 00-2-2H6a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                </div>

                                <h3 class="mt-4 text-sm font-bold text-slate-700">
                                    Belum Ada Kandidat
                                </h3>

                                <p class="mt-1 text-sm text-slate-400">
                                    Belum ada pegawai yang ditetapkan sebagai kandidat pada periode ini.
                                </p>

                            </div>

                        @else

                            <div class="p-5 space-y-3">

                                @foreach($candidates as $candidate)

                                    @php
                                        $isWinner = (bool) $candidate->is_winner;
                                        $hasAssessed = isset($assessedCandidateIds)
                                            && in_array($candidate->id, $assessedCandidateIds);
                                    @endphp

                                    <div class="group rounded-xl border {{ $isWinner ? 'border-amber-200 bg-amber-50/30' : 'border-slate-200 bg-white' }} p-4 hover:border-emerald-300 hover:shadow-sm transition-all duration-200">

                                        <div class="flex items-center justify-between gap-4">

                                            {{-- EMPLOYEE --}}
                                            <div class="flex items-center gap-3 min-w-0">

                                                {{-- PHOTO --}}
                                                @if($candidate->employee?->photo)

                                                    <img
                                                        src="{{ asset('storage/' . $candidate->employee->photo) }}"
                                                        alt="{{ $candidate->employee->name }}"
                                                        class="w-12 h-12 rounded-full object-cover border-2 {{ $isWinner ? 'border-amber-200' : 'border-white' }} shadow-sm ring-1 {{ $isWinner ? 'ring-amber-200' : 'ring-slate-200' }} flex-shrink-0"
                                                    >

                                                @else

                                                    <div class="w-12 h-12 rounded-full {{ $isWinner ? 'bg-amber-100 text-amber-700 border-amber-200' : 'bg-emerald-50 text-emerald-700 border-emerald-100' }} flex items-center justify-center flex-shrink-0 font-bold border">
                                                        {{ strtoupper(substr($candidate->employee?->name ?? 'K', 0, 1)) }}
                                                    </div>

                                                @endif

                                                {{-- INFO --}}
                                                <div class="min-w-0">

                                                    <div class="flex items-center gap-2 min-w-0">
                                                        <h3 class="text-sm font-bold text-slate-800 truncate">
                                                            {{ $candidate->employee?->name ?? 'Nama Tidak Ada' }}
                                                        </h3>

                                                        @if($isWinner)
                                                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-amber-100 border border-amber-200 text-[9px] font-bold text-amber-700 shrink-0">
                                                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3l2.1 4.26 4.7.68-3.4 3.31.8 4.68L12 13.7l-4.2 2.23.8-4.68-3.4-.68L12 3z"/>
                                                                </svg>
                                                                PEMENANG
                                                            </span>
                                                        @else
                                                            <span class="inline-flex items-center px-2 py-1 rounded-md bg-slate-100 border border-slate-200 text-[9px] font-bold text-slate-500 shrink-0">
                                                                KANDIDAT
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <p class="mt-0.5 text-xs font-medium {{ $isWinner ? 'text-amber-700' : 'text-emerald-700' }} truncate">
                                                        {{ $candidate->employee?->pokja ?? '-' }}
                                                    </p>

                                                    <p class="mt-0.5 text-xs text-slate-500 truncate">
                                                        {{ $candidate->employee?->position ?? '-' }}
                                                    </p>

                                                </div>

                                            </div>

                                            {{-- SCORE + ACTION --}}
                                            <div class="flex items-center gap-3 flex-shrink-0">

                                                {{-- SCORE --}}
                                                <div class="hidden sm:block text-right">
                                                    <p class="text-[9px] uppercase tracking-wider font-bold text-slate-400">
                                                        Nilai Akhir
                                                    </p>

                                                    @if($candidate->final_score !== null)
                                                        <p class="mt-0.5 text-sm font-extrabold {{ $isWinner ? 'text-amber-600' : 'text-slate-800' }}">
                                                            {{ number_format($candidate->final_score, 2) }}
                                                        </p>
                                                    @else
                                                        <p class="mt-0.5 text-xs font-semibold text-slate-400">
                                                            Belum ada
                                                        </p>
                                                    @endif
                                                </div>

                                                {{-- ACTION --}}
                                                @if($activePeriod->voting_completed)

                                                    <span class="inline-flex items-center px-3 py-2 rounded-lg bg-slate-100 border border-slate-200 text-slate-500 text-xs font-semibold">
                                                        Ditutup
                                                    </span>

                                                @elseif($hasAssessed)

                                                    <span class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg bg-emerald-50 border border-emerald-100 text-emerald-700 text-xs font-bold">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                        Dinilai
                                                    </span>

                                                @else

                                                    <a
                                                        href="{{ route('assessment.create', $candidate) }}"
                                                        class="inline-flex items-center gap-1.5 px-3.5 py-2.5 rounded-xl bg-emerald-600 text-white text-xs font-bold hover:bg-emerald-700 shadow-sm transition-all active:scale-95"
                                                    >
                                                        Nilai

                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                                        </svg>
                                                    </a>

                                                @endif

                                            </div>

                                        </div>

                                        {{-- MOBILE SCORE --}}
                                        @if($candidate->final_score !== null)
                                            <div class="sm:hidden mt-3 pt-3 border-t {{ $isWinner ? 'border-amber-200' : 'border-slate-100' }} flex items-center justify-between">
                                                <span class="text-[10px] uppercase tracking-wider font-bold text-slate-400">
                                                    Nilai Akhir
                                                </span>

                                                <span class="text-sm font-extrabold {{ $isWinner ? 'text-amber-600' : 'text-slate-800' }}">
                                                    {{ number_format($candidate->final_score, 2) }}
                                                </span>
                                            </div>
                                        @endif

                                    </div>

                                @endforeach

                            </div>

                        @endif

                    </div>

                </section>

            @else

                {{-- ========================================================= --}}
                {{-- TIDAK ADA PERIODE AKTIF --}}
                {{-- ========================================================= --}}
                <section class="bg-white rounded-2xl border border-slate-200 shadow-sm p-10 text-center">

                    <div class="mx-auto w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>

                    <h3 class="mt-4 text-base font-bold text-slate-700">
                        Belum Ada Periode Aktif
                    </h3>

                    <p class="mt-1 text-sm text-slate-400">
                        Belum ada periode penilaian yang sedang digunakan.
                    </p>

                </section>

            @endif

        </div>

    </div>

    {{-- ========================================================= --}}
    {{-- CHART SCRIPT --}}
    {{-- ========================================================= --}}
    @push('scripts')

        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>

        @if(isset($activePeriod) && $activePeriod && isset($candidateScores) && count($candidateScores))

            <script>
                document.addEventListener('DOMContentLoaded', function () {

                    const candidateScoreCtx =
                        document.getElementById('candidateScoreChart');

                    if (!candidateScoreCtx) return;

                    const scoreValues =
                        @json(collect($candidateScores)->pluck('score'));

                    const candidateNames =
                        @json(collect($candidateScores)->pluck('name'));

                    const chartColors = [
                        '#059669',
                        '#2563EB',
                        '#D97706',
                        '#7C3AED',
                        '#DC2626',
                        '#0891B2',
                        '#DB2777',
                        '#65A30D'
                    ];

                    const totalScore =
                        scoreValues.reduce(
                            (total, value) => total + Number(value),
                            0
                        );

                    new Chart(candidateScoreCtx, {
                        type: 'doughnut',

                        data: {
                            labels: candidateNames,

                            datasets: [{
                                label: 'Nilai Akhir',

                                data: scoreValues,

                                backgroundColor: candidateNames.map(
                                    function (_, index) {
                                        return chartColors[
                                            index % chartColors.length
                                        ];
                                    }
                                ),

                                borderColor: '#ffffff',
                                borderWidth: 3,
                                hoverOffset: 8
                            }]
                        },

                        plugins: [
                            ChartDataLabels
                        ],

                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '62%',

                            plugins: {

                                legend: {
                                    display: true,
                                    position: 'bottom',

                                    labels: {
                                        usePointStyle: true,
                                        pointStyle: 'circle',
                                        padding: 16,
                                        color: '#475569',

                                        font: {
                                            size: 11,
                                            weight: '600'
                                        }
                                    }
                                },

                                tooltip: {
                                    backgroundColor: '#0f172a',
                                    padding: 12,
                                    cornerRadius: 10,
                                    displayColors: true,

                                    callbacks: {

                                        title: function (items) {
                                            return items[0].label;
                                        },

                                        label: function (context) {

                                            const value =
                                                Number(context.raw);

                                            const percentage =
                                                totalScore > 0
                                                    ? (value / totalScore) * 100
                                                    : 0;

                                            return [
                                                'Nilai Akhir: ' +
                                                    value.toFixed(2),

                                                'Persentase: ' +
                                                    percentage.toFixed(2) +
                                                    '%'
                                            ];
                                        }
                                    }
                                },

                                datalabels: {

                                    color: '#ffffff',

                                    font: {
                                        weight: '700',
                                        size: 12
                                    },

                                    formatter: function (value) {

                                        const percentage =
                                            totalScore > 0
                                                ? (value / totalScore) * 100
                                                : 0;

                                        return percentage.toFixed(1) + '%';
                                    }
                                }
                            }
                        }
                    });

                });
            </script>

        @endif

    @endpush

</x-app-layout>