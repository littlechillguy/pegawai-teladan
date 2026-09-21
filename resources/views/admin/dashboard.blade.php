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

        </div>
    </div>

</x-app-layout>