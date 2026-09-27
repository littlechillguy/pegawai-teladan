<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                Penilaian Kandidat
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Periode: {{ $activePeriod->name }}
            </p>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50/50 min-h-[calc(100vh-4rem)]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Informasi Kandidat --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6 mb-6">

                <div class="flex items-center gap-5">

                    {{-- Foto --}}
                    <div class="shrink-0">

                        @if ($candidate->employee->photo)

                            <img src="{{ asset('storage/' . $candidate->employee->photo) }}"
                                alt="{{ $candidate->employee->name }}"
                                class="w-20 h-20 rounded-full object-cover ring-2 ring-slate-100 shadow-sm">

                        @else

                            <div class="w-20 h-20 rounded-full bg-teal-50 border border-teal-100 flex items-center justify-center shrink-0">

                                <span class="text-2xl font-bold text-teal-700">
                                    {{ strtoupper(substr($candidate->employee->name, 0, 1)) }}
                                </span>

                            </div>

                        @endif

                    </div>

                    {{-- Data kandidat --}}
                    <div>

                        <h3 class="text-xl font-bold text-slate-800">
                            {{ $candidate->employee->name }}
                        </h3>

                        <p class="text-sm font-semibold text-slate-600 font-mono mt-0.5">
                            NIP: {{ $candidate->employee->nip }}
                        </p>

                        <p class="text-sm text-slate-500 mt-0.5">
                            {{ $candidate->employee->position }}
                            —
                            {{ $candidate->employee->pokja }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- Informasi penilaian --}}
            <div class="bg-teal-50/60 border border-teal-200/80 rounded-2xl p-5 mb-6 shadow-sm backdrop-blur-sm">

                <h3 class="font-bold text-teal-800">
                    Petunjuk Penilaian
                </h3>

                <p class="text-sm text-teal-700 mt-2 font-medium">
                    Berikan penilaian berdasarkan kondisi dan kinerja kandidat
                    selama periode penilaian.
                </p>

                <p class="text-sm text-teal-700 mt-1 font-medium">
                    Pilih satu jawaban untuk setiap pertanyaan.
                    Penilaian yang diberikan akan diproses menjadi nilai kandidat.
                </p>

            </div>


            {{-- Form --}}
            <form method="POST" action="{{ route('assessment.store', $candidate) }}">

                @csrf

                {{-- Pertanyaan --}}
                @php
                    $groupedQuestions = $questions->groupBy(function ($question) {
                        return $question->criterion->id;
                    });
                @endphp


                @foreach ($groupedQuestions as $criterionId => $criterionQuestions)

                    @php
                        $criterion = $criterionQuestions->first()->criterion;
                    @endphp

                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6 mb-6">

                        {{-- Header Kriteria --}}
                        <div class="border-b border-slate-100 pb-4 mb-6">

                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">

                                <div>

                                    <h3 class="text-lg font-bold text-slate-800">
                                        {{ $criterion->name }}
                                    </h3>

                                    <p class="text-sm text-slate-500 mt-0.5">
                                        Jawablah seluruh pertanyaan pada kriteria ini.
                                    </p>

                                </div>

                                <div class="shrink-0">

                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-teal-50 border border-teal-200/60 text-teal-700 text-xs font-semibold">
                                        Bobot {{ number_format($criterion->weight, 0) }}%
                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- Daftar pertanyaan --}}
                        <div class="space-y-8">

                            @foreach ($criterionQuestions as $index => $question)

                                <div>

                                    <div class="mb-4">

                                        <p class="text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">
                                            Pertanyaan {{ $index + 1 }}
                                        </p>

                                        <p class="font-semibold text-slate-800">
                                            {{ $question->question }}
                                        </p>

                                    </div>


                                    {{-- Pilihan jawaban --}}
                                    <div class="space-y-3">

                                        @foreach ($question->options as $option)

                                            <label
                                                class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 hover:bg-slate-50/80 hover:border-slate-300 transition-all cursor-pointer">

                                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}"
                                                    class="w-4 h-4 text-teal-600 border-slate-300 focus:ring-teal-500" required>

                                                <div class="flex-1">

                                                    <p class="text-sm font-medium text-slate-700">
                                                        {{ $option->option }}
                                                    </p>

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
                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-2">

                    <a href="{{ route('dashboard') }}"
                        class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 text-center text-sm font-semibold hover:bg-slate-100 transition-all active:scale-[0.98]">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-semibold shadow-sm hover:bg-slate-800 transition-all active:scale-[0.98]">
                        Kirim Penilaian
                    </button>

                </div>

            </form>

        </div>
    </div>

</x-app-layout>