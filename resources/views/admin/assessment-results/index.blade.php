<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Hasil Penilaian
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Hasil penilaian kandidat pada periode aktif
                </p>
            </div>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">


            {{-- Flash Success --}}
            @if (session('success'))

                <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl p-4">
                    {{ session('success') }}
                </div>

            @endif


            {{-- Flash Error --}}
            @if (session('error'))

                <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4">
                    {{ session('error') }}
                </div>

            @endif


            {{-- Validation Error --}}
            @if ($errors->any())

                <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4">

                    <ul class="list-disc list-inside text-sm space-y-1">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- Tidak ada periode aktif --}}
            @if (!$activePeriod)

                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-10 text-center">

                    <div class="text-5xl mb-4">
                        📅
                    </div>

                    <h3 class="text-lg font-bold text-gray-800">
                        Belum Ada Periode Aktif
                    </h3>

                    <p class="text-sm text-gray-500 mt-2">
                        Hasil penilaian akan muncul ketika terdapat periode yang sedang aktif.
                    </p>

                </div>

            @else


                {{-- Header Periode --}}
                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6">

                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Periode Aktif
                            </p>

                            <h3 class="text-2xl font-bold text-gray-800 mt-1">
                                {{ $activePeriod->name }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-2">

                                {{ $activePeriod->start_date->format('d F Y') }}

                                -

                                {{ $activePeriod->end_date->format('d F Y') }}

                            </p>

                        </div>


                        {{-- Status keseluruhan --}}
                        <div>

                            @if ($allComplete)

                                <div class="inline-flex items-center gap-2 px-4 py-3 rounded-xl bg-green-50 border border-green-200 text-green-700">

                                    <span class="text-lg">
                                        ✓
                                    </span>

                                    <div>

                                        <p class="font-semibold text-sm">
                                            Seluruh Data Lengkap
                                        </p>

                                        <p class="text-xs mt-0.5">
                                            Sistem telah menentukan hasil berdasarkan nilai tertinggi.
                                        </p>

                                    </div>

                                </div>

                            @else

                                <div class="inline-flex items-center gap-2 px-4 py-3 rounded-xl bg-yellow-50 border border-yellow-200 text-yellow-700">

                                    <span class="text-lg">
                                        ⏳
                                    </span>

                                    <div>

                                        <p class="font-semibold text-sm">
                                            Penilaian Belum Selesai
                                        </p>

                                        <p class="text-xs mt-0.5">
                                            Sistem menunggu seluruh data kandidat lengkap.
                                        </p>

                                    </div>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- Ringkasan --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

                    {{-- Kandidat --}}
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

                        <p class="text-sm text-gray-500">
                            Total Kandidat
                        </p>

                        <p class="text-3xl font-bold text-gray-800 mt-2">
                            {{ $candidates->count() }}
                        </p>

                    </div>


                    {{-- Evaluator --}}
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

                        <p class="text-sm text-gray-500">
                            Evaluator Aktif
                        </p>

                        <p class="text-3xl font-bold text-gray-800 mt-2">
                            {{ $totalEvaluators }}
                        </p>

                        <p class="text-xs text-gray-400 mt-1">
                            Kandidat tidak menilai dirinya sendiri
                        </p>

                    </div>


                    {{-- Status --}}
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

                        <p class="text-sm text-gray-500">
                            Status Penilaian
                        </p>

                        @if ($allComplete)

                            <p class="text-lg font-bold text-green-600 mt-2">
                                Selesai
                            </p>

                        @else

                            <p class="text-lg font-bold text-yellow-600 mt-2">
                                Berlangsung
                            </p>

                        @endif

                    </div>

                </div>


                {{-- Tidak ada kandidat --}}
                @if ($candidates->isEmpty())

                    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-10 text-center">

                        <div class="text-5xl mb-4">
                            👥
                        </div>

                        <h3 class="text-lg font-bold text-gray-800">
                            Belum Ada Kandidat
                        </h3>

                        <p class="text-sm text-gray-500 mt-2">
                            Silakan tambahkan kandidat terlebih dahulu pada periode aktif.
                        </p>

                        <a
                            href="{{ route('admin.candidates.index') }}"
                            class="inline-flex items-center px-5 py-2.5 mt-5 bg-gray-900 hover:bg-gray-800 text-white rounded-lg text-sm font-medium"
                        >
                            Kelola Kandidat
                        </a>

                    </div>

                @else


                    {{-- Daftar Kandidat --}}
                    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">

                        <div class="p-6 border-b border-gray-100">

                            <h3 class="text-lg font-bold text-gray-800">
                                Hasil Kandidat
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Kandidat diurutkan berdasarkan nilai akhir tertinggi.
                            </p>

                        </div>


                        <div class="divide-y divide-gray-100">

                            @foreach ($candidates as $index => $candidate)

                                <div class="p-6">

                                    <div class="flex flex-col xl:flex-row xl:items-center gap-6">


                                        {{-- Ranking --}}
                                        <div class="flex-shrink-0">

                                            @if ($candidate->is_winner)

                                                <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center text-xl">
                                                    🏆
                                                </div>

                                            @else

                                                <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center font-bold text-gray-500">
                                                    {{ $index + 1 }}
                                                </div>

                                            @endif

                                        </div>


                                        {{-- Foto --}}
                                        <div class="flex-shrink-0">

                                            @if ($candidate->employee->photo)

                                                <img
                                                    src="{{ asset('storage/' . $candidate->employee->photo) }}"
                                                    alt="{{ $candidate->employee->name }}"
                                                    class="w-16 h-16 rounded-full object-cover border border-gray-200"
                                                >

                                            @else

                                                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center text-xl font-bold text-gray-500">

                                                    {{ strtoupper(substr($candidate->employee->name, 0, 1)) }}

                                                </div>

                                            @endif

                                        </div>


                                        {{-- Informasi --}}
                                        <div class="flex-1 min-w-0">

                                            <div class="flex flex-col sm:flex-row sm:items-center gap-2">

                                                <h4 class="text-lg font-bold text-gray-800">
                                                    {{ $candidate->employee->name }}
                                                </h4>


                                                @if ($candidate->is_winner)

                                                    <span class="inline-flex w-fit items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                                        🏆 Pegawai Teladan
                                                    </span>

                                                @endif

                                            </div>


                                            <p class="text-sm text-gray-500 mt-1">
                                                NIP: {{ $candidate->employee->nip }}
                                            </p>

                                            <p class="text-sm text-gray-500">
                                                {{ $candidate->employee->department }}
                                                •
                                                {{ $candidate->employee->position }}
                                            </p>


                                            {{-- Progress --}}
                                            <div class="mt-4 max-w-xl">

                                                <div class="flex items-center justify-between mb-1">

                                                    <span class="text-xs text-gray-500">
                                                        Progress Penilaian
                                                    </span>

                                                    <span class="text-xs font-semibold text-gray-700">
                                                        {{ $candidate->assessment_progress }}%
                                                    </span>

                                                </div>


                                                <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">

                                                    <div
                                                        class="h-2 rounded-full
                                                        @if ($candidate->assessment_progress >= 100)
                                                            bg-green-500
                                                        @elseif ($candidate->assessment_progress > 0)
                                                            bg-yellow-500
                                                        @else
                                                            bg-gray-300
                                                        @endif"
                                                        style="width: {{ min(100, $candidate->assessment_progress) }}%"
                                                    ></div>

                                                </div>


                                                <p class="text-xs text-gray-400 mt-1">

                                                    {{ $candidate->submitted_assessments_count }}

                                                    dari

                                                    {{ $candidate->total_evaluators }}

                                                    evaluator telah menilai

                                                </p>

                                            </div>

                                        </div>


                                        {{-- Attendance --}}
                                        <div class="xl:w-32">

                                            <p class="text-xs text-gray-500">
                                                Kehadiran
                                            </p>


                                            @if ($candidate->attendance_percentage !== null)

                                                <p class="text-xl font-bold text-gray-800 mt-1">
                                                    {{ number_format($candidate->attendance_percentage, 2) }}%
                                                </p>

                                            @else

                                                <p class="text-sm font-semibold text-yellow-600 mt-1">
                                                    Belum diisi
                                                </p>

                                            @endif

                                        </div>


                                        {{-- Final Score --}}
                                        <div class="xl:w-32">

                                            <p class="text-xs text-gray-500">
                                                Nilai Akhir
                                            </p>


                                            @if ($candidate->final_score !== null)

                                                <p class="text-2xl font-bold text-indigo-600 mt-1">
                                                    {{ number_format($candidate->final_score, 2) }}
                                                </p>

                                                <p class="text-xs text-gray-400">
                                                    / 100
                                                </p>

                                            @else

                                                <p class="text-sm font-semibold text-gray-400 mt-1">
                                                    Belum tersedia
                                                </p>

                                            @endif

                                        </div>


                                        {{-- Status --}}
                                        <div class="xl:w-40">

                                            @if ($candidate->result_status === 'winner')

                                                <span class="inline-flex items-center px-3 py-2 rounded-lg bg-yellow-100 text-yellow-700 text-sm font-semibold">
                                                    🏆 Pemenang
                                                </span>


                                            @elseif ($candidate->result_status === 'complete')

                                                <span class="inline-flex items-center px-3 py-2 rounded-lg bg-green-100 text-green-700 text-sm font-semibold">
                                                    ✓ Selesai
                                                </span>


                                            @elseif ($candidate->result_status === 'attendance')

                                                <span class="inline-flex items-center px-3 py-2 rounded-lg bg-red-100 text-red-700 text-sm font-semibold">
                                                    Attendance belum diisi
                                                </span>


                                            @elseif ($candidate->result_status === 'assessment')

                                                <span class="inline-flex items-center px-3 py-2 rounded-lg bg-yellow-100 text-yellow-700 text-sm font-semibold">
                                                    Menunggu Penilaian
                                                </span>


                                            @else

                                                <span class="inline-flex items-center px-3 py-2 rounded-lg bg-gray-100 text-gray-600 text-sm font-semibold">
                                                    Menunggu Perhitungan
                                                </span>

                                            @endif

                                        </div>


                                        {{-- Detail --}}
                                        <div class="flex-shrink-0">

                                            <a
                                                href="{{ route('admin.assessment-results.show', $candidate) }}"
                                                class="inline-flex items-center justify-center px-4 py-2.5 bg-gray-900 hover:bg-gray-800 text-white rounded-lg text-sm font-medium"
                                            >
                                                Lihat Detail
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