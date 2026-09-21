<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Edit Pertanyaan
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Kriteria: {{ $question->criterion->name }}
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
                    action="{{ route('admin.questions.update', $question) }}"
                >

                    @csrf
                    @method('PUT')

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
                        >{{ old('question', $question->question) }}</textarea>

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
                            required
                            value="{{ old('order', $question->order) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        >

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

                            <option
                                value="1"
                                {{ old('is_active', $question->is_active) == 1 ? 'selected' : '' }}
                            >
                                Aktif
                            </option>

                            <option
                                value="0"
                                {{ old('is_active', $question->is_active) == 0 ? 'selected' : '' }}
                            >
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
                                Ubah pilihan jawaban dan nilai sesuai kebutuhan.
                            </p>

                        </div>

                        <div class="space-y-4">

                            @foreach ($question->options as $index => $option)

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                                    <input
                                        type="hidden"
                                        name="options[{{ $index }}][id]"
                                        value="{{ $option->id }}"
                                    >

                                    <div class="md:col-span-2">

                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Pilihan {{ $index + 1 }}
                                        </label>

                                        <input
                                            type="text"
                                            name="options[{{ $index }}][option]"
                                            value="{{ old("options.$index.option", $option->option) }}"
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
                                            name="options[{{ $index }}][score]"
                                            value="{{ old("options.$index.score", $option->score) }}"
                                            min="0"
                                            max="100"
                                            step="0.01"
                                            required
                                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        >

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                    {{-- Tombol --}}
                    <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-200">

                        <a
                            href="{{ route('admin.questions.index', $question->criterion_id) }}"
                            class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2 rounded-lg bg-indigo-600 text-white font-medium hover:bg-indigo-700"
                        >
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>