<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 21h8m-7-4h6m-7-2h8l1.2-2.4A7 7 0 0017 9a5 5 0 10-10 0 7 7 0 00.8 3.6L9 15zM9 4V2m6 2V2M5 5l-1-1m15 1l1-1"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Hall of Fame</h2>
                    <p class="text-sm text-slate-500 mt-0.5">
                        Daftar Pegawai Teladan yang telah ditetapkan sebagai pemenang.
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-7 bg-slate-50 min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- HERO --}}
            <div class="relative overflow-hidden rounded-2xl bg-slate-900 shadow-sm">
                <div class="absolute -right-16 -top-20 w-64 h-64 rounded-full bg-teal-500/10"></div>
                <div class="absolute -right-4 -bottom-24 w-48 h-48 rounded-full bg-teal-400/5"></div>

                <div class="relative px-6 py-7 sm:px-8 sm:py-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                        <div class="max-w-2xl">
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-teal-500/10 border border-teal-400/20 text-teal-300 text-xs font-bold uppercase tracking-wider">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3l2.09 4.26L19 8l-3.5 3.41.82 4.82L12 14l-4.32 2.23.82-4.82L5 8l4.91-.74L12 3z"/>
                                </svg>
                                Penghargaan Pegawai
                            </div>

                            <h1 class="mt-3 text-2xl sm:text-3xl font-bold text-white">
                                Hall of Fame
                            </h1>

                            <p class="mt-2 text-sm leading-6 text-slate-300 max-w-xl">
                                Riwayat pegawai yang telah ditetapkan sebagai
                                Pegawai Teladan pada setiap periode penilaian.
                            </p>
                        </div>

                        <div class="hidden sm:flex w-16 h-16 rounded-2xl bg-teal-500/10 border border-teal-400/20 items-center justify-center shrink-0">
                            <svg class="w-8 h-8 text-teal-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M8 21h8m-7-4h6m-7-2h8l1.2-2.4A7 7 0 0017 9a5 5 0 10-10 0 7 7 0 00.8 3.6L9 15zM9 4V2m6 2V2M5 5l-1-1m15 1l1-1"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SUMMARY --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Total Pegawai Teladan
                            </p>
                            <p class="mt-2 text-3xl font-bold text-slate-800">
                                {{ $winners->count() }}
                            </p>
                            <p class="mt-1 text-xs text-slate-500">
                                Pegawai yang telah menjadi pemenang
                            </p>
                        </div>

                        <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 21h8m-7-4h6m-7-2h8l1.2-2.4A7 7 0 0017 9a5 5 0 10-10 0 7 7 0 00.8 3.6L9 15z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Riwayat Periode
                            </p>
                            <p class="mt-2 text-3xl font-bold text-slate-800">
                                {{ $winners->unique('period_id')->count() }}
                            </p>
                            <p class="mt-1 text-xs text-slate-500">
                                Periode yang memiliki pemenang
                            </p>
                        </div>

                        <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            {{-- DAFTAR PEMENANG --}}
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                <div class="px-5 sm:px-6 py-5 border-b border-slate-200">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h2 class="text-base font-bold text-slate-800">
                                Daftar Pegawai Teladan
                            </h2>
                            <p class="text-xs text-slate-500 mt-1">
                                Riwayat pegawai yang telah ditetapkan sebagai pemenang.
                            </p>
                        </div>

                        <span class="hidden sm:inline-flex items-center px-3 py-1.5 rounded-lg bg-slate-100 text-slate-600 text-xs font-bold">
                            {{ $winners->count() }} Pemenang
                        </span>
                    </div>
                </div>

                @if ($winners->count())

                    <div class="divide-y divide-slate-100">

                        @foreach ($winners as $winner)

                            <div class="p-5 sm:p-6 hover:bg-slate-50/70 transition">

                                <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-6">

                                    {{-- PEGAWAI --}}
                                    <div class="flex items-center gap-4 min-w-0">

                                        @if ($winner->employee->photo)
                                            <img
                                                src="{{ asset('storage/' . $winner->employee->photo) }}"
                                                alt="{{ $winner->employee->name }}"
                                                class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl object-cover border border-teal-100 ring-4 ring-teal-50 shrink-0"
                                            >
                                        @else
                                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-teal-50 border border-teal-100 flex items-center justify-center text-xl sm:text-2xl font-bold text-teal-600 shrink-0">
                                                {{ strtoupper(substr($winner->employee->name, 0, 1)) }}
                                            </div>
                                        @endif

                                        <div class="min-w-0">
                                            <div class="flex flex-wrap items-center gap-2">
                                                <h3 class="text-lg sm:text-xl font-bold text-slate-800">
                                                    {{ $winner->employee->name }}
                                                </h3>

                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-teal-50 border border-teal-100 text-teal-700 text-[11px] font-bold">
                                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12 2l2.47 5 5.53.8-4 3.9.94 5.5L12 14.6 7.06 17.2 8 11.7l-4-3.9L9.53 7 12 2z"/>
                                                    </svg>
                                                    Pegawai Teladan
                                                </span>
                                            </div>

                                            <p class="mt-1 text-sm text-slate-500">
                                                NIP: {{ $winner->employee->nip }}
                                            </p>

                                            <div class="mt-2 flex flex-wrap gap-2">
                                                <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-600 text-xs font-medium">
                                                    {{ $winner->employee->pokja }}
                                                </span>

                                                <span class="px-2.5 py-1 rounded-lg bg-teal-50 border border-teal-100 text-teal-700 text-xs font-medium">
                                                    {{ $winner->employee->position }}
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- PERIODE + NILAI --}}
                                    <div class="grid grid-cols-2 sm:flex sm:items-center gap-5 sm:gap-8 xl:min-w-[390px]">

                                        <div>
                                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                                Periode
                                            </p>
                                            <p class="mt-1 text-sm font-bold text-slate-800">
                                                {{ $winner->period->name }}
                                            </p>
                                            <p class="mt-1 text-xs text-slate-500">
                                                {{ $winner->period->start_date->format('d M Y') }}
                                                -
                                                {{ $winner->period->end_date->format('d M Y') }}
                                            </p>
                                        </div>

                                        <div>
                                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                                Nilai Akhir
                                            </p>
                                            <p class="mt-1 text-2xl font-bold text-teal-600">
                                                {{ number_format($winner->final_score, 2) }}
                                            </p>
                                        </div>

                                    </div>

                                </div>

                                {{-- DETAIL --}}
                                <div class="mt-5 pt-5 border-t border-slate-100 flex flex-wrap gap-3">

                                    <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-50 border border-slate-200">
                                        <div class="w-8 h-8 rounded-lg bg-white border border-slate-200 text-slate-500 flex items-center justify-center">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3a9 9 0 100 18 9 9 0 000-18zm0 4v5l3 2"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                                Kehadiran
                                            </p>
                                            <p class="text-sm font-bold text-slate-700 mt-0.5">
                                                {{ number_format($winner->attendance_percentage, 2) }}%
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-teal-50 border border-teal-100">
                                        <div class="w-8 h-8 rounded-lg bg-white/70 text-teal-600 flex items-center justify-center">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2l2.47 5 5.53.8-4 3.9.94 5.5L12 14.6 7.06 17.2 8 11.7l-4-3.9L9.53 7 12 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-[11px] font-bold uppercase tracking-wider text-teal-600">
                                                Status Penghargaan
                                            </p>
                                            <p class="text-sm font-bold text-teal-700 mt-0.5">
                                                Pegawai Teladan
                                            </p>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    {{-- EMPTY STATE --}}
                    <div class="px-6 py-16 text-center">

                        <div class="mx-auto w-20 h-20 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center">
                            <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M8 21h8m-7-4h6m-7-2h8l1.2-2.4A7 7 0 0017 9a5 5 0 10-10 0 7 7 0 00.8 3.6L9 15z"/>
                            </svg>
                        </div>

                        <h3 class="mt-5 text-lg font-bold text-slate-800">
                            Belum Ada Pegawai Teladan
                        </h3>

                        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                            Belum ada pegawai yang ditetapkan sebagai Pegawai Teladan
                            pada periode mana pun.
                        </p>

                        <div class="mt-6">
                            <a
                                href="{{ route('admin.candidates.index') }}"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-slate-800 text-white text-sm font-semibold hover:bg-slate-900 shadow-sm transition"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 5v14m-7-7h14"/>
                                </svg>
                                Kelola Kandidat
                            </a>
                        </div>

                    </div>

                @endif

            </div>

        </div>
    </div>
</x-app-layout>