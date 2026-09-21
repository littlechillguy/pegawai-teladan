<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Tambah Periode
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Tambahkan periode baru untuk pemilihan pegawai teladan.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200">

                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-800">
                        Informasi Periode
                    </h3>
                </div>

                <form action="{{ route('admin.periods.store') }}"
                      method="POST"
                      class="p-6 space-y-6">

                    @csrf

                    {{-- Nama Periode --}}
                    <div>
                        <label for="name"
                               class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Periode
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            placeholder="Contoh: Periode Oktober - Desember 2026"
                            class="w-full rounded-lg border-gray-300 focus:border-gray-500 focus:ring-gray-500"
                            required
                        >

                        @error('name')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Tanggal --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label for="start_date"
                                   class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Mulai
                            </label>

                            <input
                                type="date"
                                name="start_date"
                                id="start_date"
                                value="{{ old('start_date') }}"
                                class="w-full rounded-lg border-gray-300 focus:border-gray-500 focus:ring-gray-500"
                                required
                            >

                            @error('start_date')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="end_date"
                                   class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Selesai
                            </label>

                            <input
                                type="date"
                                name="end_date"
                                id="end_date"
                                value="{{ old('end_date') }}"
                                class="w-full rounded-lg border-gray-300 focus:border-gray-500 focus:ring-gray-500"
                                required
                            >

                            @error('end_date')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>

                    {{-- Status --}}
                    <div>
                        <label for="status"
                               class="block text-sm font-medium text-gray-700 mb-2">
                            Status Periode
                        </label>

                        <select
                            name="status"
                            id="status"
                            class="w-full rounded-lg border-gray-300 focus:border-gray-500 focus:ring-gray-500"
                            required
                        >

                            <option value="upcoming"
                                {{ old('status', 'upcoming') === 'upcoming' ? 'selected' : '' }}>
                                Akan Datang
                            </option>

                            <option value="active"
                                {{ old('status') === 'active' ? 'selected' : '' }}>
                                Aktif
                            </option>

                            <option value="completed"
                                {{ old('status') === 'completed' ? 'selected' : '' }}>
                                Selesai
                            </option>

                        </select>

                        @error('status')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                        <p class="mt-2 text-xs text-gray-500">
                            Periode aktif digunakan sebagai periode pemilihan pegawai teladan yang sedang berjalan.
                        </p>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">

                        <a href="{{ route('admin.periods.index') }}"
                           class="px-4 py-2 rounded-lg border border-gray-300 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2 rounded-lg bg-gray-800 text-white text-sm font-semibold hover:bg-gray-700">
                            Simpan Periode
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>