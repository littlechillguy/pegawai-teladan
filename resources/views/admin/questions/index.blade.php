<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Pertanyaan Penilaian
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Kelola pertanyaan untuk kriteria {{ $criterion->name }}.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Informasi Kriteria --}}
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 mb-6">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Kriteria
                        </p>

                        <h3 class="text-xl font-bold text-gray-800 mt-1">
                            {{ $criterion->name }}
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Bobot:
                            <strong>{{ number_format($criterion->weight, 0) }}%</strong>
                        </p>
                    </div>

                    <a
                        href="{{ route('admin.criteria.index') }}"
                        class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-300 text-sm font-semibold text-gray-700 hover:bg-gray-50"
                    >
                        ← Kembali ke Kriteria
                    </a>

                </div>

            </div>


            {{-- Daftar Pertanyaan --}}
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-200">

                    <div class="flex items-center justify-between">

                        <div>
                            <h3 class="font-semibold text-gray-800">
                                Daftar Pertanyaan
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $criterion->questions->count() }} pertanyaan tersedia.
                            </p>
                        </div>

                        <a
                            href="{{ route('admin.questions.create', $criterion) }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-lg text-sm font-semibold hover:bg-gray-700"
                        >
                            + Tambah Pertanyaan
                        </a>

                    </div>

                </div>


                @if ($criterion->questions->count())

                    <div class="divide-y divide-gray-200">

                        @foreach ($criterion->questions as $question)

                            <div class="p-6">

                                {{-- Header pertanyaan --}}
                                <div class="flex items-start justify-between gap-4">

                                    <div class="flex gap-4">

                                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center">

                                            <span class="text-sm font-semibold text-gray-600">
                                                {{ $loop->iteration }}
                                            </span>

                                        </div>

                                        <div>

                                            <p class="font-medium text-gray-800">
                                                {{ $question->question }}
                                            </p>

                                            <div class="flex items-center gap-3 mt-2">

                                                @if ($question->is_active)

                                                    <span class="inline-flex px-2.5 py-1 rounded-full bg-green-100 text-green-700 text-xs font-medium">
                                                        Aktif
                                                    </span>

                                                @else

                                                    <span class="inline-flex px-2.5 py-1 rounded-full bg-gray-100 text-gray-500 text-xs font-medium">
                                                        Tidak Aktif
                                                    </span>

                                                @endif

                                                <span class="text-xs text-gray-400">
                                                    {{ $question->options->count() }} pilihan jawaban
                                                </span>

                                            </div>

                                        </div>

                                    </div>


                                    <a
                                        href="{{ route('admin.questions.edit', $question) }}"
                                        class="flex-shrink-0 text-sm font-semibold text-gray-600 hover:text-gray-900"
                                    >
                                        Edit
                                    </a>

                                </div>


                                {{-- Pilihan Jawaban --}}
                                <div class="mt-5 ml-12">

                                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 mb-3">
                                        Pilihan Jawaban
                                    </p>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                                        @foreach ($question->options as $option)

                                            <div class="flex items-center justify-between px-4 py-3 rounded-lg bg-gray-50 border border-gray-200">

                                                <span class="text-sm text-gray-700">
                                                    {{ $option->option }}
                                                </span>

                                                <span class="text-sm font-bold text-gray-800">
                                                    {{ number_format($option->score, 0) }}
                                                </span>

                                            </div>

                                        @endforeach

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="px-6 py-12 text-center">

                        <div class="text-4xl mb-3">
                            📝
                        </div>

                        <h3 class="font-semibold text-gray-800">
                            Belum ada pertanyaan
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Belum ada pertanyaan untuk kriteria ini.
                        </p>

                        <a
                            href="{{ route('admin.questions.create', $criterion) }}"
                            class="inline-flex mt-5 px-4 py-2 bg-gray-800 text-white rounded-lg text-sm font-semibold hover:bg-gray-700"
                        >
                            + Tambah Pertanyaan
                        </a>

                    </div>

                @endif

            </div>

        </div>
    </div>

</x-app-layout>