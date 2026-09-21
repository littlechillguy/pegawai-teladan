<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Pemilihan Kandidat
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Kelola pegawai yang menjadi kandidat Pegawai Teladan.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 px-4 py-3">
                    <p class="text-sm text-green-700">
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            {{-- Periode Aktif --}}
            @if ($activePeriod)

                <div class="bg-white border border-gray-200 rounded-xl shadow-sm mb-6">

                    <div class="px-6 py-5 border-b border-gray-200">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Periode Aktif
                                </p>

                                <h3 class="text-lg font-semibold text-gray-800 mt-1">
                                    {{ $activePeriod->name }}
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $activePeriod->start_date->format('d M Y') }}
                                    -
                                    {{ $activePeriod->end_date->format('d M Y') }}
                                </p>
                            </div>

                            <div>
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                    Aktif
                                </span>
                            </div>

                        </div>
                    </div>

                    <div class="px-6 py-4">
                        <div class="flex items-center justify-between">

                            <div>
                                <p class="text-sm text-gray-500">
                                    Total kandidat
                                </p>

                                <p class="text-2xl font-bold text-gray-800">
                                    {{ $candidates->count() }}
                                </p>
                            </div>

                            <a href="{{ route('admin.candidates.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-lg text-sm font-semibold hover:bg-gray-700">
                                + Pilih Kandidat
                            </a>

                        </div>
                    </div>

                </div>

            @else

                {{-- Tidak ada periode aktif --}}
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 mb-6">

                    <div class="flex items-start gap-4">

                        <div class="text-yellow-600 text-xl">
                            ⚠
                        </div>

                        <div>
                            <h3 class="font-semibold text-yellow-800">
                                Belum ada periode aktif
                            </h3>

                            <p class="text-sm text-yellow-700 mt-1">
                                Aktifkan salah satu periode terlebih dahulu sebelum memilih kandidat.
                            </p>

                            <a href="{{ route('admin.periods.index') }}"
                               class="inline-block mt-3 text-sm font-semibold text-yellow-800 hover:underline">
                                Kelola Periode →
                            </a>
                        </div>

                    </div>

                </div>

            @endif


            {{-- Daftar Kandidat --}}
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-800">
                        Daftar Kandidat
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Kandidat yang dipilih untuk periode aktif.
                    </p>
                </div>


                @if ($candidates->count())

                    <div class="overflow-x-auto">

                        <table class="w-full text-sm text-left">

                            <thead class="bg-gray-50 border-b border-gray-200">

                                <tr>

                                    <th class="px-6 py-4 font-semibold text-gray-600">
                                        Pegawai
                                    </th>

                                    <th class="px-6 py-4 font-semibold text-gray-600">
                                        NIP
                                    </th>

                                    <th class="px-6 py-4 font-semibold text-gray-600">
                                        Departemen
                                    </th>

                                    <th class="px-6 py-4 font-semibold text-gray-600">
                                        Jabatan
                                    </th>

                                    <th class="px-6 py-4 font-semibold text-gray-600">
                                        Kehadiran
                                    </th>

                                    <th class="px-6 py-4 font-semibold text-gray-600">
                                        Status
                                    </th>

                                    <th class="px-6 py-4 font-semibold text-gray-600 text-right">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-100">

                                @foreach ($candidates as $candidate)

                                    <tr class="hover:bg-gray-50">

                                        {{-- Pegawai --}}
                                        <td class="px-6 py-4">

                                            <div class="flex items-center gap-3">

                                                @if ($candidate->employee->photo)

                                                    <img
                                                        src="{{ asset('storage/' . $candidate->employee->photo) }}"
                                                        alt="{{ $candidate->employee->name }}"
                                                        class="w-10 h-10 rounded-full object-cover"
                                                    >

                                                @else

                                                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">

                                                        <span class="text-sm font-semibold text-gray-600">
                                                            {{ strtoupper(substr($candidate->employee->name, 0, 1)) }}
                                                        </span>

                                                    </div>

                                                @endif


                                                <div>

                                                    <p class="font-medium text-gray-800">
                                                        {{ $candidate->employee->name }}
                                                    </p>

                                                    <p class="text-xs text-gray-500">
                                                        {{ $candidate->employee->position }}
                                                    </p>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- NIP --}}
                                        <td class="px-6 py-4 text-gray-600">
                                            {{ $candidate->employee->nip }}
                                        </td>


                                        {{-- Departemen --}}
                                        <td class="px-6 py-4 text-gray-600">
                                            {{ $candidate->employee->department }}
                                        </td>


                                        {{-- Jabatan --}}
                                        <td class="px-6 py-4 text-gray-600">
                                            {{ $candidate->employee->position }}
                                        </td>


                                        {{-- Kehadiran --}}
                                        <td class="px-6 py-4">

                                            <span class="font-semibold text-gray-800">
                                                {{ number_format($candidate->attendance_percentage, 2) }}%
                                            </span>

                                        </td>


                                        {{-- Status --}}
                                        <td class="px-6 py-4">

                                            @if ($candidate->is_winner)

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                                    Pemenang
                                                </span>

                                            @else

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                                    Kandidat
                                                </span>

                                            @endif

                                        </td>

                                        <td class="px-6 py-4 text-right">
    <a
        href="{{ route('admin.candidates.edit', $candidate) }}"
        class="inline-flex items-center px-3 py-2 rounded-lg bg-gray-100 text-gray-700 text-xs font-semibold hover:bg-gray-200"
    >
        Edit
    </a>
</td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="px-6 py-12 text-center">

                        <div class="text-4xl mb-3">
                            👥
                        </div>

                        <h3 class="font-semibold text-gray-800">
                            Belum ada kandidat
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Belum ada pegawai yang dipilih sebagai kandidat pada periode aktif.
                        </p>

                        @if ($activePeriod)

                            <a href="{{ route('admin.candidates.create') }}"
                               class="inline-flex mt-5 px-4 py-2 bg-gray-800 text-white rounded-lg text-sm font-semibold hover:bg-gray-700">
                                + Pilih Kandidat
                            </a>

                        @endif

                    </div>

                @endif

            </div>

        </div>
    </div>

</x-app-layout>