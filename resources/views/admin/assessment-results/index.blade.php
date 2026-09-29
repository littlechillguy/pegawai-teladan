<x-app-layout>
    <x-slot name="header">
        <div class="lg:ml-72">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-teal-600 text-white flex items-center justify-center shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Hasil Penilaian</h2>
                    <p class="text-sm text-slate-500">Rekapitulasi penilaian Pegawai Teladan pada periode aktif.</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="lg:ml-72 min-h-[calc(100vh-4rem)] bg-slate-50 py-7">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Flash Message --}}
            @if (session('success'))
                <div class="mb-5 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-emerald-700">{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-5 flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3">
                    <div class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m0 3.75h.007"/>
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-red-700">{{ session('error') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4h.01"/>
                            </svg>
                        </div>
                        <ul class="text-sm text-red-700 list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if (!$activePeriod)

                {{-- Empty Active Period --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                    <div class="py-16 px-6 text-center">
                        <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="mt-5 text-lg font-bold text-slate-800">Tidak Ada Periode Aktif</h3>
                        <p class="max-w-md mx-auto mt-2 text-sm leading-6 text-slate-500">
                            Belum ada periode pemilihan Pegawai Teladan yang sedang aktif.
                        </p>
                    </div>
                </div>

            @else

                {{-- Period Header --}}
                <div class="relative overflow-hidden rounded-2xl bg-slate-900 shadow-sm mb-6">
                    <div class="absolute -right-16 -top-20 w-72 h-72 rounded-full bg-teal-500/10"></div>
                    <div class="absolute right-24 -bottom-28 w-64 h-64 rounded-full bg-teal-400/5"></div>

                    <div class="relative px-6 py-6 lg:px-7">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                            <div>
                                <div class="flex flex-wrap items-center gap-2 mb-3">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-teal-500/15 border border-teal-400/20 text-teal-300 text-xs font-semibold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-teal-400"></span>
                                        Periode Aktif
                                    </span>

                                    @if ($activePeriod->voting_completed)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-emerald-500/15 border border-emerald-400/20 text-emerald-300 text-xs font-semibold">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Voting Selesai
                                        </span>
                                    @endif
                                </div>

                                <h3 class="text-2xl font-bold text-white">{{ $activePeriod->name }}</h3>

                                <div class="flex items-center gap-2 mt-2 text-sm text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $activePeriod->start_date->format('d M Y') }} — {{ $activePeriod->end_date->format('d M Y') }}
                                </div>
                            </div>

                            <div>
                                @if ($activePeriod->voting_completed)
                                    <div class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-500/10 border border-emerald-400/20 text-emerald-300 text-sm font-semibold">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Voting Telah Diselesaikan
                                    </div>
                                @else
                                    <form action="{{ route('admin.assessment-results.complete', $activePeriod) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyelesaikan penilaian periode ini? Sistem akan menentukan Pegawai Teladan berdasarkan nilai akhir tertinggi.')">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-teal-500 text-white text-sm font-semibold hover:bg-teal-400 transition shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Selesaikan Penilaian
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Winner --}}
                @if ($activePeriod->voting_completed && $candidates->where('is_winner', true)->isNotEmpty())
                    @php $winner = $candidates->firstWhere('is_winner', true); @endphp

                    <div class="relative overflow-hidden rounded-2xl border border-emerald-200 bg-white shadow-sm mb-6">
                        <div class="h-1 bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-400"></div>

                        <div class="px-6 py-5 lg:px-7">
                            <div class="flex flex-col lg:flex-row lg:items-center gap-6">
                                <div class="relative shrink-0">
                                    @if ($winner->employee->photo)
                                        <img src="{{ asset('storage/' . $winner->employee->photo) }}" alt="{{ $winner->employee->name }}" class="w-24 h-24 rounded-2xl object-cover border-4 border-white shadow-md ring-1 ring-emerald-100">
                                    @else
                                        <div class="w-24 h-24 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center">
                                            <span class="text-3xl font-bold text-emerald-600">{{ strtoupper(substr($winner->employee->name, 0, 1)) }}</span>
                                        </div>
                                    @endif

                                    <div class="absolute -right-2 -bottom-2 w-8 h-8 rounded-lg bg-emerald-600 text-white flex items-center justify-center shadow-sm border-2 border-white">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3l2.09 4.26L19 8.27l-3.5 3.41.83 4.82L12 14.27l-4.33 2.23.83-4.82L5 8.27l4.91-1.01L12 3z"/>
                                        </svg>
                                    </div>
                                </div>

                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="text-xs font-bold uppercase tracking-wider text-emerald-600">Pegawai Teladan</span>
                                        <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                        <span class="text-xs text-slate-400">{{ $activePeriod->name }}</span>
                                    </div>

                                    <h3 class="text-2xl font-bold text-slate-900 mt-1">{{ $winner->employee->name }}</h3>

                                    <p class="text-sm text-slate-500 mt-1">
                                        {{ $winner->employee->nip }} · {{ $winner->employee->pokja ?? '-' }} · {{ $winner->employee->position ?? '-' }}
                                    </p>

                                    <p class="text-sm text-slate-500 mt-3">
                                        Pegawai dengan nilai akhir tertinggi pada periode ini.
                                    </p>
                                </div>

                                <div class="lg:border-l lg:border-slate-200 lg:pl-7 lg:min-w-[150px]">
                                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Nilai Akhir</p>
                                    <p class="text-4xl font-extrabold text-emerald-600 mt-1">{{ number_format($winner->final_score, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Summary --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Kandidat</p>
                                <p class="text-3xl font-extrabold text-slate-800 mt-2">{{ $candidates->count() }}</p>
                            </div>
                            <div class="w-11 h-11 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5V4H2v16h5m10 0v-4H7v4m10 0H7"/>
                                </svg>
                            </div>
                        </div>
                        <div class="h-1 bg-teal-100 rounded-full mt-5 overflow-hidden">
                            <div class="h-full w-full bg-teal-500 rounded-full"></div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Data Lengkap</p>
                                <p class="text-3xl font-extrabold text-slate-800 mt-2">{{ $candidates->where('result_status', 'complete')->count() + $candidates->where('result_status', 'winner')->count() }}</p>
                            </div>
                            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                        </div>
                        <div class="h-1 bg-emerald-100 rounded-full mt-5 overflow-hidden">
                            <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $candidates->count() ? (($candidates->where('result_status', 'complete')->count() + $candidates->where('result_status', 'winner')->count()) / $candidates->count()) * 100 : 0 }}%"></div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Menunggu Kelengkapan</p>
                                <p class="text-3xl font-extrabold text-slate-800 mt-2">{{ $candidates->whereNotIn('result_status', ['complete', 'winner'])->count() }}</p>
                            </div>
                            <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 2"/>
                                </svg>
                            </div>
                        </div>
                        <div class="h-1 bg-amber-100 rounded-full mt-5 overflow-hidden">
                            <div class="h-full bg-amber-500 rounded-full" style="width: {{ $candidates->count() ? ($candidates->whereNotIn('result_status', ['complete', 'winner'])->count() / $candidates->count()) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>

                {{-- Status --}}
                <div class="flex items-start gap-4 bg-white rounded-2xl border border-slate-200 shadow-sm px-5 py-4 mb-6">
                    <div class="w-10 h-10 rounded-xl {{ $activePeriod->voting_completed ? 'bg-emerald-50 text-emerald-600' : 'bg-teal-50 text-teal-600' }} flex items-center justify-center shrink-0">
                        @if ($activePeriod->voting_completed)
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z"/>
                            </svg>
                        @endif
                    </div>

                    <div class="min-w-0">
                        <h3 class="text-sm font-bold text-slate-800">
                            {{ $activePeriod->voting_completed ? 'Penilaian Telah Diselesaikan' : 'Proses Penilaian Berlangsung' }}
                        </h3>

                        @if ($activePeriod->voting_completed)
                            <p class="text-sm text-slate-500 mt-1">
                                Sesi voting telah diselesaikan dan Pegawai Teladan telah ditetapkan berdasarkan nilai akhir tertinggi.
                            </p>
                            <p class="text-xs text-slate-400 mt-1.5">
                                Periode masih berstatus aktif sampai proses periode diselesaikan oleh admin.
                            </p>
                        @else
                            <p class="text-sm text-slate-500 mt-1">
                                Pastikan kehadiran, penilaian evaluator, dan nilai akhir seluruh kandidat telah tersedia sebelum menyelesaikan penilaian.
                            </p>
                        @endif
                    </div>
                </div>

                {{-- Candidate List --}}
                @if ($candidates->isEmpty())
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                        <div class="py-16 px-6 text-center">
                            <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5V4H2v16h5v-4H7v4"/>
                                </svg>
                            </div>
                            <h3 class="mt-5 text-lg font-bold text-slate-800">Belum Ada Kandidat</h3>
                            <p class="max-w-md mx-auto mt-2 text-sm text-slate-500">
                                Belum ada pegawai yang dipilih sebagai kandidat pada periode ini.
                            </p>
                            <a href="{{ route('admin.employees.index') }}" class="inline-flex items-center gap-2 mt-5 px-4 py-2.5 rounded-xl bg-teal-600 text-white text-sm font-semibold hover:bg-teal-700 transition">
                                Kelola Kandidat
                            </a>
                        </div>
                    </div>
                @else

                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                        {{-- List Header --}}
                        <div class="px-6 py-5 border-b border-slate-200">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                <div>
                                    <h3 class="text-lg font-bold text-slate-800">Daftar Kandidat</h3>
                                    <p class="text-sm text-slate-500 mt-1">Ringkasan hasil penilaian kandidat pada periode aktif.</p>
                                </div>
                                <span class="inline-flex items-center justify-center px-3 py-1.5 rounded-lg bg-slate-100 text-slate-600 text-xs font-semibold">
                                    {{ $candidates->count() }} Kandidat
                                </span>
                            </div>
                        </div>

                        {{-- Desktop Table Header --}}
                        <div class="hidden xl:grid grid-cols-[52px_minmax(240px,1fr)_190px_90px_100px_150px_80px] gap-4 items-center px-6 py-3 bg-slate-50 border-b border-slate-200 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            <div>#</div>
                            <div>Kandidat</div>
                            <div>Progress Penilaian</div>
                            <div>Kehadiran</div>
                            <div>Nilai Akhir</div>
                            <div>Status</div>
                            <div></div>
                        </div>

                        <div class="divide-y divide-slate-100">
                            @foreach ($candidates as $index => $candidate)
                                <div class="px-5 py-5 lg:px-6 {{ $candidate->is_winner ? 'bg-emerald-50/40' : 'hover:bg-slate-50/70' }} transition">
                                    <div class="xl:grid xl:grid-cols-[52px_minmax(240px,1fr)_190px_90px_100px_150px_80px] xl:gap-4 xl:items-center">

                                        {{-- Rank --}}
                                        <div class="flex items-center gap-3 mb-4 xl:mb-0">
                                            <div class="w-9 h-9 rounded-xl {{ $candidate->is_winner ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-600' }} flex items-center justify-center shrink-0">
                                                @if ($candidate->is_winner)
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3l2.09 4.26L19 8.27l-3.5 3.41.83 4.82L12 14.27l-4.33 2.23.83-4.82L5 8.27l4.91-1.01L12 3z"/>
                                                    </svg>
                                                @else
                                                    <span class="text-sm font-bold">{{ $index + 1 }}</span>
                                                @endif
                                            </div>
                                            <span class="xl:hidden text-xs font-semibold uppercase tracking-wider text-slate-400">
                                                Kandidat #{{ $index + 1 }}
                                            </span>
                                        </div>

                                        {{-- Candidate --}}
                                        <div class="flex items-center gap-3 min-w-0">
                                            @if ($candidate->employee->photo)
                                                <img src="{{ asset('storage/' . $candidate->employee->photo) }}" alt="{{ $candidate->employee->name }}" class="w-12 h-12 rounded-xl object-cover border border-slate-200 shrink-0">
                                            @else
                                                <div class="w-12 h-12 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center shrink-0">
                                                    <span class="text-lg font-bold text-slate-500">{{ strtoupper(substr($candidate->employee->name, 0, 1)) }}</span>
                                                </div>
                                            @endif

                                            <div class="min-w-0">
                                                <div class="flex flex-wrap items-center gap-2">
                                                    <p class="font-bold text-slate-800 truncate">{{ $candidate->employee->name }}</p>
                                                    @if ($candidate->is_winner)
                                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-emerald-100 text-emerald-700 text-[10px] font-bold">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3l2.09 4.26L19 8.27l-3.5 3.41.83 4.82L12 14.27l-4.33 2.23.83-4.82L5 8.27l4.91-1.01L12 3z"/>
                                                            </svg>
                                                            TELADAN
                                                        </span>
                                                    @endif
                                                </div>
                                                <p class="text-xs text-slate-400 mt-1">{{ $candidate->employee->nip }}</p>
                                                <p class="text-xs text-slate-400 truncate">{{ $candidate->employee->pokja ?? '-' }} · {{ $candidate->employee->position ?? '-' }}</p>
                                            </div>
                                        </div>

                                        {{-- Progress --}}
                                        <div class="mt-5 xl:mt-0">
                                            <div class="flex items-center justify-between mb-1.5">
                                                <span class="text-xs text-slate-400 xl:hidden">Progress Penilaian</span>
                                                <span class="text-xs font-bold text-slate-600">{{ $candidate->assessment_progress }}%</span>
                                            </div>
                                            <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                                <div class="h-full {{ $candidate->assessment_progress >= 100 ? 'bg-emerald-500' : 'bg-teal-500' }} rounded-full" style="width: {{ min($candidate->assessment_progress, 100) }}%"></div>
                                            </div>
                                            <p class="text-[11px] text-slate-400 mt-1.5">{{ $candidate->submitted_assessments_count }} / {{ $candidate->total_evaluators }} evaluator</p>
                                        </div>

                                        {{-- Attendance --}}
                                        <div class="mt-4 xl:mt-0">
                                            <p class="text-[11px] text-slate-400 uppercase tracking-wide xl:hidden">Kehadiran</p>
                                            <p class="text-sm font-bold text-slate-700 mt-1 xl:mt-0">
                                                {{ $candidate->attendance_percentage !== null ? number_format($candidate->attendance_percentage, 2) . '%' : '-' }}
                                            </p>
                                        </div>

                                        {{-- Final Score --}}
                                        <div class="mt-4 xl:mt-0">
                                            <p class="text-[11px] text-slate-400 uppercase tracking-wide xl:hidden">Nilai Akhir</p>
                                            <p class="{{ $candidate->is_winner ? 'text-xl text-emerald-600' : 'text-base text-slate-800' }} font-extrabold mt-1 xl:mt-0">
                                                {{ $candidate->final_score !== null ? number_format($candidate->final_score, 2) : '-' }}
                                            </p>
                                        </div>

                                        {{-- Status --}}
                                        <div class="mt-4 xl:mt-0">
                                            <p class="text-[11px] text-slate-400 uppercase tracking-wide mb-1.5 xl:hidden">Status</p>

                                            @if ($candidate->result_status === 'attendance')
                                                <span class="inline-flex px-2.5 py-1 rounded-lg bg-amber-50 border border-amber-200 text-amber-700 text-[11px] font-semibold">Kehadiran Belum Diisi</span>
                                            @elseif ($candidate->result_status === 'assessment')
                                                <span class="inline-flex px-2.5 py-1 rounded-lg bg-amber-50 border border-amber-200 text-amber-700 text-[11px] font-semibold">Penilaian Belum Lengkap</span>
                                            @elseif ($candidate->result_status === 'calculation')
                                                <span class="inline-flex px-2.5 py-1 rounded-lg bg-slate-100 text-slate-600 text-[11px] font-semibold">Nilai Belum Tersedia</span>
                                            @elseif ($candidate->result_status === 'winner')
                                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-emerald-600 text-white text-[11px] font-semibold">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3l2.09 4.26L19 8.27l-3.5 3.41.83 4.82L12 14.27l-4.33 2.23.83-4.82L5 8.27l4.91-1.01L12 3z"/>
                                                    </svg>
                                                    Pegawai Teladan
                                                </span>
                                            @else
                                                <span class="inline-flex px-2.5 py-1 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 text-[11px] font-semibold">Lengkap</span>
                                            @endif
                                        </div>

                                        {{-- Detail --}}
                                        <div class="mt-4 xl:mt-0 xl:text-right">
                                            <a href="{{ route('admin.assessment-results.show', $candidate) }}" class="inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-lg border border-slate-200 bg-white text-xs font-semibold text-slate-600 hover:border-teal-200 hover:text-teal-600 hover:bg-teal-50 transition">
                                                Detail
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                @endif
            @endif
        </div>
    </div>
</x-app-layout>