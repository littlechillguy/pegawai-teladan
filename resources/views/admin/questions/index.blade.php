<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Pertanyaan Penilaian</h2>
                    <p class="text-sm text-slate-500 mt-0.5">
                        Kelola pertanyaan untuk kriteria {{ $criterion->name }}.
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50/60 min-h-[calc(100vh-4rem)]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

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
                                    {{ $criterion->name }}
                                </h3>
                                <div class="flex items-center gap-2 mt-1.5">
                                    <span class="text-xs text-slate-500">Bobot</span>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-teal-50 text-teal-700 text-xs font-bold">
                                        {{ number_format($criterion->weight, 0) }}%
                                    </span>
                                </div>
                            </div>
                        </div>

                        <a
                            href="{{ route('admin.criteria.index') }}"
                            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-600 text-sm font-semibold hover:bg-slate-50 hover:text-slate-800 transition shadow-sm"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Kembali ke Kriteria
                        </a>
                    </div>
                </div>
            </div>

            {{-- Daftar Pertanyaan --}}
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                {{-- Header --}}
                <div class="px-5 sm:px-6 py-5 border-b border-slate-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-base font-bold text-slate-800">
                                    Daftar Pertanyaan
                                </h3>
                                <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-500 text-[11px] font-bold">
                                    {{ $criterion->questions->count() }} Pertanyaan
                                </span>
                            </div>
                            <p class="text-xs text-slate-500 mt-1">
                                Pertanyaan yang digunakan untuk menilai kriteria ini.
                            </p>
                        </div>

                        <a
                            href="{{ route('admin.questions.create', $criterion) }}"
                            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-teal-600 text-white text-sm font-semibold hover:bg-teal-700 transition shadow-sm active:scale-[0.98]"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14M5 12h14"/>
                            </svg>
                            Tambah Pertanyaan
                        </a>
                    </div>
                </div>

                @if ($criterion->questions->count())

                    {{-- Pertanyaan --}}
                    <div class="divide-y divide-slate-100">

                        @foreach ($criterion->questions as $question)

                            <div class="p-5 sm:p-6 hover:bg-slate-50/40 transition-colors">

                                {{-- Header Pertanyaan --}}
                                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">

                                    <div class="flex items-start gap-4 min-w-0">
                                        <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-500 flex items-center justify-center shrink-0">
                                            <span class="text-xs font-bold">
                                                {{ $loop->iteration }}
                                            </span>
                                        </div>

                                        <div class="min-w-0">
                                            <p class="text-sm sm:text-[15px] font-semibold text-slate-800 leading-relaxed">
                                                {{ $question->question }}
                                            </p>

                                            <div class="flex flex-wrap items-center gap-2 mt-3">
                                                @if ($question->is_active)
                                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 text-[11px] font-bold">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                        Aktif
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-slate-100 border border-slate-200 text-slate-500 text-[11px] font-bold">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                                        Tidak Aktif
                                                    </span>
                                                @endif

                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-slate-50 border border-slate-200 text-slate-500 text-[11px] font-semibold">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z"/>
                                                    </svg>
                                                    {{ $question->options->count() }} pilihan jawaban
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <a
                                        href="{{ route('admin.questions.edit', $question) }}"
                                        class="inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-lg border border-slate-200 bg-white text-slate-600 text-xs font-bold hover:bg-teal-50 hover:border-teal-200 hover:text-teal-700 transition shrink-0"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5m-1.5-10.5a2.12 2.12 0 013 3L12 14l-4 1 1-4 7.5-7.5z"/>
                                        </svg>
                                        Edit
                                    </a>

                                </div>

                                {{-- Pilihan Jawaban --}}
                                <div class="mt-5 ml-0 sm:ml-13">
                                    <div class="flex items-center gap-2 mb-3">
                                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                            Pilihan Jawaban
                                        </span>
                                        <div class="h-px flex-1 bg-slate-100"></div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                                        @foreach ($question->options as $option)

                                            <div class="group flex items-center justify-between gap-4 px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 hover:border-teal-200 hover:bg-teal-50/30 transition">
                                                <div class="flex items-center gap-3 min-w-0">
                                                    <div class="w-7 h-7 rounded-lg bg-white border border-slate-200 flex items-center justify-center shrink-0">
                                                        <span class="text-[11px] font-bold text-slate-400">
                                                            {{ $loop->iteration }}
                                                        </span>
                                                    </div>
                                                    <span class="text-sm text-slate-700 leading-snug">
                                                        {{ $option->option }}
                                                    </span>
                                                </div>

                                                <div class="shrink-0">
                                                    <span class="inline-flex items-center justify-center min-w-9 px-2 py-1 rounded-lg bg-white border border-slate-200 text-xs font-bold text-teal-700">
                                                        {{ number_format($option->score, 0) }}
                                                    </span>
                                                </div>
                                            </div>

                                        @endforeach

                                    </div>
                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    {{-- Empty State --}}
                    <div class="px-6 py-16 text-center">
                        <div class="w-16 h-16 mx-auto rounded-2xl bg-teal-50 text-teal-500 flex items-center justify-center">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                            </svg>
                        </div>

                        <h3 class="text-sm font-bold text-slate-700 mt-4">
                            Belum Ada Pertanyaan
                        </h3>

                        <p class="text-xs text-slate-400 mt-1">
                            Belum ada pertanyaan untuk kriteria ini.
                        </p>

                        <a
                            href="{{ route('admin.questions.create', $criterion) }}"
                            class="inline-flex items-center gap-2 mt-5 px-4 py-2.5 rounded-xl bg-teal-600 text-white text-sm font-semibold hover:bg-teal-700 transition shadow-sm"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 5v14M5 12h14"/>
                            </svg>
                            Tambah Pertanyaan
                        </a>
                    </div>

                @endif

                {{-- Footer --}}
                @if ($criterion->questions->count())
                    <div class="px-5 sm:px-6 py-4 border-t border-slate-200 bg-slate-50/60 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div class="flex items-center gap-2 text-xs text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z"/>
                            </svg>
                            Pertanyaan aktif akan digunakan dalam proses penilaian.
                        </div>

                        <span class="text-xs font-semibold text-slate-500">
                            {{ $criterion->questions->where('is_active', true)->count() }} pertanyaan aktif
                        </span>
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>