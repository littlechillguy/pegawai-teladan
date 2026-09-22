<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Penilaian Kandidat
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Periode: {{ $activePeriod->name }}
            </p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Informasi Kandidat --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">

                <div class="flex items-center gap-5">

                    {{-- Foto --}}
                    <div class="shrink-0">

                        @if ($candidate->employee->photo)

                            <img src="{{ asset('storage/' . $candidate->employee->photo) }}"
                                alt="{{ $candidate->employee->name }}"
                                class="w-20 h-20 rounded-full object-cover border border-gray-200">

                        @else

                            <div class="w-20 h-20 rounded-full bg-indigo-100 flex items-center justify-center">

                                <span class="text-2xl font-semibold text-indigo-600">
                                    {{ strtoupper(substr($candidate->employee->name, 0, 1)) }}
                                </span>

                            </div>

                        @endif

                    </div>

                    {{-- Data kandidat --}}
                    <div>

                        <h3 class="text-xl font-semibold text-gray-800">
                            {{ $candidate->employee->name }}
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            NIP: {{ $candidate->employee->nip }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $candidate->employee->position }}
                            —
                            {{ $candidate->employee->department }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- Informasi penilaian --}}
            <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-5 mb-6">

                <h3 class="font-semibold text-indigo-800">
                    Petunjuk Penilaian
                </h3>

                <p class="text-sm text-indigo-700 mt-2">
                    Berikan penilaian berdasarkan kondisi dan kinerja kandidat
                    selama periode penilaian.
                </p>

                <p class="text-sm text-indigo-700 mt-2">
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

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">

                        {{-- Header Kriteria --}}
                        <div class="border-b border-gray-200 pb-4 mb-6">

                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">

                                <div>

                                    <h3 class="text-lg font-semibold text-gray-800">
                                        {{ $criterion->name }}
                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Jawablah seluruh pertanyaan pada kriteria ini.
                                    </p>

                                </div>

                                <div class="shrink-0">

                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 text-sm font-medium">
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

                                        <p class="text-sm text-gray-400 mb-1">
                                            Pertanyaan {{ $index + 1 }}
                                        </p>

                                        <p class="font-medium text-gray-800">
                                            {{ $question->question }}
                                        </p>

                                    </div>


                                    {{-- Pilihan jawaban --}}
                                    <div class="space-y-3">

                                        @foreach ($question->options as $option)

                                            <label
                                                class="flex items-center gap-3 p-4 rounded-lg border border-gray-200 hover:bg-gray-50 cursor-pointer">

                                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}"
                                                    class="text-indigo-600 focus:ring-indigo-500" required>

                                                <div class="flex-1">

                                                    <p class="text-sm font-medium text-gray-800">
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
                <div class="flex flex-col sm:flex-row justify-end gap-3">

                    <a href="{{ route('dashboard') }}"
                        class="px-5 py-2.5 rounded-lg border border-gray-300 text-gray-700 text-center font-medium hover:bg-gray-50">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-indigo-600 text-white font-medium hover:bg-indigo-700">
                        Kirim Penilaian
                    </button>

                </div>

            </form>

        </div>
    </div>

</x-app-layout>