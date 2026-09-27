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

            {{-- Success Alert --}}
            @if(session('success'))
                <div
                    class="mb-6 rounded-2xl border border-emerald-200/80 bg-emerald-50/60 p-4 shadow-sm backdrop-blur-sm"
                    x-data="{ show: true }"
                    x-show="show"
                >
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="p-1.5 bg-emerald-100/80 rounded-lg text-emerald-700 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
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

            {{-- Informasi Pegawai --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6 mb-6">
                <div class="flex flex-col sm:flex-row sm:items-center gap-5">

                    {{-- Foto --}}
                    <div class="shrink-0">
                        @if ($employee->photo)
                            <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}"
                                class="w-20 h-20 rounded-full object-cover ring-2 ring-slate-100 shadow-sm">
                        @else
                            <div class="w-20 h-20 rounded-full bg-teal-50 border border-teal-100 flex items-center justify-center shrink-0">
                                <span class="text-2xl font-bold text-teal-700">
                                    {{ strtoupper(substr($employee->name, 0, 1)) }}
                                </span>
                            </div>
                        @endif
                    </div>

                    {{-- Data --}}
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">
                            {{ $employee->name }}
                        </h3>

                        <p class="text-sm font-semibold text-slate-600 font-mono mt-0.5">
                            NIP: {{ $employee->nip }}
                        </p>

                        <p class="text-sm text-slate-500 mt-0.5">
                            {{ $employee->position }} — {{ $employee->pokja }}
                        </p>
                    </div>

                </div>
            </div>

            {{-- Periode Aktif --}}
            @if ($activePeriod)

                <div class="mb-6">
                    <div class="bg-teal-50/60 border border-teal-200/80 rounded-2xl p-5 shadow-sm backdrop-blur-sm">
                        <p class="text-xs font-bold uppercase tracking-wider text-teal-700">
                            Periode Penilaian Aktif
                        </p>

                        <h3 class="text-xl font-bold text-slate-800 mt-1">
                            {{ $activePeriod->name }}
                        </h3>

                        <p class="text-sm text-slate-500 mt-1 font-medium">
                            {{ $activePeriod->start_date->format('d M Y') }}
                            —
                            {{ $activePeriod->end_date->format('d M Y') }}
                        </p>
                    </div>
                </div>

                {{-- Kandidat Header --}}
                <div class="mb-4">
                    <h3 class="text-lg font-bold text-slate-800">
                        Kandidat Pegawai Teladan
                    </h3>

                    <p class="text-sm text-slate-500 mt-0.5">
                        Pilih kandidat yang ingin Anda berikan penilaian.
                    </p>
                </div>

                @if ($candidates->count())

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                        @foreach ($candidates as $candidate)

                            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden hover:border-slate-300 transition-all">

                                {{-- Foto Kandidat --}}
                                <div class="p-6 flex justify-center">
                                    @if ($candidate->employee->photo)
                                        <img src="{{ asset('storage/' . $candidate->employee->photo) }}"
                                            alt="{{ $candidate->employee->name }}"
                                            class="w-28 h-28 rounded-full object-cover ring-4 ring-slate-100 shadow-sm">
                                    @else
                                        <div class="w-28 h-28 rounded-full bg-teal-50 border border-teal-100 flex items-center justify-center shrink-0">
                                            <span class="text-3xl font-bold text-teal-700">
                                                {{ strtoupper(substr($candidate->employee->name, 0, 1)) }}
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                {{-- Informasi --}}
                                <div class="px-6 pb-6 text-center">
                                    <h4 class="text-lg font-bold text-slate-800">
                                        {{ $candidate->employee->name }}
                                    </h4>

                                    <p class="text-sm font-medium text-slate-600 mt-1">
                                        {{ $candidate->employee->position }}
                                    </p>

                                    <p class="text-xs text-slate-400 mt-0.5 mb-4">
                                        {{ $candidate->employee->pokja }}
                                    </p>

                                    {{-- Tombol Penilaian --}}
                                    @if (in_array($candidate->id, $assessedCandidateIds))
                                        <span class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-semibold rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Sudah Dinilai
                                        </span>
                                    @else
                                        <a
                                            href="{{ route('assessment.create', $candidate) }}"
                                            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-900 text-white rounded-xl text-sm font-semibold shadow-sm hover:bg-slate-800 transition-all active:scale-[0.98]"
                                        >
                                            Nilai Kandidat
                                        </a>
                                    @endif
                                </div>

                            </div>

                        @endforeach
                    </div>

                @else

                    <div class="bg-white rounded-2xl border border-slate-200/80 p-8 text-center shadow-sm">
                        <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center text-slate-400 mx-auto mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-700">
                            Belum ada kandidat
                        </h3>
                        <p class="text-xs text-slate-400 mt-1">
                            Belum ada kandidat yang tersedia untuk dinilai pada periode ini.
                        </p>
                    </div>

                @endif

            @else

                {{-- Tidak ada periode --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 p-8 text-center shadow-sm">
                    <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center text-slate-400 mx-auto mb-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-700">
                        Belum ada periode aktif
                    </h3>
                    <p class="text-xs text-slate-400 mt-1">
                        Penilaian pegawai belum dibuka.
                    </p>
                </div>

            @endif

        </div>
    </div>

</x-app-layout>