<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Pegawai Teladan
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Detail pemenang pada periode {{ $period->name }}.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Tombol Kembali --}}
            <div class="mb-6">
                <a
                    href="{{ route('admin.periods.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition"
                >
                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>

                    Kembali ke Periode
                </a>
            </div>

            {{-- Informasi Periode --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">

                <div class="px-6 py-5 border-b border-gray-200">
                    <div class="flex items-center justify-between gap-4">

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                {{ $period->name }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $period->start_date->format('d M Y') }}
                                -
                                {{ $period->end_date->format('d M Y') }}
                            </p>
                        </div>

                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                            Selesai
                        </span>

                    </div>
                </div>

            </div>

            {{-- Winner --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-800">
                        Pegawai Teladan
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Pegawai yang terpilih sebagai pemenang pada periode ini.
                    </p>
                </div>

                <div class="p-6">

                    <div class="flex flex-col md:flex-row items-center md:items-start gap-6">

                        {{-- Foto --}}
                        <div class="shrink-0">

                            @if ($winner->employee->photo)
                                <img
                                    src="{{ asset('storage/' . $winner->employee->photo) }}"
                                    alt="{{ $winner->employee->name }}"
                                    class="w-32 h-32 rounded-full object-cover border-4 border-gray-100"
                                >
                            @else
                                <div class="w-32 h-32 rounded-full bg-gray-100 flex items-center justify-center border-4 border-gray-50">
                                    <svg
                                        class="w-16 h-16 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0"
                                        />
                                    </svg>
                                </div>
                            @endif

                        </div>

                        {{-- Data Pegawai --}}
                        <div class="flex-1 text-center md:text-left">

                            <div class="mb-4">
                                <p class="text-sm text-gray-500">
                                    Pegawai Teladan
                                </p>

                                <h4 class="text-2xl font-bold text-gray-800 mt-1">
                                    {{ $winner->employee->name }}
                                </h4>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-xs text-gray-500">
                                        NIP
                                    </p>

                                    <p class="text-sm font-semibold text-gray-800 mt-1">
                                        {{ $winner->employee->nip }}
                                    </p>
                                </div>

                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-xs text-gray-500">
                                        Pokja
                                    </p>

                                    <p class="text-sm font-semibold text-gray-800 mt-1">
                                        {{ $winner->employee->pokja ?? '-' }}
                                    </p>
                                </div>

                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-xs text-gray-500">
                                        Jabatan
                                    </p>

                                    <p class="text-sm font-semibold text-gray-800 mt-1">
                                        {{ $winner->employee->position ?? '-' }}
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- Nilai --}}
                    <div class="mt-8 pt-6 border-t border-gray-200">

                        <div class="max-w-sm mx-auto text-center">

                            <p class="text-sm text-gray-500">
                                Nilai Akhir
                            </p>

                            <div class="mt-2">
                                <span class="text-4xl font-bold text-gray-800">
                                    {{ number_format($winner->final_score ?? 0, 2) }}
                                </span>

                                <span class="text-lg text-gray-500">
                                    / 100
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>