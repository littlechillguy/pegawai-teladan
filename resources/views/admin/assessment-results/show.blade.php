<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Detail Nilai Kandidat
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Rincian hasil penilaian pegawai
                </p>
            </div>

            <a
                href="{{ route('admin.assessment-results.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium"
            >
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Informasi Kandidat --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

                <div class="flex items-center gap-5">

                    {{-- Foto --}}
                    @if ($candidate->employee->photo)
                        <img
                            src="{{ asset('storage/' . $candidate->employee->photo) }}"
                            alt="{{ $candidate->employee->name }}"
                            class="w-20 h-20 rounded-full object-cover border-2 border-gray-200"
                        >
                    @else
                        <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center text-2xl font-bold text-gray-500">
                            {{ strtoupper(substr($candidate->employee->name, 0, 1)) }}
                        </div>
                    @endif

                    <div>
                        <h3 class="text-xl font-bold text-gray-800">
                            {{ $candidate->employee->name }}
                        </h3>

                        <p class="text-sm text-gray-500">
                            NIP: {{ $candidate->employee->nip }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $candidate->employee->department }}
                            •
                            {{ $candidate->employee->position }}
                        </p>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ $candidate->period->name }}
                        </p>
                    </div>

                </div>

            </div>


            {{-- Rincian Nilai --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">
                        Rincian Perhitungan Nilai
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Nilai akhir dihitung berdasarkan bobot masing-masing kriteria.
                    </p>
                </div>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                                    Kriteria
                                </th>

                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">
                                    Nilai
                                </th>

                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">
                                    Bobot
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase">
                                    Nilai Berbobot
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @foreach ($details as $detail)

                                <tr class="hover:bg-gray-50">

                                    <td class="px-6 py-5">

                                        <div class="font-semibold text-gray-800">
                                            {{ $detail['criterion']->name }}
                                        </div>

                                    </td>

                                    <td class="px-6 py-5 text-center">

                                        <span class="font-semibold text-gray-800">
                                            {{ number_format($detail['raw_score'], 2) }}
                                        </span>

                                        <span class="text-gray-400 text-sm">
                                            / 100
                                        </span>

                                    </td>

                                    <td class="px-6 py-5 text-center">

                                        <span class="text-gray-600">
                                            {{ number_format($detail['weight'], 0) }}%
                                        </span>

                                    </td>

                                    <td class="px-6 py-5 text-right">

                                        <span class="font-bold text-gray-800">
                                            {{ number_format($detail['weighted_score'], 2) }}
                                        </span>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                        <tfoot class="bg-gray-50">

                            <tr>

                                <td
                                    colspan="3"
                                    class="px-6 py-5 text-right font-bold text-gray-800"
                                >
                                    NILAI AKHIR
                                </td>

                                <td class="px-6 py-5 text-right">

                                    <span class="text-2xl font-bold text-indigo-600">
                                        {{ number_format($finalScore, 2) }}
                                    </span>

                                    <span class="text-gray-400">
                                        / 100
                                    </span>

                                </td>

                            </tr>

                        </tfoot>

                    </table>

                </div>

            </div>


            {{-- Informasi Kehadiran --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

                <h3 class="text-lg font-bold text-gray-800">
                    Informasi Kehadiran
                </h3>

                <div class="mt-4 flex items-center justify-between">

                    <div>
                        <p class="text-sm text-gray-500">
                            Persentase Kehadiran
                        </p>

                        <p class="text-2xl font-bold text-gray-800 mt-1">
                            {{ number_format($candidate->attendance_percentage, 2) }}%
                        </p>
                    </div>

                    <div class="w-48">

                        <div class="w-full bg-gray-200 rounded-full h-3">

                            <div
                                class="bg-indigo-600 h-3 rounded-full"
                                style="width: {{ min(100, $candidate->attendance_percentage) }}%"
                            ></div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>