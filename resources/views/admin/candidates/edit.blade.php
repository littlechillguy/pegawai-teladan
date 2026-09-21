<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Edit Kandidat
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Perbarui persentase kehadiran kandidat.
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


            {{-- Data Kandidat --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">

                <div class="px-6 py-5 border-b border-gray-200">

                    <div class="flex items-center gap-4">

                        @if ($candidate->employee->photo)

                            <img
                                src="{{ asset('storage/' . $candidate->employee->photo) }}"
                                alt="{{ $candidate->employee->name }}"
                                class="w-14 h-14 rounded-full object-cover"
                            >

                        @else

                            <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center">
                                <span class="text-lg font-semibold text-gray-600">
                                    {{ strtoupper(substr($candidate->employee->name, 0, 1)) }}
                                </span>
                            </div>

                        @endif

                        <div>
                            <h3 class="font-semibold text-gray-800">
                                {{ $candidate->employee->name }}
                            </h3>

                            <p class="text-sm text-gray-500">
                                {{ $candidate->employee->nip }}
                                ·
                                {{ $candidate->employee->position }}
                            </p>

                            <p class="text-xs text-gray-400 mt-1">
                                {{ $candidate->period->name }}
                            </p>
                        </div>

                    </div>

                </div>


                <form
                    action="{{ route('admin.candidates.update', $candidate) }}"
                    method="POST"
                    class="p-6 space-y-6"
                >

                    @csrf
                    @method('PUT')


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
                                value="{{ old('attendance_percentage', $candidate->attendance_percentage) }}"
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
                            Masukkan nilai antara 0 sampai 100.
                        </p>

                        @error('attendance_percentage')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Bobot --}}
                    <div class="rounded-lg bg-gray-50 border border-gray-200 p-4">

                        <p class="text-sm font-medium text-gray-700">
                            Bobot Kehadiran
                        </p>

                        <p class="text-sm text-gray-500 mt-1">
                            Kehadiran memiliki bobot
                            <strong>10%</strong>
                            dari nilai akhir.
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
                        >
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>