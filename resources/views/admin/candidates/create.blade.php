<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Tambah Kandidat
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Pilih pegawai dan masukkan persentase kehadirannya.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Error --}}
            @if ($errors->any())
                <div class="mb-6 rounded-lg bg-red-50 border border-red-200 px-4 py-3">

                    <ul class="text-sm text-red-700 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif

            {{-- Periode --}}
            <div class="bg-green-50 border border-green-200 rounded-xl p-5 mb-6">

                <p class="text-xs font-semibold uppercase tracking-wider text-green-600">
                    Periode Aktif
                </p>

                <h3 class="text-lg font-semibold text-green-900 mt-1">
                    {{ $activePeriod->name }}
                </h3>

                <p class="text-sm text-green-700 mt-1">
                    {{ $activePeriod->start_date->format('d M Y') }}
                    -
                    {{ $activePeriod->end_date->format('d M Y') }}
                </p>

            </div>


            {{-- Form --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">

                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-800">
                        Data Kandidat
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Data ini akan digunakan dalam proses penilaian.
                    </p>
                </div>


                <form
                    action="{{ route('admin.candidates.store') }}"
                    method="POST"
                    class="p-6 space-y-6"
                >

                    @csrf


                    {{-- Pegawai --}}
                    <div>

                        <label
                            for="employee_id"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Pegawai
                        </label>

                        <select
                            name="employee_id"
                            id="employee_id"
                            class="w-full rounded-lg border-gray-300 focus:border-gray-500 focus:ring-gray-500"
                            required
                        >

                            <option value="">
                                -- Pilih Pegawai --
                            </option>

                            @foreach ($employees as $employee)

                                <option
                                    value="{{ $employee->id }}"
                                    {{ old('employee_id') == $employee->id ? 'selected' : '' }}
                                >
                                    {{ $employee->name }}
                                    — {{ $employee->nip }}
                                    — {{ $employee->department }}
                                </option>

                            @endforeach

                        </select>

                        @if ($employees->isEmpty())

                            <p class="mt-2 text-sm text-gray-500">
                                Semua pegawai aktif sudah menjadi kandidat pada periode ini.
                            </p>

                        @endif

                        @error('employee_id')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Kehadiran --}}
                    <div>

                        <label
                            for="attendance_percentage"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Persentase Kehadiran
                        </label>

                        <div class="relative">

                            <input
                                type="number"
                                name="attendance_percentage"
                                id="attendance_percentage"
                                value="{{ old('attendance_percentage', 90) }}"
                                min="0"
                                max="100"
                                step="0.01"
                                class="w-full pr-12 rounded-lg border-gray-300 focus:border-gray-500 focus:ring-gray-500"
                                required
                            >

                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500">
                                %
                            </span>

                        </div>

                        <p class="mt-2 text-xs text-gray-500">
                            Masukkan nilai antara 0 sampai 100. Contoh: 95.50.
                        </p>

                        @error('attendance_percentage')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Info --}}
                    <div class="rounded-lg bg-gray-50 border border-gray-200 p-4">

                        <p class="text-sm font-medium text-gray-700">
                            Bobot Kehadiran
                        </p>

                        <p class="text-sm text-gray-500 mt-1">
                            Nilai kehadiran memiliki bobot
                            <strong>10%</strong>
                            dalam perhitungan nilai akhir.
                        </p>

                    </div>


                    {{-- Tombol --}}
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">

                        <a
                            href="{{ route('admin.candidates.index') }}"
                            class="px-4 py-2 rounded-lg border border-gray-300 text-sm font-semibold text-gray-700 hover:bg-gray-50"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2 rounded-lg bg-gray-800 text-white text-sm font-semibold hover:bg-gray-700"
                            {{ $employees->isEmpty() ? 'disabled' : '' }}
                        >
                            Simpan Kandidat
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>