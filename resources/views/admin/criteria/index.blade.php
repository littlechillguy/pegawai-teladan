<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Kriteria Penilaian
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Kelola kriteria dan bobot penilaian Pegawai Teladan.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Informasi --}}
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 mb-6">

                <div class="flex items-start gap-3">

                    <div class="text-blue-600 text-lg">
                        ℹ
                    </div>

                    <div>
                        <h3 class="font-semibold text-blue-800">
                            Bobot Penilaian
                        </h3>

                        <p class="text-sm text-blue-700 mt-1">
                            Total seluruh bobot kriteria harus berjumlah
                            <strong>100%</strong>.
                        </p>
                    </div>

                </div>

            </div>


            {{-- Tabel --}}
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-800">
                        Daftar Kriteria
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Kriteria yang digunakan dalam proses penilaian.
                    </p>
                </div>


                <div class="overflow-x-auto">

                    <table class="w-full text-sm text-left">

                        <thead class="bg-gray-50 border-b border-gray-200">

                            <tr>

                                <th class="px-6 py-4 font-semibold text-gray-600">
                                    #
                                </th>

                                <th class="px-6 py-4 font-semibold text-gray-600">
                                    Kriteria
                                </th>

                                <th class="px-6 py-4 font-semibold text-gray-600">
                                    Bobot
                                </th>

                                <th class="px-6 py-4 font-semibold text-gray-600">
                                    Jumlah Pertanyaan
                                </th>

                                <th class="px-6 py-4 font-semibold text-gray-600">
                                    Keterangan
                                </th>

                                <th class="px-6 py-4 font-semibold text-gray-600 text-right">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100">

                            @forelse ($criteria as $criterion)

                                <tr class="hover:bg-gray-50">

                                    <td class="px-6 py-4 text-gray-500">
                                        {{ $loop->iteration }}
                                    </td>


                                    <td class="px-6 py-4">

                                        <p class="font-medium text-gray-800">
                                            {{ $criterion->name }}
                                        </p>

                                    </td>


                                    <td class="px-6 py-4">

                                        <span
                                            class="inline-flex px-3 py-1 rounded-full bg-gray-100 text-gray-700 font-semibold">
                                            {{ number_format($criterion->weight, 0) }}%
                                        </span>

                                    </td>


                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $criterion->questions_count }}
                                        pertanyaan
                                    </td>


                                    <td class="px-6 py-4">

                                        @if ($criterion->name === 'Kehadiran')

                                            <span class="text-xs text-gray-500">
                                                Diinput oleh admin
                                            </span>

                                        @else

                                            <span class="text-xs text-gray-500">
                                                Dinilai melalui pertanyaan
                                            </span>

                                        @endif

                                    </td>


                                    <td class="px-6 py-4 text-right">

                                        <a href="{{ route('admin.questions.index', $criterion) }}"
                                            class="inline-flex items-center px-3 py-2 rounded-lg bg-gray-100 text-gray-700 text-xs font-semibold hover:bg-gray-200">
                                            Kelola Pertanyaan
                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                        Belum ada kriteria penilaian.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>


                        <tfoot class="bg-gray-50 border-t border-gray-200">

                            <tr>

                                <td colspan="2" class="px-6 py-4 text-right font-semibold text-gray-700">
                                    Total Bobot
                                </td>

                                <td class="px-6 py-4">

                                    @php
                                        $totalWeight = $criteria->sum('weight');
                                    @endphp

                                    <span class="inline-flex px-3 py-1 rounded-full text-sm font-bold
                                        {{ $totalWeight == 100
    ? 'bg-green-100 text-green-700'
    : 'bg-red-100 text-red-700' }}">
                                        {{ number_format($totalWeight, 0) }}%
                                    </span>

                                </td>

                                <td colspan="3"></td>

                            </tr>

                        </tfoot>

                    </table>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>