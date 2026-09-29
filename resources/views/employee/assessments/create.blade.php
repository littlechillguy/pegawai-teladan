<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-slate-800">
                Penilaian Kandidat
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Periode: {{ $activePeriod->name }}
            </p>
        </div>
    </x-slot>

    <div class="min-h-[calc(100vh-4rem)] bg-slate-50/50 py-7">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            {{-- Kandidat --}}
            <div class="mb-6 overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm">
                <div class="h-1 bg-teal-500"></div>

                <div class="p-5 sm:p-6">
                    <div class="flex items-center gap-4 sm:gap-5">

                        {{-- Foto --}}
                        @if ($candidate->employee->photo)
                            <img
                                src="{{ asset('storage/' . $candidate->employee->photo) }}"
                                alt="{{ $candidate->employee->name }}"
                                class="h-16 w-16 shrink-0 rounded-2xl object-cover border border-slate-200 shadow-sm sm:h-20 sm:w-20"
                            >
                        @else
                            <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl border border-teal-100 bg-teal-50 sm:h-20 sm:w-20">
                                <span class="text-2xl font-bold text-teal-700">
                                    {{ strtoupper(substr($candidate->employee->name, 0, 1)) }}
                                </span>
                            </div>
                        @endif

                        {{-- Informasi --}}
                        <div class="min-w-0">
                            <p class="mb-1 text-xs font-bold uppercase tracking-wider text-teal-600">
                                Kandidat Pegawai Teladan
                            </p>

                            <h3 class="truncate text-xl font-bold text-slate-800">
                                {{ $candidate->employee->name }}
                            </h3>

                            <p class="mt-1 text-sm font-semibold text-slate-600">
                                NIP: {{ $candidate->employee->nip }}
                            </p>

                            <p class="mt-0.5 text-sm text-slate-500">
                                {{ $candidate->employee->position ?? '-' }}
                                @if ($candidate->employee->pokja)
                                    <span class="mx-1">•</span>
                                    {{ $candidate->employee->pokja }}
                                @endif
                            </p>
                        </div>

                    </div>
                </div>
            </div>


            {{-- Petunjuk Penilaian --}}
            <div class="mb-6 rounded-2xl border border-teal-200/80 bg-teal-50/70 p-5 shadow-sm">
                <div class="flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-teal-100 text-teal-700">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 16v-4m0-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-teal-800">
                            Petunjuk Penilaian
                        </h3>

                        <p class="mt-1 text-sm leading-relaxed text-teal-700">
                            Berikan penilaian berdasarkan kondisi dan kinerja kandidat selama periode penilaian.
                            Pilih satu jawaban untuk setiap pertanyaan. Penilaian yang diberikan akan diproses menjadi nilai kandidat.
                        </p>
                    </div>

                </div>
            </div>


            {{-- Form Penilaian --}}
            @php
                $groupedQuestions = $questions->groupBy(function ($question) {
                    return $question->criterion->id;
                });
            @endphp

            <form method="POST" action="{{ route('assessment.store', $candidate) }}">
                @csrf

                @foreach ($groupedQuestions as $criterionId => $criterionQuestions)

                    @php
                        $criterion = $criterionQuestions->first()->criterion;
                    @endphp

                    {{-- Kriteria --}}
                    <div class="mb-6 overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm">

                        {{-- Header Kriteria --}}
                        <div class="border-b border-slate-200 bg-slate-50/70 px-5 py-4 sm:px-6">
                            <div class="flex items-center justify-between gap-4">

                                <div class="min-w-0">
                                    <p class="text-xs font-bold uppercase tracking-wider text-teal-600">
                                        Kriteria Penilaian
                                    </p>

                                    <h3 class="mt-1 text-lg font-bold text-slate-800">
                                        {{ $criterion->name }}
                                    </h3>
                                </div>

                                <span class="shrink-0 rounded-lg border border-teal-200 bg-teal-50 px-3 py-1.5 text-xs font-bold text-teal-700">
                                    Bobot {{ number_format($criterion->weight, 0) }}%
                                </span>

                            </div>
                        </div>


                        {{-- Pertanyaan --}}
                        <div class="divide-y divide-slate-100">

                            @foreach ($criterionQuestions as $index => $question)

                                <div class="p-5 sm:p-6">

                                    {{-- Pertanyaan --}}
                                    <div class="mb-4">
                                        <div class="mb-2 flex items-center gap-2">
                                            <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-slate-100 text-[11px] font-bold text-slate-500">
                                                {{ $index + 1 }}
                                            </span>

                                            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                                Pertanyaan
                                            </span>
                                        </div>

                                        <p class="text-sm font-semibold leading-relaxed text-slate-800 sm:text-base">
                                            {{ $question->question }}
                                        </p>
                                    </div>


                                    {{-- Pilihan Jawaban --}}
                                    <div class="space-y-2.5">

                                        @foreach ($question->options as $option)

                                            <label class="group flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 bg-white p-3.5 transition-all hover:border-teal-300 hover:bg-teal-50/40">

                                                <input
                                                    type="radio"
                                                    name="answers[{{ $question->id }}]"
                                                    value="{{ $option->id }}"
                                                    required
                                                    class="h-4 w-4 shrink-0 border-slate-300 text-teal-600 focus:ring-teal-500"
                                                >

                                                <div class="flex min-w-0 flex-1 items-center justify-between gap-3">

                                                    <span class="text-sm font-medium text-slate-700 group-hover:text-slate-900">
                                                        {{ $option->option }}
                                                    </span>

                                                    <span class="shrink-0 rounded-lg bg-slate-100 px-2 py-1 text-[11px] font-bold text-slate-500">
                                                        {{ number_format($option->score, 0) }}
                                                    </span>

                                                </div>

                                            </label>

                                        @endforeach

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                @endforeach


                {{-- Tombol --}}
                <div class="sticky bottom-0 z-10 mt-2 rounded-2xl border border-slate-200 bg-white/95 p-4 shadow-lg backdrop-blur sm:p-5">

                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">

                        <a
                            href="{{ route('dashboard') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 active:scale-[0.98]"
                        >
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 18l-6-6 6-6"/>
                            </svg>
                            Kembali
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-teal-600 active:scale-[0.98]"
                        >
                            Kirim Penilaian

                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M5 12h14m-6-6 6 6-6 6"
                                />
                            </svg>
                        </button>

                    </div>

                </div>

            </form>

        </div>
    </div>

</x-app-layout>