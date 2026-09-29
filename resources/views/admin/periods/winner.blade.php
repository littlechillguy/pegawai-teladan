<x-app-layout>

    <x-slot name="header">
        <div class="lg:ml-72">
            <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                Pegawai Teladan
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Detail pemenang pada periode {{ $period->name }}.
            </p>
        </div>
    </x-slot>


    <div class="lg:ml-72 py-8 bg-slate-50/50 min-h-[calc(100vh-4rem)]">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- ========================================================= --}}
            {{-- TOMBOL KEMBALI --}}
            {{-- ========================================================= --}}
            <div class="mb-6">

                <a
                    href="{{ route('admin.periods.index') }}"
                    class="inline-flex items-center gap-2
                           px-4 py-2.5
                           rounded-xl
                           bg-white
                           border border-slate-200
                           text-sm
                           font-semibold
                           text-slate-600
                           shadow-sm
                           hover:bg-slate-50
                           hover:text-slate-800
                           transition-all
                           active:scale-[0.98]"
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


            {{-- ========================================================= --}}
            {{-- INFORMASI PERIODE --}}
            {{-- ========================================================= --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 mb-6 overflow-hidden">

                <div class="px-6 py-5">

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

                        <div>

                            <h3 class="text-lg font-bold text-slate-800">
                                {{ $period->name }}
                            </h3>

                            <p class="text-sm text-slate-500 mt-1">
                                {{ $period->start_date->format('d M Y') }}
                                -
                                {{ $period->end_date->format('d M Y') }}
                            </p>

                        </div>


                        {{-- Status --}}
                        <span
                            class="inline-flex items-center gap-1.5
                                   px-3 py-1.5
                                   rounded-full
                                   text-xs
                                   font-semibold
                                   bg-emerald-50
                                   text-emerald-700
                                   border border-emerald-100"
                        >

                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                            Selesai

                        </span>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- WINNER CARD --}}
            {{-- ========================================================= --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">


                {{-- HEADER --}}
                <div class="px-6 py-5 border-b border-slate-100">

                    <h3 class="font-bold text-slate-800">
                        Pegawai Teladan
                    </h3>

                    <p class="text-xs text-slate-500 mt-1">
                        Pegawai yang terpilih sebagai pemenang pada periode ini.
                    </p>

                </div>


                {{-- CONTENT --}}
                <div class="p-6 sm:p-8">


                    {{-- ================================================= --}}
                    {{-- DATA PEMENANG --}}
                    {{-- ================================================= --}}
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-7">


                        {{-- FOTO --}}
                        <div class="shrink-0">

                            @if ($winner->employee->photo)

                                <img
                                    src="{{ asset('storage/' . $winner->employee->photo) }}"
                                    alt="{{ $winner->employee->name }}"
                                    class="w-36 h-36 rounded-2xl object-cover
                                           border-4 border-slate-100
                                           shadow-sm"
                                >

                            @else

                                <div
                                    class="w-36 h-36 rounded-2xl
                                           bg-slate-100
                                           flex items-center justify-center
                                           border-4 border-slate-50"
                                >

                                    <svg
                                        class="w-16 h-16 text-slate-300"
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


                        {{-- DATA PEGAWAI --}}
                        <div class="flex-1 text-center md:text-left">

                            <div class="mb-5">

                                <p class="text-xs font-semibold uppercase tracking-wider text-emerald-600">
                                    Pegawai Teladan
                                </p>

                                <h4 class="text-2xl sm:text-3xl font-bold text-slate-800 mt-1">
                                    {{ $winner->employee->name }}
                                </h4>

                            </div>


                            {{-- INFORMASI --}}
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">


                                {{-- NIP --}}
                                <div
                                    class="rounded-xl
                                           bg-slate-50
                                           border border-slate-100
                                           p-4"
                                >

                                    <p class="text-xs font-medium text-slate-400">
                                        NIP
                                    </p>

                                    <p class="text-sm font-semibold text-slate-700 mt-1 break-words">
                                        {{ $winner->employee->nip }}
                                    </p>

                                </div>


                                {{-- POKJA --}}
                                <div
                                    class="rounded-xl
                                           bg-slate-50
                                           border border-slate-100
                                           p-4"
                                >

                                    <p class="text-xs font-medium text-slate-400">
                                        Pokja
                                    </p>

                                    <p class="text-sm font-semibold text-slate-700 mt-1">
                                        {{ $winner->employee->pokja ?? '-' }}
                                    </p>

                                </div>


                                {{-- JABATAN --}}
                                <div
                                    class="rounded-xl
                                           bg-slate-50
                                           border border-slate-100
                                           p-4"
                                >

                                    <p class="text-xs font-medium text-slate-400">
                                        Jabatan
                                    </p>

                                    <p class="text-sm font-semibold text-slate-700 mt-1">
                                        {{ $winner->employee->position ?? '-' }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- NILAI AKHIR --}}
                    {{-- ================================================= --}}
                    <div class="mt-8 pt-6 border-t border-slate-100">

                        <div class="max-w-sm mx-auto text-center">

                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Nilai Akhir
                            </p>

                            <div class="mt-2 flex items-baseline justify-center gap-1">

                                <span class="text-5xl font-bold text-slate-800">
                                    {{ number_format($winner->final_score ?? 0, 2) }}
                                </span>

                                <span class="text-lg font-medium text-slate-400">
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