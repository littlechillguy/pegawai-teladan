<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5m-1.5-10.5a2.12 2.12 0 013 3L12 14l-4 1 1-4 7.5-7.5z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Edit Pertanyaan</h2>
                    <p class="text-sm text-slate-500 mt-0.5">
                        Kriteria: {{ $question->criterion->name }}
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50/60 min-h-[calc(100vh-4rem)]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Error --}}
            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 shadow-sm">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-rose-800">Terdapat kesalahan</p>
                            <ul class="mt-1.5 text-sm text-rose-700 list-disc list-inside space-y-0.5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Informasi Kriteria --}}
            <div class="mb-6 bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="p-5 sm:p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                    Kriteria Penilaian
                                </p>
                                <h3 class="text-lg font-bold text-slate-800 mt-0.5">
                                    {{ $question->criterion->name }}
                                </h3>
                                <div class="flex items-center gap-2 mt-1.5">
                                    <span class="text-xs text-slate-500">Bobot</span>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-teal-50 text-teal-700 text-xs font-bold">
                                        {{ number_format($question->criterion->weight, 0) }}%
                                    </span>
                                </div>
                            </div>
                        </div>

                        <a
                            href="{{ route('admin.questions.index', $question->criterion_id) }}"
                            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-600 text-sm font-semibold hover:bg-slate-50 hover:text-slate-800 transition shadow-sm"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                {{-- Header --}}
                <div class="px-5 sm:px-6 py-5 border-b border-slate-200">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5m-1.5-10.5a2.12 2.12 0 013 3L12 14l-4 1 1-4 7.5-7.5z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-800">Informasi Pertanyaan</h3>
                            <p class="text-xs text-slate-500 mt-0.5">
                                Perbarui pertanyaan dan pengaturan penilaiannya.
                            </p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.questions.update', $question) }}" class="p-5 sm:p-6">
                    @csrf
                    @method('PUT')

                    {{-- Pertanyaan --}}
                    <div class="mb-6">
                        <label for="question" class="block text-sm font-bold text-slate-700 mb-2">
                            Pertanyaan
                        </label>
                        <textarea
                            name="question"
                            id="question"
                            rows="4"
                            required
                            class="w-full rounded-xl border-slate-300 bg-white text-sm text-slate-800 placeholder-slate-400 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 transition resize-y"
                        >{{ old('question', $question->question) }}</textarea>
                        <p class="text-xs text-slate-400 mt-2">
                            Pastikan pertanyaan tetap jelas dan mudah dipahami oleh pegawai.
                        </p>
                    </div>

                    {{-- Pengaturan --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">

                        {{-- Urutan --}}
                        <div>
                            <label for="order" class="block text-sm font-bold text-slate-700 mb-2">
                                Urutan Pertanyaan
                            </label>
                            <input
                                type="number"
                                name="order"
                                id="order"
                                min="1"
                                required
                                value="{{ old('order', $question->order) }}"
                                class="w-full h-11 rounded-xl border-slate-300 bg-white text-sm font-semibold text-slate-800 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 transition"
                            >
                            <p class="text-xs text-slate-400 mt-2">
                                Menentukan urutan pertanyaan saat ditampilkan.
                            </p>
                        </div>

                        {{-- Status --}}
                        <div>
                            <label for="is_active" class="block text-sm font-bold text-slate-700 mb-2">
                                Status
                            </label>
                            <select
                                name="is_active"
                                id="is_active"
                                class="w-full h-11 rounded-xl border-slate-300 bg-white text-sm font-semibold text-slate-800 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 transition"
                            >
                                <option value="1" {{ old('is_active', $question->is_active) == 1 ? 'selected' : '' }}>
                                    Aktif
                                </option>
                                <option value="0" {{ old('is_active', $question->is_active) == 0 ? 'selected' : '' }}>
                                    Nonaktif
                                </option>
                            </select>
                            <p class="text-xs text-slate-400 mt-2">
                                Pertanyaan aktif akan digunakan dalam proses penilaian.
                            </p>
                        </div>

                    </div>

                    {{-- Pilihan Jawaban --}}
                    <div class="border-t border-slate-200 pt-7">

                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-slate-800">Pilihan Jawaban</h3>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    Ubah pilihan jawaban dan nilai sesuai kebutuhan.
                                </p>
                            </div>
                        </div>

                        <div class="space-y-4">

                            @foreach ($question->options as $index => $option)

                                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                                    <input
                                        type="hidden"
                                        name="options[{{ $index }}][id]"
                                        value="{{ $option->id }}"
                                    >

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                                        {{-- Pilihan --}}
                                        <div class="md:col-span-2">
                                            <label class="block text-xs font-bold text-slate-600 mb-2">
                                                Pilihan {{ $index + 1 }}
                                            </label>
                                            <input
                                                type="text"
                                                name="options[{{ $index }}][option]"
                                                value="{{ old("options.$index.option", $option->option) }}"
                                                required
                                                class="w-full h-11 rounded-xl border-slate-300 bg-white text-sm text-slate-800 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 transition"
                                            >
                                        </div>

                                        {{-- Nilai --}}
                                        <div>
                                            <label class="block text-xs font-bold text-slate-600 mb-2">
                                                Nilai
                                            </label>
                                            <div class="relative">
                                                <input
                                                    type="number"
                                                    name="options[{{ $index }}][score]"
                                                    value="{{ old("options.$index.score", $option->score) }}"
                                                    min="0"
                                                    max="100"
                                                    step="0.01"
                                                    required
                                                    class="w-full h-11 rounded-xl border-slate-300 bg-white pr-12 text-sm font-bold text-slate-800 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 transition"
                                                >
                                                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400 pointer-events-none">
                                                    Poin
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            @endforeach

                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3 mt-8 pt-6 border-t border-slate-200">

                        <a
                            href="{{ route('admin.questions.index', $question->criterion_id) }}"
                            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-600 text-sm font-semibold hover:bg-slate-50 hover:text-slate-800 transition"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-teal-600 text-white text-sm font-semibold hover:bg-teal-700 shadow-sm transition active:scale-[0.98]"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Perubahan
                        </button>

                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>