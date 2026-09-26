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

                    <p class="text-sm text-gray-500 mt-1">
                        Tentukan nama dan batas waktu pemilihan pegawai teladan.
                    </p>
                </div>

                <form
                    action="{{ route('admin.periods.store') }}"
                    method="POST"
                    class="p-6 space-y-6"
                >

                    @csrf

                    {{-- Nama Periode --}}
                    <div>
                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
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

                        {{-- Tanggal Mulai --}}
                        <div>
                            <label
                                for="start_date"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
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

                            <p class="mt-2 text-xs text-gray-500">
                                Tanggal mulai dibukanya pemilihan.
                            </p>
                        </div>


                        {{-- Tanggal Selesai --}}
                        <div>
                            <label
                                for="end_date"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
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

                            <p class="mt-2 text-xs text-gray-500">
                                Batas terakhir pegawai melakukan penilaian.
                            </p>
                        </div>

                    </div>


                    {{-- Informasi Status --}}
                    <div class="rounded-lg bg-gray-50 border border-gray-200 px-4 py-3">

                        <div class="flex items-start gap-3">

                            <div class="text-gray-500 mt-0.5">
                                <svg
                                    class="w-5 h-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z"
                                    />
                                </svg>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-700">
                                    Status periode ditentukan otomatis
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    Periode akan menjadi <strong>Akan Datang</strong>
                                    jika tanggal mulai masih di masa depan.
                                    Jika tanggal mulai sudah tiba, periode akan menjadi
                                    <strong>Aktif</strong>.
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    Admin juga dapat mengaktifkan periode secara manual
                                    dari halaman Manajemen Periode.
                                </p>
                            </div>

                        </div>

                    </div>


                    {{-- Tombol --}}
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">

                        <a
                            href="{{ route('admin.periods.index') }}"
                            class="px-4 py-2 rounded-lg border border-gray-300 text-sm font-semibold text-gray-700 hover:bg-gray-50"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2 rounded-lg bg-gray-800 text-white text-sm font-semibold hover:bg-gray-700"
                        >
                            Simpan Periode
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>