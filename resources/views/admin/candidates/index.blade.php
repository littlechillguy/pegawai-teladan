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
                <div class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-lg text-sm font-medium">
                    Periode: {{ $activePeriod->name }}
                </div>
            @endif
        </div>
    </x-slot>


    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Flash Success --}}
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-green-700">
                    {{ session('success') }}
                </div>
            @endif


            {{-- Flash Error --}}
            @if (session('error'))
                <div class="mb-6 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-red-700">
                    {{ session('error') }}
                </div>
            @endif


            {{-- Tidak ada periode aktif --}}
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

                {{-- Header informasi periode --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                        <div>
                            <p class="text-sm text-gray-500">
                                Periode Aktif
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

                        <div class="text-right">
                            <p class="text-sm text-gray-500">
                                Total Kandidat
                            </p>

                            <p class="text-3xl font-bold text-blue-600">
                                {{ $candidates->count() }}
                            </p>
                        </div>

                    </div>

                </div>


                {{-- Tidak ada kandidat --}}
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

                    {{-- Tabel Kandidat --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

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

                                <thead class="bg-gray-50">

                                    <tr>

                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Pegawai
                                        </th>

                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            NIP
                                        </th>

                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Departemen
                                        </th>

                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Jabatan
                                        </th>

                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Kehadiran
                                        </th>

                                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Aksi
                                        </th>

                                    </tr>

                                </thead>


                                <tbody class="bg-white divide-y divide-gray-200">

                                    @foreach ($candidates as $candidate)

                                        <tr class="hover:bg-gray-50 transition">

                                            {{-- Pegawai --}}
                                            <td class="px-6 py-4 whitespace-nowrap">

                                                <div class="flex items-center">

                                                    @if ($candidate->employee->photo)

                                                        <img
                                                            src="{{ asset('storage/' . $candidate->employee->photo) }}"
                                                            alt="{{ $candidate->employee->name }}"
                                                            class="w-11 h-11 rounded-full object-cover"
                                                        >

                                                    @else

                                                        <div class="w-11 h-11 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-semibold">
                                                            {{ strtoupper(substr($candidate->employee->name, 0, 1)) }}
                                                        </div>

                                                    @endif

                                                    <div class="ml-3">

                                                        <div class="text-sm font-semibold text-gray-900">
                                                            {{ $candidate->employee->name }}
                                                        </div>

                                                        <div class="text-xs text-gray-500">
                                                            Kandidat periode ini
                                                        </div>

                                                    </div>

                                                </div>

                                            </td>


                                            {{-- NIP --}}
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $candidate->employee->nip }}
                                            </td>


                                            {{-- Departemen --}}
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $candidate->employee->department }}
                                            </td>


                                            {{-- Jabatan --}}
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $candidate->employee->position }}
                                            </td>


                                            {{-- Kehadiran --}}
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


                                            {{-- Aksi --}}
                                            <td class="px-6 py-4 whitespace-nowrap text-right">

                                                <a
                                                    href="{{ route('admin.candidates.edit', $candidate) }}"
                                                    class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition"
                                                >
                                                    Edit
                                                </a>

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