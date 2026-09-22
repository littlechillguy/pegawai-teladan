<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Dashboard Pegawai
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Selamat datang, {{ $employee->name }}
            </p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Informasi Pegawai --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">

                <div class="flex flex-col sm:flex-row sm:items-center gap-5">

                    {{-- Foto --}}
                    <div class="shrink-0">

                        @if ($employee->photo)
                            <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}"
                                class="w-20 h-20 rounded-full object-cover border border-gray-200">
                        @else
                            <div class="w-20 h-20 rounded-full bg-indigo-100 flex items-center justify-center">
                                <span class="text-2xl font-semibold text-indigo-600">
                                    {{ strtoupper(substr($employee->name, 0, 1)) }}
                                </span>
                            </div>
                        @endif

                    </div>

                    {{-- Data --}}
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">
                            {{ $employee->name }}
                        </h3>

                        <p class="text-sm text-gray-500">
                            NIP: {{ $employee->nip }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $employee->position }} — {{ $employee->department }}
                        </p>
                    </div>

                </div>

            </div>


            {{-- Periode Aktif --}}
            @if ($activePeriod)

                <div class="mb-6">

                    <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-5">

                        <p class="text-sm font-medium text-indigo-600">
                            Periode Penilaian Aktif
                        </p>

                        <h3 class="text-xl font-bold text-gray-800 mt-1">
                            {{ $activePeriod->name }}
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ $activePeriod->start_date->format('d M Y') }}
                            -
                            {{ $activePeriod->end_date->format('d M Y') }}
                        </p>

                    </div>

                </div>

                {{-- Kandidat --}}
                <div class="mb-4">

                    <h3 class="text-lg font-semibold text-gray-800">
                        Kandidat Pegawai Teladan
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Pilih kandidat yang ingin Anda berikan penilaian.
                    </p>

                </div>


                @if ($candidates->count())

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                        @foreach ($candidates as $candidate)

                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

                                {{-- Foto Kandidat --}}
                                <div class="p-6 flex justify-center">

                                    @if ($candidate->employee->photo)

                                        <img src="{{ asset('storage/' . $candidate->employee->photo) }}"
                                            alt="{{ $candidate->employee->name }}"
                                            class="w-28 h-28 rounded-full object-cover border-4 border-gray-100">

                                    @else

                                        <div class="w-28 h-28 rounded-full bg-gray-100 flex items-center justify-center">

                                            <span class="text-3xl font-semibold text-gray-500">
                                                {{ strtoupper(substr($candidate->employee->name, 0, 1)) }}
                                            </span>

                                        </div>

                                    @endif

                                </div>


                                {{-- Informasi --}}
                                <div class="px-6 pb-6 text-center">

                                    <h4 class="text-lg font-semibold text-gray-800">
                                        {{ $candidate->employee->name }}
                                    </h4>

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $candidate->employee->position }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        {{ $candidate->employee->department }}
                                    </p>


                                    {{-- Tombol Penilaian --}}
                                    @if (in_array($candidate->id, $assessedCandidateIds))
    <span class="inline-flex items-center rounded-lg bg-green-100 px-4 py-2 text-sm font-semibold text-green-700">
        ✓ Sudah Dinilai
    </span>
@else
    <a
        href="{{ route('assessment.create', $candidate) }}"
        class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-700"
    >
        Nilai Kandidat
    </a>
@endif

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="bg-white rounded-xl border border-gray-200 p-8 text-center">

                        <div class="text-gray-400 text-4xl mb-3">
                            —
                        </div>

                        <h3 class="text-lg font-medium text-gray-700">
                            Belum ada kandidat
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Belum ada kandidat yang tersedia untuk dinilai pada periode ini.
                        </p>

                    </div>

                @endif

            @else

                {{-- Tidak ada periode --}}
                <div class="bg-white rounded-xl border border-gray-200 p-8 text-center">

                    <h3 class="text-lg font-medium text-gray-700">
                        Belum ada periode aktif
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Penilaian pegawai belum dibuka.
                    </p>

                </div>

            @endif

        </div>
    </div>

</x-app-layout>