<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard Admin
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Ruang Keteladanan — PPSDM
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Welcome --}}
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    Selamat Datang, {{ auth()->user()->employee->name }}
                </h1>

                <p class="mt-1 text-gray-500">
                    Kelola proses pemilihan pegawai teladan melalui Ruang Keteladanan.
                </p>
            </div>


            {{-- Statistics --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- Total Pegawai --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <p class="text-sm font-medium text-gray-500">
                        Pegawai Aktif
                    </p>

                    <p class="mt-2 text-3xl font-bold text-gray-800">
                        {{ $totalEmployees }}
                    </p>

                    <p class="mt-1 text-sm text-gray-500">
                        Pegawai terdaftar
                    </p>
                </div>


                {{-- Kandidat --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <p class="text-sm font-medium text-gray-500">
                        Kandidat Periode Aktif
                    </p>

                    <p class="mt-2 text-3xl font-bold text-gray-800">
                        {{ $totalCandidates }}
                    </p>

                    <p class="mt-1 text-sm text-gray-500">
                        Kandidat pegawai teladan
                    </p>
                </div>


                {{-- Penilaian --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <p class="text-sm font-medium text-gray-500">
                        Penilaian Masuk
                    </p>

                    <p class="mt-2 text-3xl font-bold text-gray-800">
                        {{ $totalAssessments }}
                    </p>

                    <p class="mt-1 text-sm text-gray-500">
                        Penilaian telah dikirim
                    </p>
                </div>


                {{-- Periode --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <p class="text-sm font-medium text-gray-500">
                        Status Periode
                    </p>

                    <p class="mt-2 text-xl font-bold text-gray-800">
                        {{ $activePeriod ? 'Aktif' : 'Tidak Ada' }}
                    </p>

                    <p class="mt-1 text-sm text-gray-500">
                        Periode pemilihan
                    </p>
                </div>

            </div>


            {{-- Active Period --}}
            <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-100 p-6">

                <h3 class="text-lg font-semibold text-gray-800">
                    Periode Aktif
                </h3>

                @if($activePeriod)

                    <div class="mt-4">

                        <p class="text-xl font-bold text-gray-800">
                            {{ $activePeriod->name }}
                        </p>

                        <p class="mt-2 text-sm text-gray-500">
                            {{ $activePeriod->start_date->format('d M Y') }}
                            -
                            {{ $activePeriod->end_date->format('d M Y') }}
                        </p>

                    </div>

                @else

                    <p class="mt-4 text-gray-500">
                        Saat ini tidak ada periode pemilihan yang aktif.
                    </p>

                @endif

            </div>


            {{-- Penilaian Admin --}}
            @if($activePeriod)

                <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

                    {{-- Header --}}
                    <div class="px-6 py-5 border-b border-gray-100">

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">
                                    Penilaian Kandidat
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    Berikan penilaian Anda untuk kandidat pada periode
                                    {{ $activePeriod->name }}.
                                </p>
                            </div>

                            <span class="inline-flex items-center w-fit px-3 py-1.5 rounded-full bg-blue-50 text-blue-700 text-sm font-medium">
                                {{ $candidates->count() }} Kandidat
                            </span>

                        </div>

                    </div>


                    {{-- Tidak ada kandidat --}}
                    @if($candidates->isEmpty())

                        <div class="p-8 text-center">

                            <div class="w-14 h-14 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                <span class="text-2xl text-gray-400">
                                    —
                                </span>
                            </div>

                            <h4 class="font-semibold text-gray-800">
                                Belum ada kandidat
                            </h4>

                            <p class="text-sm text-gray-500 mt-1">
                                Belum ada pegawai yang dipilih sebagai kandidat pada periode ini.
                            </p>

                        </div>

                    @else

                        {{-- Daftar Kandidat --}}
                        <div class="divide-y divide-gray-100">

                            @foreach($candidates as $candidate)

                                <div class="p-6">

                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">

                                        {{-- Data Kandidat --}}
                                        <div class="flex items-center gap-4 min-w-0">

                                            {{-- Foto --}}
                                            @if($candidate->employee->photo)

                                                <img
                                                    src="{{ asset('storage/' . $candidate->employee->photo) }}"
                                                    alt="{{ $candidate->employee->name }}"
                                                    class="w-14 h-14 rounded-full object-cover border border-gray-200 flex-shrink-0"
                                                >

                                            @else

                                                <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center border border-gray-200 flex-shrink-0">

                                                    <span class="text-lg font-bold text-gray-500">
                                                        {{ strtoupper(substr($candidate->employee->name, 0, 1)) }}
                                                    </span>

                                                </div>

                                            @endif


                                            {{-- Informasi --}}
                                            <div class="min-w-0">

                                                <h4 class="font-semibold text-gray-900">
                                                    {{ $candidate->employee->name }}
                                                </h4>

                                                <div class="flex flex-wrap items-center gap-x-2 gap-y-1 mt-1">

                                                    <span class="text-sm text-gray-500">
                                                        {{ $candidate->employee->nip }}
                                                    </span>

                                                    <span class="text-gray-300">
                                                        •
                                                    </span>

                                                    <span class="text-sm text-gray-500">
                                                        {{ $candidate->employee->pokja }}
                                                    </span>

                                                    <span class="text-gray-300">
                                                        •
                                                    </span>

                                                    <span class="text-sm text-gray-500">
                                                        {{ $candidate->employee->position }}
                                                    </span>

                                                </div>

                                            </div>

                                        </div>


                                        {{-- Tombol Penilaian --}}
                                        <div class="flex-shrink-0">

                                            @if(in_array($candidate->id, $assessedCandidateIds))

                                                <span class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-green-50 text-green-700 text-sm font-semibold">
                                                    ✓ Sudah Dinilai
                                                </span>

                                            @else

                                                <a
                                                    href="{{ route('assessment.create', $candidate) }}"
                                                    class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition"
                                                >
                                                    Nilai Kandidat
                                                </a>

                                            @endif

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @endif

                </div>

            @endif

        </div>
    </div>

</x-app-layout>