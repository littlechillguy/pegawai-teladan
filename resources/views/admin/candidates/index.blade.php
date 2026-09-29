<x-app-layout>

    <x-slot name="header">
        <div class="lg:ml-72">
            <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                Daftar Kandidat
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Kelola kandidat pada periode pemilihan yang sedang aktif.
            </p>
        </div>
    </x-slot>


    <div class="lg:ml-72 py-8 bg-slate-50/50 min-h-[calc(100vh-4rem)]">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (isset($activePeriod))

                {{-- ===================================================== --}}
                {{-- INFORMASI PERIODE AKTIF --}}
                {{-- ===================================================== --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6 mb-6">

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                        <div>

                            <div class="flex items-center gap-2">

                                @if ($activePeriod->voting_completed)

                                    <span
                                        class="inline-flex items-center gap-1.5
                                               px-3 py-1.5
                                               rounded-full
                                               bg-emerald-50
                                               border border-emerald-200
                                               text-emerald-700
                                               text-xs
                                               font-semibold"
                                    >

                                        <svg
                                            class="w-3.5 h-3.5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 13l4 4L19 7"
                                            />
                                        </svg>

                                        Voting Selesai

                                    </span>

                                @else

                                    <span
                                        class="inline-flex items-center gap-1.5
                                               px-3 py-1.5
                                               rounded-full
                                               bg-teal-50
                                               border border-teal-200
                                               text-teal-700
                                               text-xs
                                               font-semibold"
                                    >

                                        <span class="w-2 h-2 rounded-full bg-teal-600 animate-pulse"></span>

                                        Sesi Voting Berlangsung

                                    </span>

                                @endif

                            </div>


                            <h3 class="text-xl font-bold text-slate-900 mt-2">
                                {{ $activePeriod->name }}
                            </h3>


                            <p class="text-sm text-slate-500 mt-1 flex items-center gap-1.5">

                                <svg
                                    class="w-4 h-4 text-slate-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    />
                                </svg>

                                {{ $activePeriod->start_date->format('d M Y') }}
                                -
                                {{ $activePeriod->end_date->format('d M Y') }}

                            </p>


                            @if ($activePeriod->voting_completed)

                                <p class="text-sm text-slate-600 mt-3">
                                    Sesi voting telah selesai dan Pegawai Teladan telah ditetapkan.
                                </p>

                            @else

                                <p class="text-sm text-slate-600 mt-3">
                                    Kandidat yang tercantum di bawah merupakan pegawai yang mengikuti proses pemilihan pada periode ini.
                                </p>

                            @endif

                        </div>


                        {{-- TOTAL KANDIDAT --}}
                        <div
                            class="md:text-right
                                   bg-slate-50
                                   p-4
                                   rounded-xl
                                   border border-slate-100
                                   min-w-[140px]"
                        >

                            <p class="text-xs font-medium uppercase tracking-wider text-slate-500">
                                Total Kandidat
                            </p>

                            <p class="text-3xl font-extrabold text-teal-600 mt-0.5">
                                {{ $candidates->count() }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- INFORMASI PEGAWAI TELADAN --}}
                {{-- HANYA MUNCUL SETELAH VOTING SELESAI --}}
                {{-- ===================================================== --}}
                @if ($activePeriod->voting_completed && $candidates->where('is_winner', true)->isNotEmpty())

                    @php
                        $winner = $candidates->firstWhere('is_winner', true);
                    @endphp


                    <div
                        class="mb-6
                               rounded-2xl
                               border border-teal-200
                               bg-teal-50/40
                               shadow-sm
                               overflow-hidden"
                    >

                        {{-- HEADER WINNER --}}
                        <div
                            class="px-6 py-4
                                   bg-teal-100/50
                                   border-b border-teal-200"
                        >

                            <div class="flex items-center gap-3">

                                <div
                                    class="w-10 h-10
                                           rounded-xl
                                           bg-teal-700
                                           text-white
                                           flex items-center justify-center
                                           shadow-sm"
                                >

                                    <svg
                                        class="w-6 h-6"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"
                                        />
                                    </svg>

                                </div>


                                <div>

                                    <h3 class="font-bold text-teal-950">
                                        Pegawai Teladan
                                    </h3>

                                    <p class="text-xs text-teal-700">
                                        Pemenang Utama {{ $activePeriod->name }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- DETAIL WINNER --}}
                        <div class="p-6">

                            <div class="flex flex-col sm:flex-row sm:items-center gap-5">

                                {{-- FOTO --}}
                                <div class="shrink-0">

                                    @if ($winner->employee->photo)

                                        <img
                                            src="{{ asset('storage/' . $winner->employee->photo) }}"
                                            alt="{{ $winner->employee->name }}"
                                            class="w-20 h-20
                                                   rounded-full
                                                   object-cover
                                                   border-2 border-teal-500
                                                   ring-4 ring-teal-100
                                                   shadow-sm"
                                        >

                                    @else

                                        <div
                                            class="w-20 h-20
                                                   rounded-full
                                                   bg-teal-100
                                                   border-2 border-teal-500
                                                   ring-4 ring-teal-100
                                                   flex items-center justify-center
                                                   shadow-sm"
                                        >

                                            <span class="text-2xl font-bold text-teal-800">
                                                {{ strtoupper(substr($winner->employee->name, 0, 1)) }}
                                            </span>

                                        </div>

                                    @endif

                                </div>


                                {{-- INFORMASI PEMENANG --}}
                                <div class="flex-1">

                                    <div class="flex flex-wrap items-center gap-2">

                                        <h4 class="text-lg font-bold text-slate-900">
                                            {{ $winner->employee->name }}
                                        </h4>


                                        <span
                                            class="inline-flex items-center gap-1
                                                   px-2.5 py-1
                                                   rounded-full
                                                   bg-teal-700
                                                   text-white
                                                   text-xs
                                                   font-semibold
                                                   shadow-sm"
                                        >

                                            <svg
                                                class="w-3.5 h-3.5"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034a1 1 0 00-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>

                                            Pegawai Teladan

                                        </span>

                                    </div>


                                    <p class="text-sm font-medium text-slate-600 mt-1">
                                        NIP: {{ $winner->employee->nip }}
                                    </p>

                                    <p class="text-sm text-slate-500">
                                        {{ $winner->employee->pokja ?? '-' }}
                                        ·
                                        {{ $winner->employee->position ?? '-' }}
                                    </p>

                                </div>


                                {{-- NILAI --}}
                                <div
                                    class="sm:text-right
                                           shrink-0
                                           bg-white/80
                                           p-3
                                           rounded-xl
                                           border border-teal-200"
                                >

                                    <p class="text-xs font-medium text-teal-800 uppercase tracking-wider">
                                        Nilai Akhir
                                    </p>

                                    <p class="text-2xl font-black text-teal-700 mt-0.5">
                                        {{ number_format($winner->final_score, 2) }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                @endif


                {{-- ===================================================== --}}
                {{-- TIDAK ADA KANDIDAT --}}
                {{-- ===================================================== --}}
                @if ($candidates->isEmpty())

                    <div
                        class="bg-white
                               rounded-2xl
                               shadow-sm
                               border border-slate-200
                               p-10
                               text-center"
                    >

                        <div
                            class="mx-auto
                                   w-16 h-16
                                   flex items-center justify-center
                                   rounded-full
                                   bg-teal-50
                                   text-teal-600
                                   mb-4"
                        >

                            <svg
                                class="w-8 h-8"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                />
                            </svg>

                        </div>


                        <h3 class="text-lg font-bold text-slate-800">
                            Belum Ada Kandidat
                        </h3>


                        <p class="text-sm text-slate-500 mt-1 max-w-md mx-auto">
                            Belum ada pegawai yang dipilih sebagai kandidat pada periode {{ $activePeriod->name }}.
                        </p>


                        <a
                            href="{{ route('admin.employees.index') }}"
                            class="inline-flex items-center gap-2
                                   mt-6
                                   px-4 py-2.5
                                   bg-slate-900
                                   text-white
                                   font-medium
                                   text-sm
                                   rounded-xl
                                   hover:bg-slate-800
                                   transition
                                   shadow-sm"
                        >

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 4v16m8-8H4"
                                />
                            </svg>

                            Pilih Kandidat dari Data Pegawai

                        </a>

                    </div>

                @else


                    {{-- ================================================= --}}
                    {{-- DAFTAR KANDIDAT --}}
                    {{-- ================================================= --}}
                    <div
                        class="bg-white
                               rounded-2xl
                               shadow-sm
                               border border-slate-200
                               overflow-hidden"
                    >

                        {{-- HEADER TABEL --}}
                        <div class="px-6 py-5 border-b border-slate-200">

                            <h3 class="text-lg font-bold text-slate-800">
                                Daftar Kandidat
                            </h3>

                            <p class="text-sm text-slate-500 mt-0.5">
                                Pegawai yang telah dipilih sebagai kandidat pada periode ini.
                            </p>

                        </div>


                        <div class="overflow-x-auto">

                            <table class="min-w-full divide-y divide-slate-200">

                                {{-- HEADER --}}
                                <thead class="bg-slate-50">

                                    <tr>

                                        <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                                            Pegawai
                                        </th>

                                        <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                                            NIP
                                        </th>

                                        <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                                            Pokja
                                        </th>

                                        <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                                            Jabatan
                                        </th>

                                        <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                                            Kehadiran
                                        </th>

                                        <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                                            Status
                                        </th>

                                        <th class="px-6 py-3.5 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">
                                            Aksi
                                        </th>

                                    </tr>

                                </thead>


                                {{-- BODY --}}
                                <tbody class="bg-white divide-y divide-slate-200">

                                    @foreach ($candidates as $candidate)

                                        <tr
                                            class="transition
                                                {{ $candidate->is_winner
                                                    ? 'bg-teal-50/40 border-l-4 border-teal-600'
                                                    : 'hover:bg-slate-50/80' }}"
                                        >

                                            {{-- PEGAWAI --}}
                                            <td class="px-6 py-4 whitespace-nowrap">

                                                <div class="flex items-center">

                                                    {{-- FOTO --}}
                                                    @if ($candidate->employee->photo)

                                                        <img
                                                            src="{{ asset('storage/' . $candidate->employee->photo) }}"
                                                            alt="{{ $candidate->employee->name }}"
                                                            class="{{ $candidate->is_winner
                                                                ? 'w-12 h-12 border-2 border-teal-500'
                                                                : 'w-10 h-10' }}
                                                                rounded-full
                                                                object-cover
                                                                shadow-sm"
                                                        >

                                                    @else

                                                        <div
                                                            class="{{ $candidate->is_winner
                                                                ? 'w-12 h-12 bg-teal-100 text-teal-800 border-2 border-teal-500'
                                                                : 'w-10 h-10 bg-teal-50 text-teal-700 border border-teal-200' }}
                                                                rounded-full
                                                                flex items-center justify-center
                                                                font-bold
                                                                text-sm
                                                                shadow-sm"
                                                        >

                                                            @if ($candidate->is_winner)

                                                                <svg
                                                                    class="w-6 h-6 text-teal-600"
                                                                    fill="currentColor"
                                                                    viewBox="0 0 20 20"
                                                                >
                                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                                </svg>

                                                            @else

                                                                {{ strtoupper(substr($candidate->employee->name, 0, 1)) }}

                                                            @endif

                                                        </div>

                                                    @endif


                                                    {{-- NAMA --}}
                                                    <div class="ml-3">

                                                        <div class="flex flex-wrap items-center gap-2">

                                                            <div
                                                                class="{{ $candidate->is_winner
                                                                    ? 'text-base font-bold text-teal-950'
                                                                    : 'text-sm font-semibold text-slate-900' }}"
                                                            >
                                                                {{ $candidate->employee->name }}
                                                            </div>


                                                            @if ($candidate->is_winner)

                                                                <span
                                                                    class="inline-flex items-center gap-1
                                                                           px-2 py-0.5
                                                                           rounded-full
                                                                           bg-teal-700
                                                                           text-white
                                                                           text-xs
                                                                           font-semibold
                                                                           shadow-sm"
                                                                >

                                                                    <svg
                                                                        class="w-3 h-3"
                                                                        fill="currentColor"
                                                                        viewBox="0 0 20 20"
                                                                    >
                                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                                    </svg>

                                                                    Pegawai Teladan

                                                                </span>

                                                            @endif

                                                        </div>


                                                        <div class="text-xs text-slate-500 mt-0.5">

                                                            @if ($candidate->is_winner)
                                                                Pemenang periode ini
                                                            @else
                                                                Kandidat periode ini
                                                            @endif

                                                        </div>

                                                    </div>

                                                </div>

                                            </td>


                                            {{-- NIP --}}
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700 font-medium">
                                                {{ $candidate->employee->nip }}
                                            </td>


                                            {{-- POKJA --}}
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                                {{ $candidate->employee->pokja ?? '-' }}
                                            </td>


                                            {{-- JABATAN --}}
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                                {{ $candidate->employee->position ?? '-' }}
                                            </td>


                                            {{-- KEHADIRAN --}}
                                            <td class="px-6 py-4 whitespace-nowrap">

                                                @if ($candidate->attendance_percentage !== null)

                                                    <span
                                                        class="inline-flex items-center
                                                               px-2.5 py-1
                                                               rounded-full
                                                               text-xs
                                                               font-semibold
                                                               bg-emerald-50
                                                               text-emerald-700
                                                               border border-emerald-200"
                                                    >
                                                        {{ number_format($candidate->attendance_percentage, 2) }}%
                                                    </span>

                                                @else

                                                    <span
                                                        class="inline-flex items-center
                                                               px-2.5 py-1
                                                               rounded-full
                                                               text-xs
                                                               font-semibold
                                                               bg-amber-50
                                                               text-amber-700
                                                               border border-amber-200"
                                                    >
                                                        Belum diisi
                                                    </span>

                                                @endif

                                            </td>


                                            {{-- STATUS --}}
                                            <td class="px-6 py-4 whitespace-nowrap">

                                                @if ($candidate->is_winner)

                                                    <span
                                                        class="inline-flex items-center gap-1.5
                                                               px-2.5 py-1
                                                               rounded-full
                                                               bg-teal-700
                                                               text-white
                                                               text-xs
                                                               font-semibold
                                                               shadow-sm"
                                                    >

                                                        <svg
                                                            class="w-3.5 h-3.5"
                                                            fill="currentColor"
                                                            viewBox="0 0 20 20"
                                                        >
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>

                                                        Pegawai Teladan

                                                    </span>

                                                @elseif ($activePeriod->voting_completed)

                                                    <span
                                                        class="inline-flex items-center
                                                               px-2.5 py-1
                                                               rounded-full
                                                               bg-slate-100
                                                               text-slate-600
                                                               text-xs
                                                               font-semibold
                                                               border border-slate-200"
                                                    >
                                                        Kandidat
                                                    </span>

                                                @else

                                                    <span
                                                        class="inline-flex items-center
                                                               px-2.5 py-1
                                                               rounded-full
                                                               bg-teal-50
                                                               text-teal-700
                                                               text-xs
                                                               font-semibold
                                                               border border-teal-200"
                                                    >
                                                        Kandidat
                                                    </span>

                                                @endif

                                            </td>


                                            {{-- AKSI --}}
                                            <td class="px-6 py-4 whitespace-nowrap text-right">

                                                @if (!$activePeriod->voting_completed)

                                                    <div class="inline-flex items-center gap-2">

                                                        <a
                                                            href="{{ route('admin.candidates.edit', $candidate) }}"
                                                            class="inline-flex items-center
                                                                   px-3 py-1.5
                                                                   bg-slate-900
                                                                   text-white
                                                                   text-xs
                                                                   font-medium
                                                                   rounded-lg
                                                                   hover:bg-slate-800
                                                                   transition
                                                                   shadow-sm"
                                                        >

                                                            <svg
                                                                class="w-3.5 h-3.5 mr-1"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                viewBox="0 0 24 24"
                                                            >
                                                                <path
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11v-5m-1.5-8.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 7.5-7.5z"
                                                                />
                                                            </svg>

                                                            Edit

                                                        </a>

                                                    </div>

                                                @else

                                                    <span
                                                        class="inline-flex items-center gap-1
                                                               text-xs
                                                               font-medium
                                                               text-slate-400"
                                                    >

                                                        <svg
                                                            class="w-3.5 h-3.5"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            viewBox="0 0 24 24"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                                                            />
                                                        </svg>

                                                        Dikunci

                                                    </span>

                                                @endif

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    </div>

                @endif

            @else

                {{-- ===================================================== --}}
                {{-- TIDAK ADA PERIODE AKTIF --}}
                {{-- ===================================================== --}}
                <div
                    class="bg-white
                           rounded-2xl
                           shadow-sm
                           border border-slate-200
                           p-10
                           text-center"
                >

                    <div
                        class="mx-auto
                               w-12 h-12
                               flex items-center justify-center
                               rounded-full
                               bg-slate-100
                               text-slate-500
                               mb-3"
                    >

                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                            />
                        </svg>

                    </div>


                    <h3 class="text-lg font-bold text-slate-800">
                        Tidak Ada Periode Aktif
                    </h3>


                    <p class="text-sm text-slate-500 mt-1">
                        Silakan buat atau aktifkan periode pemilihan terlebih dahulu.
                    </p>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>