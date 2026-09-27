<x-app-layout>

    <div class="py-8 bg-slate-50/80 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Welcome Banner --}}
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-emerald-800 via-teal-700 to-emerald-900 p-6 sm:p-8 text-white shadow-lg shadow-emerald-900/10">
                <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>
                <div class="relative z-10">
                    <span class="inline-block px-3 py-1 bg-white/15 backdrop-blur-md text-xs font-semibold rounded-full text-emerald-100 mb-3 border border-white/10">
                        Sistem Informasi Penilaian
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                        Selamat Datang, {{ auth()->user()->employee?->name ?? auth()->user()->name }} 👋
                    </h1>
                    <p class="mt-2 text-emerald-100 max-w-2xl text-sm sm:text-base leading-relaxed">
                        Kelola dan pantau seluruh jalannya proses pemilihan pegawai teladan secara transparan melalui panel utama Ruang Keteladanan.
                    </p>
                </div>
            </div>

            {{-- Statistics Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                {{-- Total Pegawai --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 border-l-4 border-l-emerald-600 p-5 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Pegawai Aktif
                            </p>
                            <p class="mt-2 text-3xl font-extrabold text-slate-800">
                                {{ $totalEmployees ?? 0 }}
                            </p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 shadow-inner">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-4a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-t border-slate-100 text-xs text-slate-500 font-medium">
                        Pegawai terdaftar di sistem
                    </div>
                </div>

                {{-- Kandidat --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 border-l-4 border-l-amber-500 p-5 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Kandidat Aktif
                            </p>
                            <p class="mt-2 text-3xl font-extrabold text-slate-800">
                                {{ $totalCandidates ?? 0 }}
                            </p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0 shadow-inner">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15a4 4 0 100-8 4 4 0 000 8zm0 0v6m-6-3h12"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-t border-slate-100 text-xs text-slate-500 font-medium">
                        Kandidat periode berjalan
                    </div>
                </div>

                {{-- Penilaian Masuk --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 border-l-4 border-l-blue-600 p-5 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Penilaian Masuk
                            </p>
                            <p class="mt-2 text-3xl font-extrabold text-slate-800">
                                {{ $totalAssessments ?? 0 }}
                            </p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0 shadow-inner">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-t border-slate-100 text-xs text-slate-500 font-medium">
                        Penilaian yang dikirim
                    </div>
                </div>

                {{-- Status Periode --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 border-l-4 border-l-purple-600 p-5 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Status Periode
                            </p>
                            <p class="mt-2 text-2xl font-extrabold text-slate-800">
                                {{ isset($activePeriod) && $activePeriod ? 'Aktif' : 'Tidak Ada' }}
                            </p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center flex-shrink-0 shadow-inner">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-t border-slate-100 text-xs text-slate-500 font-medium">
                        Periode pemilihan aktif
                    </div>
                </div>

            </div>

            {{-- Section Donut Chart & Progress Penilaian --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Donut Chart Pokja --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6">
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                        <div>
                            <h3 class="text-base font-bold text-slate-800">
                                Distribusi Pegawai per Pokja
                            </h3>
                            <p class="text-xs text-slate-500 mt-0.5">
                                Sebaran pegawai aktif berdasarkan kelompok kerja
                            </p>
                        </div>
                        <span class="p-2 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-semibold">
                            Pokja Overview
                        </span>
                    </div>

                    @if(isset($pokjaDistribution) && count($pokjaDistribution))
                        <div class="mt-6 flex flex-col sm:flex-row items-center gap-6">
                            <div style="width: 170px; height: 170px;" class="flex-shrink-0">
                                <canvas id="pokjaChart"></canvas>
                            </div>

                            <div class="flex-1 w-full space-y-2.5">
                                @foreach($pokjaDistribution as $index => $item)
                                    <div class="flex items-center justify-between text-xs p-2 rounded-lg bg-slate-50 hover:bg-slate-100/80 transition">
                                        <div class="flex items-center gap-2.5">
                                            <span class="w-3 h-3 rounded-full pokja-dot shadow-sm" data-index="{{ $index }}"></span>
                                            <span class="font-medium text-slate-700">{{ is_object($item) ? ($item->pokja ?? 'Lainnya') : ($item['pokja'] ?? 'Lainnya') }}</span>
                                        </div>
                                        <span class="font-bold text-slate-900 bg-white px-2 py-0.5 rounded border border-slate-200">
                                            {{ is_object($item) ? $item->total : $item['total'] }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="mt-6 py-12 text-center text-slate-400 text-sm">
                            Belum ada data pegawai.
                        </div>
                    @endif
                </div>

                {{-- Progress Penilaian per Kandidat --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6">
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                        <div>
                            <h3 class="text-base font-bold text-slate-800">
                                Progress Penilaian Kandidat
                            </h3>
                            <p class="text-xs text-slate-500 mt-0.5">
                                Persentase masukan penilaian pegawai
                            </p>
                        </div>
                        <span class="p-2 rounded-lg bg-blue-50 text-blue-700 text-xs font-semibold">
                            Live Progress
                        </span>
                    </div>

                    @if(isset($activePeriod) && $activePeriod && isset($candidateProgress) && count($candidateProgress))
                        <div class="mt-6 space-y-4">
                            @foreach($candidateProgress as $item)
                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                                    <div class="flex items-center justify-between text-xs font-semibold mb-2">
                                        <span class="text-slate-800">{{ $item['name'] }}</span>
                                        <span class="text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-100">
                                            {{ $item['submitted'] }}/{{ $item['total'] }} ({{ $item['percentage'] }}%)
                                        </span>
                                    </div>

                                    <div class="w-full h-2.5 rounded-full bg-slate-200 overflow-hidden">
                                        <div
                                            class="h-full rounded-full bg-gradient-to-r from-emerald-500 to-teal-600 transition-all duration-500"
                                            style="width: {{ $item['percentage'] }}%"
                                        ></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="mt-6 py-12 text-center text-slate-400 text-sm">
                            Belum ada data penilaian untuk ditampilkan.
                        </div>
                    @endif
                </div>

            </div>

            {{-- Chart Perbandingan Nilai Akhir Kandidat --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div>
                        <h3 class="text-base font-bold text-slate-800">
                            Perbandingan Nilai Akhir Kandidat
                        </h3>
                        <p class="text-xs text-slate-500 mt-0.5">
                            @if(isset($activePeriod) && $activePeriod)
                                Grafik akumulasi nilai kandidat pada periode {{ $activePeriod->name }}.
                            @else
                                Belum ada periode aktif.
                            @endif
                        </p>
                    </div>
                </div>

                @if(isset($activePeriod) && $activePeriod && isset($candidateScores) && count($candidateScores))
                    <div class="mt-6 p-4 rounded-xl bg-slate-50/50 border border-slate-100" style="height: 320px;">
                        <canvas id="candidateScoreChart"></canvas>
                    </div>
                @else
                    <div class="mt-6 py-12 text-center text-slate-400 text-sm">
                        Belum ada data nilai kandidat untuk ditampilkan.
                    </div>
                @endif
            </div>

            {{-- Detail Periode Aktif Card --}}
            <div class="bg-gradient-to-r from-slate-900 to-slate-800 rounded-2xl shadow-md p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">
                            Informasi Periode
                        </span>
                        <h3 class="text-xl font-extrabold mt-1">
                            {{ $activePeriod->name ?? 'Tidak Ada Periode Aktif' }}
                        </h3>
                    </div>

                    @if(isset($activePeriod) && $activePeriod)
                        <div class="px-4 py-2 rounded-xl bg-white/10 backdrop-blur-md text-xs font-medium border border-white/10">
                            🗓️ {{ \Carbon\Carbon::parse($activePeriod->start_date)->format('d M Y') }} — {{ \Carbon\Carbon::parse($activePeriod->end_date)->format('d M Y') }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- Section Penilaian Kandidat --}}
            @if(isset($activePeriod) && $activePeriod)

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">

                    <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div>
                            <h3 class="text-base font-bold text-slate-800">
                                Daftar Kandidat Pegawai Teladan
                            </h3>
                            <p class="text-xs text-slate-500 mt-0.5">
                                Silakan berikan penilaian objektif Anda untuk kandidat terpilih.
                            </p>
                        </div>

                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold">
                            {{ isset($candidates) ? $candidates->count() : 0 }} Kandidat Terdaftar
                        </span>
                    </div>

                    @if(!isset($candidates) || $candidates->isEmpty())

                        <div class="p-12 text-center">
                            <div class="w-16 h-16 mx-auto rounded-full bg-slate-100 flex items-center justify-center mb-3 text-slate-400">
                                📋
                            </div>
                            <h4 class="font-bold text-slate-700">Belum Ada Kandidat</h4>
                            <p class="text-xs text-slate-400 mt-1">Belum ada pegawai yang ditetapkan sebagai kandidat di periode ini.</p>
                        </div>

                    @else

                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">

                            @foreach($candidates as $candidate)

                                <div class="p-5 rounded-xl border border-slate-200/90 bg-slate-50/30 hover:bg-white hover:border-emerald-300 hover:shadow-md transition-all duration-200 flex items-center justify-between gap-4">

                                    <div class="flex items-center gap-4 min-w-0">
                                        {{-- Foto Profil --}}
                                        @if($candidate->employee?->photo)
                                            <img
                                                src="{{ asset('storage/' . $candidate->employee->photo) }}"
                                                alt="{{ $candidate->employee->name }}"
                                                class="w-14 h-14 rounded-full object-cover border-2 border-emerald-500/30 flex-shrink-0"
                                            >
                                        @else
                                            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-emerald-500 to-teal-700 text-white font-extrabold text-lg flex items-center justify-center flex-shrink-0 shadow-sm">
                                                {{ strtoupper(substr($candidate->employee?->name ?? 'K', 0, 1)) }}
                                            </div>
                                        @endif

                                        {{-- Info --}}
                                        <div class="min-w-0">
                                            <h4 class="font-bold text-slate-900 truncate text-sm sm:text-base">
                                                {{ $candidate->employee?->name ?? 'Nama Tidak Ada' }}
                                            </h4>

                                            <p class="text-xs text-emerald-700 font-semibold mt-0.5">
                                                {{ $candidate->employee?->pokja ?? '-' }}
                                            </p>

                                            <p class="text-xs text-slate-500 truncate mt-0.5">
                                                {{ $candidate->employee?->position ?? '-' }}
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Aksi --}}
                                    <div class="flex-shrink-0">
                                        @if(isset($assessedCandidateIds) && in_array($candidate->id, $assessedCandidateIds))
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-emerald-100 text-emerald-800 text-xs font-bold border border-emerald-200">
                                                ✓ Dinilai
                                            </span>
                                        @else
                                            <a
                                                href="{{ route('assessment.create', $candidate) }}"
                                                class="inline-flex items-center px-4 py-2 rounded-xl bg-emerald-600 text-white text-xs font-bold hover:bg-emerald-700 shadow-sm shadow-emerald-600/30 transition-all active:scale-95"
                                            >
                                                Nilai Sekarang
                                            </a>
                                        @endif
                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @endif

                </div>

            @endif

        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>

        @if(isset($pokjaDistribution) && count($pokjaDistribution))
            <script>
                const pokjaColors = ['#059669', '#0d9488', '#10b981', '#34d399', '#6ee7b7', '#a7f3d0'];

                document.querySelectorAll('.pokja-dot').forEach(function (dot) {
                    const idx = parseInt(dot.dataset.index, 10);
                    dot.style.backgroundColor = pokjaColors[idx % pokjaColors.length];
                });

                const pokjaCtx = document.getElementById('pokjaChart');

                if (pokjaCtx) {
                    new Chart(pokjaCtx, {
                        type: 'doughnut',
                        data: {
                            labels: @json(collect($pokjaDistribution)->pluck('pokja')),
                            datasets: [{
                                data: @json(collect($pokjaDistribution)->pluck('total')),
                                backgroundColor: pokjaColors,
                                borderWidth: 3,
                                borderColor: '#ffffff',
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            cutout: '70%',
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    backgroundColor: '#0f172a',
                                    padding: 10,
                                    cornerRadius: 8
                                }
                            }
                        }
                    });
                }
            </script>
        @endif

        @if(isset($activePeriod) && $activePeriod && isset($candidateScores) && count($candidateScores))
            <script>
                const candidateScoreCtx = document.getElementById('candidateScoreChart');

                if (candidateScoreCtx) {
                    const scoreValues = @json(collect($candidateScores)->pluck('score'));
                    const maxScore = Math.max(...scoreValues);

                    const barColors = scoreValues.map(function (value) {
                        return value === maxScore ? '#059669' : '#34d399';
                    });

                    const extraPlugins = [];
                    if (typeof ChartDataLabels !== 'undefined') {
                        extraPlugins.push(ChartDataLabels);
                    }

                    new Chart(candidateScoreCtx, {
                        type: 'bar',
                        data: {
                            labels: @json(collect($candidateScores)->pluck('name')),
                            datasets: [{
                                label: 'Nilai Akhir',
                                data: scoreValues,
                                backgroundColor: barColors,
                                borderRadius: 8,
                                maxBarThickness: 48,
                            }]
                        },
                        plugins: extraPlugins,
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            layout: {
                                padding: { top: 24 }
                            },
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    backgroundColor: '#0f172a',
                                    padding: 10,
                                    cornerRadius: 8,
                                    callbacks: {
                                        label: function (context) {
                                            return 'Nilai: ' + context.parsed.y;
                                        }
                                    }
                                },
                                datalabels: {
                                    anchor: 'end',
                                    align: 'top',
                                    color: '#065f46',
                                    font: {
                                        weight: 'bold',
                                        size: 12
                                    },
                                    formatter: function (value) {
                                        return value;
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: 100,
                                    grid: { color: '#e2e8f0' },
                                    ticks: { color: '#64748b' }
                                },
                                x: {
                                    grid: { display: false },
                                    ticks: {
                                        color: '#334155',
                                        font: { weight: '600' }
                                    }
                                }
                            }
                        }
                    });
                }
            </script>
        @endif
    @endpush

</x-app-layout>