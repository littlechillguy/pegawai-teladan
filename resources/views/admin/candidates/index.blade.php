<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Kandidat
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Daftar pegawai yang dipilih sebagai kandidat pada periode aktif.
                </p>

            </div>


            @if ($activePeriod)

                <div class="flex flex-wrap items-center gap-2">

                    <div class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-lg text-sm font-medium">

                        Periode:
                        <span class="font-semibold ml-1">
                            {{ $activePeriod->name }}
                        </span>

                    </div>


                    @if ($activePeriod->voting_completed)

                        <div class="inline-flex items-center gap-1.5 px-4 py-2 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm font-semibold">

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
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                            Voting Selesai

                        </div>

                    @endif

                </div>

            @endif

        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- ========================================================= --}}
            {{-- FLASH SUCCESS --}}
            {{-- ========================================================= --}}

            @if (session('success'))

                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 px-4 py-3">

                    <div class="flex items-start gap-3">

                        <svg
                            class="w-5 h-5 text-green-600 mt-0.5 shrink-0"
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

                        <p class="text-sm text-green-700">
                            {{ session('success') }}
                        </p>

                    </div>

                </div>

            @endif


            {{-- ========================================================= --}}
            {{-- FLASH ERROR --}}
            {{-- ========================================================= --}}

            @if (session('error'))

                <div class="mb-6 rounded-lg bg-red-50 border border-red-200 px-4 py-3">

                    <div class="flex items-start gap-3">

                        <svg
                            class="w-5 h-5 text-red-600 mt-0.5 shrink-0"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 9v3.75m0 3.75h.007M10.29 3.86l-7.5 13A2 2 0 004.5 19.75h15a2 2 0 001.71-2.89l-7.5-13a2 2 0 001.71 2.89l-7.5-13a2 2 0 00-3.42 0z"
                            />
                        </svg>

                        <p class="text-sm text-red-700">
                            {{ session('error') }}
                        </p>

                    </div>

                </div>

            @endif


            {{-- ========================================================= --}}
            {{-- TIDAK ADA PERIODE AKTIF --}}
            {{-- ========================================================= --}}

            @if (!$activePeriod)

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-10 text-center">

                    <div class="mx-auto w-16 h-16 flex items-center justify-center rounded-full bg-yellow-50 mb-4">

                        <svg
                            class="w-8 h-8 text-yellow-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 9v2m0 4h.01M12 3a9 9 0 100 18 9 9 0 000-18z"
                            />
                        </svg>

                    </div>


                    <h3 class="text-lg font-semibold text-gray-800">
                        Belum Ada Periode Aktif
                    </h3>


                    <p class="text-gray-500 mt-2">
                        Silakan aktifkan periode terlebih dahulu sebelum memilih kandidat.
                    </p>


                    <a
                        href="{{ route('admin.periods.index') }}"
                        class="inline-flex items-center mt-6 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                    >
                        Kelola Periode
                    </a>

                </div>


            @else


                {{-- ===================================================== --}}
                {{-- HEADER INFORMASI PERIODE --}}
                {{-- ===================================================== --}}

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">


                        {{-- INFORMASI PERIODE --}}

                        <div>

                            <div class="flex flex-wrap items-center gap-2">

                                <p class="text-sm text-gray-500">
                                    Periode Aktif
                                </p>


                                @if ($activePeriod->voting_completed)

                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

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

                                @endif

                            </div>


                            <h3 class="text-xl font-bold text-gray-800 mt-1">
                                {{ $activePeriod->name }}
                            </h3>


                            <p class="text-sm text-gray-500 mt-1">

                                {{ $activePeriod->start_date->format('d M Y') }}

                                -

                                {{ $activePeriod->end_date->format('d M Y') }}

                            </p>


                            @if ($activePeriod->voting_completed)

                                <p class="text-sm text-gray-500 mt-3">

                                    Sesi voting telah selesai dan Pegawai Teladan
                                    telah ditetapkan.

                                </p>

                            @else

                                <p class="text-sm text-gray-500 mt-3">

                                    Kandidat yang tercantum di bawah merupakan pegawai
                                    yang mengikuti proses pemilihan pada periode ini.

                                </p>

                            @endif

                        </div>


                        {{-- TOTAL KANDIDAT --}}

                        <div class="md:text-right">

                            <p class="text-sm text-gray-500">
                                Total Kandidat
                            </p>


                            <p class="text-3xl font-bold text-blue-600">
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


                    <div class="mb-6 rounded-xl border border-gray-300 bg-gray-50 overflow-hidden">

                        <div class="px-6 py-4 bg-white border-b border-gray-200">

                            <div class="flex items-center gap-3">

                                <div class="w-10 h-10 rounded-lg bg-gray-800 text-white flex items-center justify-center">

                                    <svg
                                        class="w-5 h-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M12 3l2.09 4.26L19 8.27l-3.5 3.41.83 4.82L12 14.27l-4.33 2.23.83-4.82L5 8.27l4.91-1.01L12 3z"
                                        />
                                    </svg>

                                </div>


                                <div>

                                    <h3 class="font-semibold text-gray-800">
                                        Pegawai Teladan
                                    </h3>

                                    <p class="text-xs text-gray-500">
                                        Pemenang {{ $activePeriod->name }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="p-6">

                            <div class="flex flex-col sm:flex-row sm:items-center gap-5">


                                {{-- FOTO PEMENANG --}}

                                <div class="shrink-0">

                                    @if ($winner->employee->photo)

                                        <img
                                            src="{{ asset('storage/' . $winner->employee->photo) }}"
                                            alt="{{ $winner->employee->name }}"
                                            class="w-20 h-20 rounded-full object-cover border-2 border-gray-300"
                                        >

                                    @else

                                        <div class="w-20 h-20 rounded-full bg-white border-2 border-gray-300 flex items-center justify-center">

                                            <span class="text-2xl font-bold text-gray-500">
                                                {{ strtoupper(substr($winner->employee->name, 0, 1)) }}
                                            </span>

                                        </div>

                                    @endif

                                </div>


                                {{-- INFORMASI PEMENANG --}}

                                <div class="flex-1">

                                    <div class="flex flex-wrap items-center gap-2">

                                        <h4 class="text-lg font-bold text-gray-900">
                                            {{ $winner->employee->name }}
                                        </h4>


                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-gray-800 text-white text-xs font-semibold">

                                            <svg
                                                class="w-3.5 h-3.5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M12 3l2.09 4.26L19 8.27l-3.5 3.41.83 4.82L12 14.27l-4.33 2.23.83-4.82L5 8.27l4.91-1.01L12 3z"
                                                />
                                            </svg>

                                            Pegawai Teladan

                                        </span>

                                    </div>


                                    <p class="text-sm text-gray-500 mt-1">
                                        NIP: {{ $winner->employee->nip }}
                                    </p>


                                    <p class="text-sm text-gray-500">
                                        {{ $winner->employee->pokja ?? '-' }}
                                        ·
                                        {{ $winner->employee->position ?? '-' }}
                                    </p>

                                </div>


                                {{-- NILAI --}}

                                <div class="sm:text-right shrink-0">

                                    <p class="text-xs text-gray-500">
                                        Nilai Akhir
                                    </p>

                                    <p class="text-2xl font-bold text-gray-800 mt-1">
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

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-10 text-center">

                        <div class="mx-auto w-16 h-16 flex items-center justify-center rounded-full bg-blue-50 mb-4">

                            <svg
                                class="w-8 h-8 text-blue-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                />
                            </svg>

                        </div>


                        <h3 class="text-lg font-semibold text-gray-800">
                            Belum Ada Kandidat
                        </h3>


                        <p class="text-gray-500 mt-2 max-w-md mx-auto">

                            Belum ada pegawai yang dipilih sebagai kandidat
                            pada periode {{ $activePeriod->name }}.

                        </p>


                        <a
                            href="{{ route('admin.employees.index') }}"
                            class="inline-flex items-center mt-6 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                        >
                            Pilih Kandidat dari Data Pegawai
                        </a>

                    </div>


                @else


                    {{-- ===================================================== --}}
                    {{-- DAFTAR KANDIDAT --}}
                    {{-- ===================================================== --}}

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">


                        {{-- HEADER TABEL --}}

                        <div class="px-6 py-5 border-b border-gray-200">

                            <h3 class="text-lg font-semibold text-gray-800">
                                Daftar Kandidat
                            </h3>


                            <p class="text-sm text-gray-500 mt-1">
                                Pegawai yang telah dipilih sebagai kandidat pada periode ini.
                            </p>

                        </div>


                        <div class="overflow-x-auto">

                            <table class="min-w-full divide-y divide-gray-200">


                                {{-- ================================================= --}}
                                {{-- HEADER --}}
                                {{-- ================================================= --}}

                                <thead class="bg-gray-50">

                                    <tr>

                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Pegawai
                                        </th>

                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            NIP
                                        </th>

                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Pokja
                                        </th>

                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Jabatan
                                        </th>

                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Kehadiran
                                        </th>

                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>

                                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Aksi
                                        </th>

                                    </tr>

                                </thead>


                                {{-- ================================================= --}}
                                {{-- BODY --}}
                                {{-- ================================================= --}}

                                <tbody class="bg-white divide-y divide-gray-200">


                                    @foreach ($candidates as $candidate)


                                        <tr
                                            class="transition
                                            {{ $candidate->is_winner
                                                ? 'bg-gray-50 border-l-4 border-gray-800'
                                                : 'hover:bg-gray-50' }}"
                                        >


                                            {{-- ================================================= --}}
                                            {{-- PEGAWAI --}}
                                            {{-- ================================================= --}}

                                            <td class="px-6 py-4 whitespace-nowrap">

                                                <div class="flex items-center">


                                                    {{-- FOTO --}}

                                                    @if ($candidate->employee->photo)

                                                        <img
                                                            src="{{ asset('storage/' . $candidate->employee->photo) }}"
                                                            alt="{{ $candidate->employee->name }}"
                                                            class="{{ $candidate->is_winner ? 'w-14 h-14' : 'w-11 h-11' }} rounded-full object-cover {{ $candidate->is_winner ? 'border-2 border-gray-300' : '' }}"
                                                        >

                                                    @else

                                                        <div
                                                            class="{{ $candidate->is_winner ? 'w-14 h-14 bg-gray-800 text-white' : 'w-11 h-11 bg-blue-100 text-blue-700' }}
                                                            rounded-full flex items-center justify-center font-semibold"
                                                        >

                                                            @if ($candidate->is_winner)

                                                                <svg
                                                                    class="w-6 h-6"
                                                                    fill="none"
                                                                    stroke="currentColor"
                                                                    viewBox="0 0 24 24"
                                                                >
                                                                    <path
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        stroke-width="1.5"
                                                                        d="M12 3l2.09 4.26L19 8.27l-3.5 3.41.83 4.82L12 14.27l-4.33 2.23.83-4.82L5 8.27l4.91-1.01L12 3z"
                                                                    />
                                                                </svg>

                                                            @else

                                                                {{ strtoupper(substr($candidate->employee->name, 0, 1)) }}

                                                            @endif

                                                        </div>

                                                    @endif


                                                    {{-- NAMA --}}

                                                    <div class="ml-3">

                                                        <div class="flex flex-wrap items-center gap-2">

                                                            <div class="{{ $candidate->is_winner ? 'text-base font-bold text-gray-900' : 'text-sm font-semibold text-gray-900' }}">

                                                                {{ $candidate->employee->name }}

                                                            </div>


                                                            @if ($candidate->is_winner)

                                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-gray-800 text-white text-xs font-semibold">

                                                                    <svg
                                                                        class="w-3 h-3"
                                                                        fill="none"
                                                                        stroke="currentColor"
                                                                        viewBox="0 0 24 24"
                                                                    >
                                                                        <path
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            stroke-width="1.5"
                                                                            d="M12 3l2.09 4.26L19 8.27l-3.5 3.41.83 4.82L12 14.27l-4.33 2.23.83-4.82L5 8.27l4.91-1.01L12 3z"
                                                                        />
                                                                    </svg>

                                                                    Pegawai Teladan

                                                                </span>

                                                            @endif

                                                        </div>


                                                        <div class="text-xs text-gray-500 mt-0.5">

                                                            @if ($candidate->is_winner)

                                                                Pemenang periode ini

                                                            @else

                                                                Kandidat periode ini

                                                            @endif

                                                        </div>

                                                    </div>

                                                </div>

                                            </td>


                                            {{-- ================================================= --}}
                                            {{-- NIP --}}
                                            {{-- ================================================= --}}

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">

                                                {{ $candidate->employee->nip }}

                                            </td>


                                            {{-- ================================================= --}}
                                            {{-- POKJA --}}
                                            {{-- ================================================= --}}

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">

                                                {{ $candidate->employee->pokja ?? '-' }}

                                            </td>


                                            {{-- ================================================= --}}
                                            {{-- JABATAN --}}
                                            {{-- ================================================= --}}

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">

                                                {{ $candidate->employee->position ?? '-' }}

                                            </td>


                                            {{-- ================================================= --}}
                                            {{-- KEHADIRAN --}}
                                            {{-- ================================================= --}}

                                            <td class="px-6 py-4 whitespace-nowrap">

                                                @if ($candidate->attendance_percentage !== null)

                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">

                                                        {{ number_format($candidate->attendance_percentage, 2) }}%

                                                    </span>

                                                @else

                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">

                                                        Belum diisi

                                                    </span>

                                                @endif

                                            </td>


                                            {{-- ================================================= --}}
                                            {{-- STATUS --}}
                                            {{-- ================================================= --}}

                                            <td class="px-6 py-4 whitespace-nowrap">

                                                @if ($candidate->is_winner)

                                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-gray-800 text-white text-xs font-semibold">

                                                        <svg
                                                            class="w-3.5 h-3.5"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            viewBox="0 0 24 24"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="1.5"
                                                                d="M12 3l2.09 4.26L19 8.27l-3.5 3.41.83 4.82L5 8.27l4.91-1.01L12 3z"
                                                            />
                                                        </svg>

                                                        Pegawai Teladan

                                                    </span>

                                                @elseif ($activePeriod->voting_completed)

                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-semibold">

                                                        Kandidat

                                                    </span>

                                                @else

                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold">

                                                        Kandidat

                                                    </span>

                                                @endif

                                            </td>


                                            {{-- ================================================= --}}
{{-- AKSI --}}
{{-- ================================================= --}}

<td class="px-6 py-4 whitespace-nowrap text-right">

    @if (!$activePeriod->voting_completed)

        <div class="inline-flex items-center gap-2">

            {{-- EDIT --}}

            <a
                href="{{ route('admin.candidates.edit', $candidate) }}"
                class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition"
            >

                <svg
                    class="w-4 h-4 mr-1.5"
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

        <span class="text-xs text-gray-400">
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

            @endif

        </div>

    </div>

</x-app-layout>