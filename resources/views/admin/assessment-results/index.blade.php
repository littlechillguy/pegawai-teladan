<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Hasil Penilaian
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Hasil penilaian kandidat pada periode aktif.
            </p>
        </div>
    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- ========================================================= --}}
            {{-- FLASH SUCCESS --}}
            {{-- ========================================================= --}}

            @if (session('success'))

                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3">

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

                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3">

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
                                d="M12 9v3.75m0 3.75h.007M10.29 3.86l-7.5 13A2 2 0 004.5 19.75h15a2 2 0 001.71-2.89l-7.5-13a2 2 0 00-3.42 0z"
                            />
                        </svg>

                        <p class="text-sm text-red-700">
                            {{ session('error') }}
                        </p>

                    </div>

                </div>

            @endif


            {{-- ========================================================= --}}
            {{-- VALIDATION ERROR --}}
            {{-- ========================================================= --}}

            @if ($errors->any())

                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3">

                    <div class="text-sm text-red-700">

                        <ul class="list-disc list-inside space-y-1">

                            @foreach ($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            @endif


            {{-- ========================================================= --}}
            {{-- TIDAK ADA PERIODE AKTIF --}}
            {{-- ========================================================= --}}

            @if (!$activePeriod)

                <div class="bg-white rounded-xl shadow-sm border border-gray-200">

                    <div class="p-10 text-center">

                        <div class="w-14 h-14 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-4">

                            <svg
                                class="w-7 h-7 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z"
                                />
                            </svg>

                        </div>

                        <h3 class="text-lg font-semibold text-gray-800">
                            Tidak Ada Periode Aktif
                        </h3>

                        <p class="text-sm text-gray-500 mt-2">
                            Belum ada periode pemilihan pegawai teladan yang sedang aktif.
                        </p>

                    </div>

                </div>


            @else


                {{-- ===================================================== --}}
                {{-- HEADER PERIODE --}}
                {{-- ===================================================== --}}

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">

                    <div class="p-6">

                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                            <div>

                                <div class="flex flex-wrap items-center gap-3">

                                    <h3 class="text-lg font-semibold text-gray-800">
                                        {{ $activePeriod->name }}
                                    </h3>


                                    {{-- STATUS PERIODE --}}

                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">

                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>

                                        Aktif

                                    </span>


                                    {{-- STATUS VOTING --}}

                                    @if ($activePeriod->voting_completed)

                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-800 text-white">

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


                                <p class="text-sm text-gray-500 mt-2">

                                    {{ $activePeriod->start_date->format('d M Y') }}

                                    -

                                    {{ $activePeriod->end_date->format('d M Y') }}

                                </p>

                            </div>


                            {{-- ================================================= --}}
                            {{-- TOMBOL SELESAIKAN / STATUS SELESAI --}}
                            {{-- ================================================= --}}

                            <div class="shrink-0">

                                @if ($activePeriod->voting_completed)

                                    <div class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm font-semibold">

                                        <svg
                                            class="w-5 h-5"
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

                                        Voting Telah Diselesaikan

                                    </div>

                                @else

                                    <form
                                        action="{{ route('admin.assessment-results.complete', $activePeriod) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menyelesaikan penilaian periode ini? Sistem akan menentukan Pegawai Teladan berdasarkan nilai akhir tertinggi.')"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-gray-800 text-white text-sm font-semibold hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition"
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
                                                    d="M5 13l4 4L19 7"
                                                />
                                            </svg>

                                            Selesaikan Penilaian

                                        </button>

                                    </form>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- KARTU PEGAWAI TELADAN --}}
                {{-- HANYA MUNCUL SETELAH VOTING SELESAI --}}
                {{-- ===================================================== --}}

                @if ($activePeriod->voting_completed && $candidates->where('is_winner', true)->isNotEmpty())

                    @php
                        $winner = $candidates->firstWhere('is_winner', true);
                    @endphp


                    <div class="mb-6 rounded-xl border border-gray-300 bg-gray-50 overflow-hidden">

                        {{-- HEADER KARTU --}}

                        <div class="px-6 py-4 border-b border-gray-200 bg-white">

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
                                        Hasil akhir {{ $activePeriod->name }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- ISI KARTU --}}

                        <div class="p-6">

                            <div class="flex flex-col md:flex-row md:items-center gap-6">


                                {{-- FOTO --}}

                                <div class="shrink-0">

                                    @if ($winner->employee->photo)

                                        <img
                                            src="{{ asset('storage/' . $winner->employee->photo) }}"
                                            alt="{{ $winner->employee->name }}"
                                            class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-sm"
                                        >

                                    @else

                                        <div class="w-24 h-24 rounded-full bg-white border-4 border-white shadow-sm flex items-center justify-center">

                                            <span class="text-3xl font-bold text-gray-500">
                                                {{ strtoupper(substr($winner->employee->name, 0, 1)) }}
                                            </span>

                                        </div>

                                    @endif

                                </div>


                                {{-- INFORMASI --}}

                                <div class="flex-1">

                                    <div class="flex flex-wrap items-center gap-2">

                                        <h4 class="text-xl font-bold text-gray-800">
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


                                    <p class="text-sm text-gray-600 mt-3">

                                        Ditetapkan sebagai
                                        <strong class="text-gray-800">
                                            Pegawai Teladan
                                        </strong>

                                        pada
                                        <strong class="text-gray-800">
                                            {{ $activePeriod->name }}
                                        </strong>.

                                    </p>

                                </div>


                                {{-- NILAI --}}

                                <div class="shrink-0 md:text-right">

                                    <p class="text-xs text-gray-500">
                                        Nilai Akhir
                                    </p>

                                    <p class="text-3xl font-bold text-gray-800 mt-1">
                                        {{ number_format($winner->final_score, 2) }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                @endif


                {{-- ===================================================== --}}
                {{-- INFORMASI STATUS --}}
                {{-- ===================================================== --}}

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">

                    <div class="p-6">

                        <div class="flex items-start gap-4">

                            <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center shrink-0">

                                <svg
                                    class="w-5 h-5 text-gray-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.5"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z"
                                    />
                                </svg>

                            </div>


                            <div>

                                <h3 class="text-sm font-semibold text-gray-800">
                                    @if ($activePeriod->voting_completed)
                                        Penilaian Telah Diselesaikan
                                    @else
                                        Proses Penilaian
                                    @endif
                                </h3>


                                @if ($activePeriod->voting_completed)

                                    <p class="text-sm text-gray-500 mt-1">
                                        Sesi voting pada periode ini telah diselesaikan.
                                        Pegawai Teladan telah ditetapkan berdasarkan nilai akhir tertinggi.
                                    </p>

                                    <p class="text-xs text-gray-400 mt-2">
                                        Periode masih berstatus aktif sampai proses periode diselesaikan oleh admin.
                                    </p>

                                @else

                                    <p class="text-sm text-gray-500 mt-1">
                                        Pastikan seluruh kandidat telah memiliki persentase kehadiran,
                                        seluruh evaluator telah melakukan penilaian, dan nilai akhir
                                        setiap kandidat telah tersedia sebelum menyelesaikan penilaian.
                                    </p>

                                    <p class="text-xs text-gray-400 mt-2">
                                        Sistem akan melakukan pengecekan kembali saat tombol
                                        <strong>Selesaikan Penilaian</strong> ditekan.
                                    </p>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- RINGKASAN --}}
                {{-- ===================================================== --}}

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">


                    {{-- TOTAL KANDIDAT --}}

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-sm text-gray-500">
                                    Total Kandidat
                                </p>

                                <p class="text-2xl font-bold text-gray-800 mt-1">
                                    {{ $candidates->count() }}
                                </p>

                            </div>


                            <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">

                                <svg
                                    class="w-5 h-5 text-gray-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.5"
                                        d="M17 20h5V4H2v16h5m10 0v-4H7v4m10 0H7"
                                    />
                                </svg>

                            </div>

                        </div>

                    </div>


                    {{-- DATA LENGKAP --}}

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-sm text-gray-500">
                                    Data Lengkap
                                </p>

                                <p class="text-2xl font-bold text-gray-800 mt-1">
                                    {{ $candidates->where('result_status', 'complete')->count() + $candidates->where('result_status', 'winner')->count() }}
                                </p>

                            </div>


                            <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">

                                <svg
                                    class="w-5 h-5 text-gray-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.5"
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>

                            </div>

                        </div>

                    </div>


                    {{-- MENUNGGU --}}

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-sm text-gray-500">
                                    Menunggu Kelengkapan
                                </p>

                                <p class="text-2xl font-bold text-gray-800 mt-1">
                                    {{ $candidates->whereNotIn('result_status', ['complete', 'winner'])->count() }}
                                </p>

                            </div>


                            <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">

                                <svg
                                    class="w-5 h-5 text-gray-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.5"
                                        d="M12 8v4l3 2"
                                    />
                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="9"
                                        fill="none"
                                    />
                                </svg>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- TIDAK ADA KANDIDAT --}}
                {{-- ===================================================== --}}

                @if ($candidates->isEmpty())

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">

                        <div class="p-10 text-center">

                            <div class="w-14 h-14 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-4">

                                <svg
                                    class="w-7 h-7 text-gray-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.5"
                                        d="M17 20h5V4H2v16h5m10 0v-4H7v4"
                                    />
                                </svg>

                            </div>


                            <h3 class="text-lg font-semibold text-gray-800">
                                Belum Ada Kandidat
                            </h3>


                            <p class="text-sm text-gray-500 mt-2">
                                Belum ada pegawai yang dipilih sebagai kandidat pada periode ini.
                            </p>


                            <div class="mt-5">

                                <a
                                    href="{{ route('admin.employees.index') }}"
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-800 text-white text-sm font-semibold hover:bg-gray-700 transition"
                                >
                                    Kelola Kandidat
                                </a>

                            </div>

                        </div>

                    </div>


                @else


                    {{-- ================================================= --}}
                    {{-- DAFTAR KANDIDAT --}}
                    {{-- ================================================= --}}

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">


                        {{-- HEADER --}}

                        <div class="px-6 py-5 border-b border-gray-200">

                            <h3 class="font-semibold text-gray-800">
                                Daftar Kandidat
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Ringkasan hasil penilaian setiap kandidat pada periode aktif.
                            </p>

                        </div>


                        {{-- LIST --}}

                        <div class="divide-y divide-gray-100">


                            @foreach ($candidates as $index => $candidate)


                                {{-- ================================================= --}}
                                {{-- KANDIDAT --}}
                                {{-- ================================================= --}}

                                <div
                                    class="p-6 transition
                                    {{ $candidate->is_winner
                                        ? 'bg-gray-50 border-l-4 border-gray-800'
                                        : 'hover:bg-gray-50' }}"
                                >

                                    <div class="flex flex-col lg:flex-row lg:items-center gap-6">


                                        {{-- RANK --}}

                                        <div class="shrink-0">

                                            <div class="w-10 h-10 rounded-full
                                                {{ $candidate->is_winner
                                                    ? 'bg-gray-800 text-white'
                                                    : 'bg-gray-100 text-gray-700' }}
                                                flex items-center justify-center"
                                            >

                                                @if ($candidate->is_winner)

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

                                                @else

                                                    <span class="text-sm font-bold">
                                                        {{ $index + 1 }}
                                                    </span>

                                                @endif

                                            </div>

                                        </div>


                                        {{-- FOTO --}}

                                        <div class="shrink-0">

                                            @if ($candidate->employee->photo)

                                                <img
                                                    src="{{ asset('storage/' . $candidate->employee->photo) }}"
                                                    alt="{{ $candidate->employee->name }}"
                                                    class="{{ $candidate->is_winner ? 'w-20 h-20' : 'w-16 h-16' }} rounded-full object-cover border {{ $candidate->is_winner ? 'border-gray-300' : 'border-gray-200' }}"
                                                >

                                            @else

                                                <div class="{{ $candidate->is_winner ? 'w-20 h-20' : 'w-16 h-16' }} rounded-full bg-gray-100 flex items-center justify-center border border-gray-200">

                                                    <svg
                                                        class="{{ $candidate->is_winner ? 'w-10 h-10' : 'w-8 h-8' }} text-gray-400"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0"
                                                        />
                                                    </svg>

                                                </div>

                                            @endif

                                        </div>


                                        {{-- INFORMASI KANDIDAT --}}

                                        <div class="flex-1 min-w-0">

                                            <div class="flex flex-wrap items-center gap-2">

                                                <h4 class="{{ $candidate->is_winner ? 'text-lg font-bold text-gray-900' : 'font-semibold text-gray-800' }}">

                                                    {{ $candidate->employee->name }}

                                                </h4>


                                                @if ($candidate->is_winner)

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

                                                @endif

                                            </div>


                                            <p class="text-sm text-gray-500 mt-1">
                                                NIP: {{ $candidate->employee->nip }}
                                            </p>


                                            <p class="text-sm text-gray-500">
                                                {{ $candidate->employee->pokja ?? '-' }}
                                                ·
                                                {{ $candidate->employee->position ?? '-' }}
                                            </p>

                                        </div>


                                        {{-- PROGRESS PENILAIAN --}}

                                        <div class="w-full lg:w-52 shrink-0">

                                            <div class="flex items-center justify-between mb-2">

                                                <span class="text-xs font-medium text-gray-500">
                                                    Progress Penilaian
                                                </span>

                                                <span class="text-xs font-semibold text-gray-700">
                                                    {{ $candidate->assessment_progress }}%
                                                </span>

                                            </div>


                                            <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">

                                                <div
                                                    class="h-full bg-gray-700 rounded-full transition-all"
                                                    style="width: {{ min($candidate->assessment_progress, 100) }}%"
                                                ></div>

                                            </div>


                                            <p class="text-xs text-gray-400 mt-2">

                                                {{ $candidate->submitted_assessments_count }}

                                                /

                                                {{ $candidate->total_evaluators }}

                                                evaluator

                                            </p>

                                        </div>


                                        {{-- KEHADIRAN --}}

                                        <div class="w-full lg:w-28 shrink-0">

                                            <p class="text-xs text-gray-500">
                                                Kehadiran
                                            </p>


                                            <p class="text-lg font-bold text-gray-800 mt-1">

                                                @if ($candidate->attendance_percentage !== null)

                                                    {{ number_format($candidate->attendance_percentage, 2) }}%

                                                @else

                                                    -

                                                @endif

                                            </p>

                                        </div>


                                        {{-- NILAI AKHIR --}}

                                        <div class="w-full lg:w-28 shrink-0">

                                            <p class="text-xs text-gray-500">
                                                Nilai Akhir
                                            </p>


                                            <p class="{{ $candidate->is_winner ? 'text-2xl' : 'text-lg' }} font-bold text-gray-800 mt-1">

                                                @if ($candidate->final_score !== null)

                                                    {{ number_format($candidate->final_score, 2) }}

                                                @else

                                                    -

                                                @endif

                                            </p>

                                        </div>


                                        {{-- STATUS --}}

                                        <div class="w-full lg:w-32 shrink-0">

                                            <p class="text-xs text-gray-500 mb-2">
                                                Status
                                            </p>


                                            @if ($candidate->result_status === 'attendance')

                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">
                                                    Kehadiran Belum Diisi
                                                </span>


                                            @elseif ($candidate->result_status === 'assessment')

                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">
                                                    Penilaian Belum Lengkap
                                                </span>


                                            @elseif ($candidate->result_status === 'calculation')

                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">
                                                    Nilai Belum Tersedia
                                                </span>


                                            @elseif ($candidate->result_status === 'winner')

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


                                            @else

                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">
                                                    Lengkap
                                                </span>

                                            @endif

                                        </div>


                                        {{-- DETAIL --}}

                                        <div class="shrink-0">

                                            <a
                                                href="{{ route('admin.assessment-results.show', $candidate) }}"
                                                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition"
                                            >

                                                Detail

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
                                                        d="M9 5l7 7-7 7"
                                                    />
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