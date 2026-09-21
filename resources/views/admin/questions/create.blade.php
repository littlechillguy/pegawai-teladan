<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Tambah Pertanyaan
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Kriteria: {{ $criterion->name }}
            </p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Error --}}
            @if ($errors->any())
                <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
                    <p class="font-medium text-red-800 mb-2">
                        Terdapat kesalahan:
                    </p>

                    <ul class="list-disc list-inside text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

                <form
                    method="POST"
                    action="{{ route('admin.questions.store', $criterion) }}"
                >

                    @csrf

                    {{-- Pertanyaan --}}
                    <div class="mb-6">
                        <label
                            for="question"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Pertanyaan
                        </label>

                        <textarea
                            name="question"
                            id="question"
                            rows="4"
                            required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Contoh: Seberapa sering pegawai memberikan ide atau solusi baru dalam pekerjaan?"
                        >{{ old('question') }}</textarea>
                    </div>

                    {{-- Urutan --}}
                    <div class="mb-6">
                        <label
                            for="order"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Urutan Pertanyaan
                        </label>

                        <input
                            type="number"
                            name="order"
                            id="order"
                            min="1"
                            value="{{ old('order', 1) }}"
                            required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        >

                        <p class="text-xs text-gray-500 mt-1">
                            Menentukan urutan pertanyaan saat ditampilkan kepada pegawai.
                        </p>
                    </div>

                    {{-- Status --}}
                    <div class="mb-8">
                        <label
                            for="is_active"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Status
                        </label>

                        <select
                            name="is_active"
                            id="is_active"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>
                                Aktif
                            </option>

                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>
                                Nonaktif
                            </option>
                        </select>
                    </div>

                    {{-- Pilihan Jawaban --}}
                    <div class="border-t border-gray-200 pt-6">

                        <div class="mb-5">
                            <h3 class="text-lg font-semibold text-gray-800">
                                Pilihan Jawaban
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Masukkan pilihan jawaban beserta nilai yang akan digunakan dalam penilaian.
                            </p>
                        </div>

                        <div class="space-y-4">

                            {{-- Pilihan 1 --}}
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Pilihan 1
                                    </label>

                                    <input
                                        type="text"
                                        name="options[0][option]"
                                        value="{{ old('options.0.option', 'Sangat Baik') }}"
                                        required
                                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Nilai
                                    </label>

                                    <input
                                        type="number"
                                        name="options[0][score]"
                                        value="{{ old('options.0.score', 100) }}"
                                        min="0"
                                        max="100"
                                        step="0.01"
                                        required
                                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                </div>

                            </div>

                            {{-- Pilihan 2 --}}
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Pilihan 2
                                    </label>

                                    <input
                                        type="text"
                                        name="options[1][option]"
                                        value="{{ old('options.1.option', 'Baik') }}"
                                        required
                                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Nilai
                                    </label>

                                    <input
                                        type="number"
                                        name="options[1][score]"
                                        value="{{ old('options.1.score', 80) }}"
                                        min="0"
                                        max="100"
                                        step="0.01"
                                        required
                                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                </div>

                            </div>

                            {{-- Pilihan 3 --}}
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Pilihan 3
                                    </label>

                                    <input
                                        type="text"
                                        name="options[2][option]"
                                        value="{{ old('options.2.option', 'Cukup') }}"
                                        required
                                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Nilai
                                    </label>

                                    <input
                                        type="number"
                                        name="options[2][score]"
                                        value="{{ old('options.2.score', 60) }}"
                                        min="0"
                                        max="100"
                                        step="0.01"
                                        required
                                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                </div>

                            </div>

                            {{-- Pilihan 4 --}}
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Pilihan 4
                                    </label>

                                    <input
                                        type="text"
                                        name="options[3][option]"
                                        value="{{ old('options.3.option', 'Kurang') }}"
                                        required
                                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Nilai
                                    </label>

                                    <input
                                        type="number"
                                        name="options[3][score]"
                                        value="{{ old('options.3.score', 40) }}"
                                        min="0"
                                        max="100"
                                        step="0.01"
                                        required
                                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                </div>

                            </div>

                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-200">

                        <a
                            href="{{ route('admin.questions.index', $criterion) }}"
                            class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2 rounded-lg bg-indigo-600 text-white font-medium hover:bg-indigo-700"
                        >
                            Simpan Pertanyaan
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>