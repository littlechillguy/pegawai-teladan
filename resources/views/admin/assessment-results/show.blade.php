<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detail Hasil Penilaian
            </h2>

            <p class="text-sm text-gray-500">
                Detail penilaian kandidat dan daftar pegawai yang belum memberikan penilaian.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Back --}}
            <div class="mb-6">
                <a
                    href="{{ route('admin.assessment-results.index') }}"
                    class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900"
                >
                    ← Kembali ke Hasil Penilaian
                </a>
            </div>

            {{-- Informasi Kandidat --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">

                <div class="px-6 py-5 border-b border-gray-200">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                Informasi Kandidat
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $candidate->period->name }}
                            </p>
                        </div>

                        @if ($candidate->is_winner)
                            <span class="inline-flex items-center w-fit px-3 py-1.5 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold">
                                🏆 Pegawai Teladan
                            </span>
                        @endif

                    </div>
                </div>

                <div class="p-6">
                    <div class="flex flex-col md:flex-row gap-6">

                        {{-- Foto --}}
                        <div class="flex-shrink-0">
                            @if ($candidate->employee->photo)
                                <img
                                    src="{{ asset('storage/' . $candidate->employee->photo) }}"
                                    alt="{{ $candidate->employee->name }}"
                                    class="w-28 h-28 rounded-xl object-cover border border-gray-200"
                                >
                            @else
                                <div class="w-28 h-28 rounded-xl bg-gray-100 flex items-center justify-center border border-gray-200">
                                    <span class="text-3xl font-bold text-gray-400">
                                        {{ strtoupper(substr($candidate->employee->name, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        {{-- Data --}}
                        <div class="flex-1">

                            <h4 class="text-2xl font-bold text-gray-900">
                                {{ $candidate->employee->name }}
                            </h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wide">
                                        NIP
                                    </p>

                                    <p class="text-sm font-medium text-gray-900 mt-1">
                                        {{ $candidate->employee->nip }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wide">
                                        Pokja
                                    </p>

                                    <p class="text-sm font-medium text-gray-900 mt-1">
                                        {{ $candidate->employee->pokja }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wide">
                                        Jabatan
                                    </p>

                                    <p class="text-sm font-medium text-gray-900 mt-1">
                                        {{ $candidate->employee->position }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wide">
                                        Periode
                                    </p>

                                    <p class="text-sm font-medium text-gray-900 mt-1">
                                        {{ $candidate->period->name }}
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>


            {{-- Ringkasan Nilai --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">

                {{-- Kehadiran --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <p class="text-sm text-gray-500">
                        Nilai Kehadiran
                    </p>

                    <p class="text-3xl font-bold text-gray-900 mt-2">
                        {{ $candidate->attendance_percentage !== null
                            ? number_format($candidate->attendance_percentage, 2)
                            : '-' }}
                    </p>

                    <p class="text-xs text-gray-500 mt-1">
                        Bobot 10%
                    </p>
                </div>


                {{-- Nilai Akhir --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <p class="text-sm text-gray-500">
                        Nilai Akhir
                    </p>

                    <p class="text-3xl font-bold text-blue-600 mt-2">
                        {{ number_format($finalScore, 2) }}
                    </p>

                    <p class="text-xs text-gray-500 mt-1">
                        Total seluruh kriteria
                    </p>
                </div>


                {{-- Status --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <p class="text-sm text-gray-500">
                        Status
                    </p>

                    @if ($candidate->is_winner)
                        <p class="text-lg font-bold text-yellow-600 mt-2">
                            🏆 Pegawai Teladan
                        </p>

                        <p class="text-xs text-gray-500 mt-1">
                            {{ $candidate->period->name }}
                        </p>
                    @else
                        <p class="text-lg font-bold text-gray-900 mt-2">
                            Selesai Dinilai
                        </p>

                        <p class="text-xs text-gray-500 mt-1">
                            Kandidat
                        </p>
                    @endif
                </div>

            </div>


            {{-- Breakdown Nilai --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">

                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Rincian Nilai
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Perhitungan nilai berdasarkan masing-masing kriteria.
                    </p>
                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">
                            <tr>

                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Kriteria
                                </th>

                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Nilai
                                </th>

                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Bobot
                                </th>

                                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Nilai Berbobot
                                </th>

                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-100">

                            @foreach ($details as $detail)

                                <tr class="hover:bg-gray-50">

                                    <td class="px-6 py-4">

                                        <p class="font-medium text-gray-900">
                                            {{ $detail['criterion']->name }}
                                        </p>

                                    </td>

                                    <td class="px-6 py-4 text-center">

                                        <span class="font-medium text-gray-900">
                                            {{ number_format($detail['raw_score'], 2) }}
                                        </span>

                                    </td>

                                    <td class="px-6 py-4 text-center">

                                        <span class="text-gray-600">
                                            {{ number_format($detail['weight'], 0) }}%
                                        </span>

                                    </td>

                                    <td class="px-6 py-4 text-right">

                                        <span class="font-semibold text-gray-900">
                                            {{ number_format($detail['weighted_score'], 2) }}
                                        </span>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                        <tfoot class="bg-gray-50 border-t border-gray-200">

                            <tr>

                                <td
                                    colspan="3"
                                    class="px-6 py-4 text-right font-semibold text-gray-900"
                                >
                                    Nilai Akhir
                                </td>

                                <td class="px-6 py-4 text-right">

                                    <span class="text-xl font-bold text-blue-600">
                                        {{ number_format($finalScore, 2) }}
                                    </span>

                                </td>

                            </tr>

                        </tfoot>

                    </table>

                </div>

            </div>


            {{-- Pegawai yang Belum Menilai --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">

                <div class="px-6 py-5 border-b border-gray-200">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                Pegawai yang Belum Mengisi Penilaian
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Daftar pegawai aktif yang belum memberikan penilaian kepada kandidat ini.
                            </p>
                        </div>

                        @if ($pendingEvaluators->isNotEmpty())

                            <span class="inline-flex items-center w-fit px-3 py-1.5 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold">
                                {{ $pendingEvaluators->count() }} Belum Menilai
                            </span>

                        @else

                            <span class="inline-flex items-center w-fit px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                                Semua Sudah Menilai
                            </span>

                        @endif

                    </div>

                </div>


                @if ($pendingEvaluators->isEmpty())

                    {{-- Semua sudah menilai --}}
                    <div class="p-8 text-center">

                        <div class="w-14 h-14 mx-auto rounded-full bg-green-100 flex items-center justify-center mb-4">
                            <span class="text-2xl text-green-600">
                                ✓
                            </span>
                        </div>

                        <h4 class="font-semibold text-gray-900">
                            Semua pegawai sudah mengisi penilaian
                        </h4>

                        <p class="text-sm text-gray-500 mt-1">
                            Tidak ada pegawai yang masih menunggu untuk memberikan penilaian.
                        </p>

                    </div>

                @else

                    {{-- Daftar pegawai --}}
                    <div class="divide-y divide-gray-100">

                        @foreach ($pendingEvaluators as $employee)

                            <div class="px-6 py-4 flex items-center justify-between gap-4 hover:bg-gray-50">

                                <div class="flex items-center gap-4 min-w-0">

                                    {{-- Foto --}}
                                    @if ($employee->photo)

                                        <img
                                            src="{{ asset('storage/' . $employee->photo) }}"
                                            alt="{{ $employee->name }}"
                                            class="w-11 h-11 rounded-full object-cover border border-gray-200 flex-shrink-0"
                                        >

                                    @else

                                        <div class="w-11 h-11 rounded-full bg-gray-100 flex items-center justify-center border border-gray-200 flex-shrink-0">

                                            <span class="text-sm font-semibold text-gray-500">
                                                {{ strtoupper(substr($employee->name, 0, 1)) }}
                                            </span>

                                        </div>

                                    @endif


                                    {{-- Data pegawai --}}
                                    <div class="min-w-0">

                                        <p class="font-medium text-gray-900 truncate">
                                            {{ $employee->name }}
                                        </p>

                                        <div class="flex flex-wrap items-center gap-x-2 gap-y-1 mt-1">

                                            <span class="text-sm text-gray-500">
                                                {{ $employee->nip }}
                                            </span>

                                            <span class="text-gray-300">
                                                •
                                            </span>

                                            <span class="text-sm text-gray-500">
                                                {{ $employee->pokja }}
                                            </span>

                                        </div>

                                    </div>

                                </div>


                                {{-- Status --}}
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold whitespace-nowrap">
                                    Belum Menilai
                                </span>

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>


            {{-- Footer --}}
            <div class="flex justify-end">

                <a
                    href="{{ route('admin.assessment-results.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded-lg hover:bg-gray-900 transition"
                >
                    Kembali ke Hasil Penilaian
                </a>

            </div>

        </div>
    </div>

</x-app-layout>