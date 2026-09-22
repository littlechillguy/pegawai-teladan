<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Hall of Fame
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Daftar Pegawai Teladan yang telah ditetapkan sebagai pemenang.
            </p>
        </div>

    </x-slot>


    <div class="py-8">

        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">


            {{-- HEADER --}}

            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">

                <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">

                    <div>

                        <p class="text-sm font-medium text-yellow-600">
                            Penghargaan Pegawai
                        </p>

                        <h1 class="mt-1 text-2xl font-bold text-gray-900">
                            Hall of Fame
                        </h1>

                        <p class="mt-2 max-w-2xl text-sm leading-6 text-gray-500">
                            Riwayat pegawai yang telah ditetapkan sebagai
                            Pegawai Teladan pada setiap periode penilaian.
                        </p>

                    </div>


                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-yellow-50">

                        <span class="text-3xl">
                            🏆
                        </span>

                    </div>

                </div>

            </div>



            {{-- JUMLAH PEMENANG --}}

            <div class="grid gap-5 sm:grid-cols-2">

                <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Total Pegawai Teladan
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-900">
                                {{ $winners->count() }}
                            </p>

                        </div>


                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-yellow-50">

                            <span class="text-xl">
                                🏆
                            </span>

                        </div>

                    </div>

                </div>


                <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Riwayat Periode
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-900">
                                {{ $winners->unique('period_id')->count() }}
                            </p>

                        </div>


                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 text-indigo-600"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                />
                            </svg>

                        </div>

                    </div>

                </div>

            </div>



            {{-- DAFTAR PEMENANG --}}

            <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">


                <div class="border-b border-gray-100 px-6 py-5">

                    <h2 class="text-lg font-bold text-gray-900">
                        Daftar Pegawai Teladan
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Hanya pegawai yang telah ditetapkan sebagai pemenang
                        yang ditampilkan di halaman ini.
                    </p>

                </div>



                @if ($winners->count())


                    <div class="divide-y divide-gray-100">


                        @foreach ($winners as $winner)


                            <div class="p-6">

                                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">


                                    {{-- DATA PEGAWAI --}}

                                    <div class="flex items-center gap-4">


                                        @if ($winner->employee->photo)

                                            <img
                                                src="{{ asset('storage/' . $winner->employee->photo) }}"
                                                alt="{{ $winner->employee->name }}"
                                                class="h-20 w-20 rounded-2xl object-cover ring-2 ring-yellow-100"
                                            >

                                        @else

                                            <div class="flex h-20 w-20 flex-shrink-0 items-center justify-center rounded-2xl bg-yellow-100 text-2xl font-bold text-yellow-700">

                                                {{ strtoupper(substr($winner->employee->name, 0, 1)) }}

                                            </div>

                                        @endif


                                        <div>

                                            <div class="flex flex-wrap items-center gap-2">

                                                <h3 class="text-xl font-bold text-gray-900">

                                                    {{ $winner->employee->name }}

                                                </h3>


                                                <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-bold text-yellow-700">

                                                    🏆 Pegawai Teladan

                                                </span>

                                            </div>


                                            <p class="mt-1 text-sm text-gray-500">

                                                NIP:
                                                {{ $winner->employee->nip }}

                                            </p>


                                            <div class="mt-2 flex flex-wrap gap-2">

                                                <span class="rounded-lg bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">

                                                    {{ $winner->employee->department }}

                                                </span>


                                                <span class="rounded-lg bg-indigo-50 px-3 py-1 text-xs font-medium text-indigo-700">

                                                    {{ $winner->employee->position }}

                                                </span>

                                            </div>

                                        </div>

                                    </div>



                                    {{-- PERIODE & NILAI --}}

                                    <div class="grid grid-cols-2 gap-4 sm:flex sm:items-center sm:gap-8">


                                        {{-- PERIODE --}}

                                        <div>

                                            <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                                                Periode
                                            </p>

                                            <p class="mt-1 font-semibold text-gray-900">

                                                {{ $winner->period->name }}

                                            </p>

                                            <p class="mt-1 text-xs text-gray-500">

                                                {{ $winner->period->start_date->format('d M Y') }}

                                                -

                                                {{ $winner->period->end_date->format('d M Y') }}

                                            </p>

                                        </div>



                                        {{-- NILAI --}}

                                        <div>

                                            <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                                                Nilai Akhir
                                            </p>

                                            <p class="mt-1 text-2xl font-bold text-indigo-600">

                                                {{ number_format($winner->final_score, 2) }}

                                            </p>

                                        </div>


                                    </div>

                                </div>


                                {{-- KEHADIRAN --}}

                                <div class="mt-5 flex flex-wrap gap-3">


                                    <div class="rounded-xl bg-gray-50 px-4 py-3">

                                        <p class="text-xs text-gray-500">
                                            Persentase Kehadiran
                                        </p>

                                        <p class="mt-1 text-sm font-bold text-gray-800">

                                            {{ number_format($winner->attendance_percentage, 2) }}%

                                        </p>

                                    </div>


                                    <div class="rounded-xl bg-yellow-50 px-4 py-3">

                                        <p class="text-xs text-yellow-600">
                                            Status Penghargaan
                                        </p>

                                        <p class="mt-1 text-sm font-bold text-yellow-700">

                                            🏆 Pegawai Teladan

                                        </p>

                                    </div>


                                </div>

                            </div>


                        @endforeach


                    </div>


                @else


                    {{-- BELUM ADA PEMENANG --}}

                    <div class="px-6 py-14 text-center">

                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-gray-100">

                            <span class="text-3xl">
                                🏆
                            </span>

                        </div>


                        <h3 class="mt-5 text-lg font-bold text-gray-900">
                            Belum Ada Pegawai Teladan
                        </h3>


                        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                            Belum ada pegawai yang ditetapkan sebagai
                            Pegawai Teladan pada periode mana pun.
                        </p>


                        <div class="mt-6">

                            <a
                                href="{{ route('admin.candidates.index') }}"
                                class="inline-flex items-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700"
                            >
                                Kelola Kandidat
                            </a>

                        </div>

                    </div>


                @endif


            </div>

        </div>

    </div>

</x-app-layout>