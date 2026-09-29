<x-app-layout>

    <x-slot name="header">
        <div class=" flex items-center justify-between gap-4">

            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                    Manajemen Periode
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Kelola periode pemilihan pegawai teladan.
                </p>
            </div>

            <a
                href="{{ route('admin.periods.create') }}"
                class="inline-flex items-center justify-center gap-2
                       px-4 py-2.5
                       bg-emerald-600
                       text-white
                       rounded-xl
                       text-sm
                       font-semibold
                       shadow-sm
                       hover:bg-emerald-700
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
                        stroke-width="2.5"
                        d="M12 4v16m8-8H4"
                    />
                </svg>

                <span>Tambah Periode</span>
            </a>

        </div>
    </x-slot>


    <div class="py-8 bg-slate-50/50 min-h-[calc(100vh-4rem)]">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- ========================================================= --}}
            {{-- ALERT SUCCESS --}}
            {{-- ========================================================= --}}
            @if (session('success'))

                <div class="mb-6 flex items-start gap-3 rounded-2xl
                            bg-emerald-50 border border-emerald-200
                            px-4 py-3.5 text-sm text-emerald-700">

                    <svg
                        class="w-5 h-5 flex-shrink-0 mt-0.5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            {{-- ========================================================= --}}
            {{-- ALERT ERROR --}}
            {{-- ========================================================= --}}
            @if (session('error'))

                <div class="mb-6 flex items-start gap-3 rounded-2xl
                            bg-red-50 border border-red-200
                            px-4 py-3.5 text-sm text-red-700">

                    <svg
                        class="w-5 h-5 flex-shrink-0 mt-0.5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v2m0 4h.01M10.29 3.86l-7.82 13a2 2 0 001.71 3h15.64a2 2 0 001.71-3l-7.82-13a2 2 0 00-1.71 0z"
                        />
                    </svg>

                    <span>
                        {{ session('error') }}
                    </span>

                </div>

            @endif


            {{-- ========================================================= --}}
            {{-- VALIDATION ERROR --}}
            {{-- ========================================================= --}}
            @if ($errors->any())

                <div class="mb-6 rounded-2xl
                            bg-red-50 border border-red-200
                            px-4 py-3.5">

                    <ul class="text-sm text-red-700 list-disc list-inside space-y-1">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- ========================================================= --}}
            {{-- TABLE CARD --}}
            {{-- ========================================================= --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">

                {{-- CARD HEADER --}}
                <div class="px-6 py-5 border-b border-slate-100">

                    <div class="flex items-center justify-between gap-4">

                        <div>
                            <h3 class="font-bold text-slate-800">
                                Daftar Periode
                            </h3>

                            <p class="text-xs text-slate-500 mt-1">
                                Daftar periode pemilihan pegawai teladan.
                            </p>
                        </div>

                        <div
                            class="inline-flex items-center justify-center
                                   min-w-9 h-9 px-3
                                   rounded-xl
                                   bg-slate-100
                                   text-slate-600
                                   text-xs
                                   font-bold"
                        >
                            {{ $periods->count() }}
                        </div>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- TABLE --}}
                {{-- ===================================================== --}}
                @if ($periods->count())

                    <div class="overflow-x-auto">

                        <table class="w-full text-sm text-left">

                            <thead class="bg-slate-50 border-b border-slate-200">

                                <tr>

                                    <th class="px-6 py-4 font-semibold text-slate-600">
                                        Periode
                                    </th>

                                    <th class="px-6 py-4 font-semibold text-slate-600">
                                        Mulai
                                    </th>

                                    <th class="px-6 py-4 font-semibold text-slate-600">
                                        Selesai
                                    </th>

                                    <th class="px-6 py-4 font-semibold text-slate-600">
                                        Status
                                    </th>

                                    <th class="px-6 py-4 font-semibold text-slate-600 text-right">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-slate-100">

                                @foreach ($periods as $period)

                                    <tr
                                        @if ($period->status === 'completed')

                                            onclick="window.location='{{ route('admin.periods.winner', $period) }}'"

                                            class="cursor-pointer hover:bg-slate-50 transition-all"

                                        @else

                                            class="hover:bg-slate-50 transition-all"

                                        @endif
                                    >

                                        {{-- ================================================= --}}
                                        {{-- PERIODE --}}
                                        {{-- ================================================= --}}
                                        <td class="px-6 py-5">

                                            <div class="font-semibold text-slate-800">
                                                {{ $period->name }}
                                            </div>

                                            @if ($period->status === 'completed')

                                                <div class="flex items-center gap-1.5 text-xs text-slate-400 mt-1">

                                                    <svg
                                                        class="w-3.5 h-3.5"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15 10l4.553 2.276a1 1 0 010 1.789L15 16.34V10z"
                                                        />

                                                        <rect
                                                            width="12"
                                                            height="12"
                                                            x="3"
                                                            y="6"
                                                            rx="2"
                                                            stroke-width="2"
                                                            stroke="currentColor"
                                                            fill="none"
                                                        />
                                                    </svg>

                                                    <span>
                                                        Klik untuk melihat Pegawai Teladan
                                                    </span>

                                                </div>

                                            @endif

                                        </td>


                                        {{-- ================================================= --}}
                                        {{-- TANGGAL MULAI --}}
                                        {{-- ================================================= --}}
                                        <td class="px-6 py-5 text-slate-600 whitespace-nowrap">

                                            {{ $period->start_date->format('d M Y') }}

                                        </td>


                                        {{-- ================================================= --}}
                                        {{-- TANGGAL SELESAI --}}
                                        {{-- ================================================= --}}
                                        <td class="px-6 py-5 text-slate-600 whitespace-nowrap">

                                            {{ $period->end_date->format('d M Y') }}

                                        </td>


                                        {{-- ================================================= --}}
                                        {{-- STATUS --}}
                                        {{-- ================================================= --}}
                                        <td class="px-6 py-5">

                                            @if ($period->status === 'active')

                                                <span
                                                    class="inline-flex items-center gap-1.5
                                                           px-3 py-1.5
                                                           rounded-full
                                                           text-xs
                                                           font-semibold
                                                           bg-emerald-100
                                                           text-emerald-700"
                                                >

                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                                    Aktif

                                                </span>

                                            @elseif ($period->status === 'upcoming')

                                                <span
                                                    class="inline-flex items-center gap-1.5
                                                           px-3 py-1.5
                                                           rounded-full
                                                           text-xs
                                                           font-semibold
                                                           bg-blue-100
                                                           text-blue-700"
                                                >

                                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>

                                                    Akan Datang

                                                </span>

                                            @else

                                                <span
                                                    class="inline-flex items-center gap-1.5
                                                           px-3 py-1.5
                                                           rounded-full
                                                           text-xs
                                                           font-semibold
                                                           bg-slate-100
                                                           text-slate-600"
                                                >

                                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>

                                                    Selesai

                                                </span>

                                            @endif

                                        </td>


                                        {{-- ================================================= --}}
                                        {{-- AKSI --}}
                                        {{-- ================================================= --}}
                                        <td
                                            class="px-6 py-5 text-right"
                                            onclick="event.stopPropagation()"
                                        >

                                            <div class="flex items-center justify-end gap-2">

                                                {{-- ========================================= --}}
                                                {{-- AKTIFKAN --}}
                                                {{-- ========================================= --}}
                                                @if ($period->status !== 'active')

                                                    <form
                                                        action="{{ route('admin.periods.activate', $period) }}"
                                                        method="POST"
                                                        onclick="event.stopPropagation()"
                                                        onsubmit="return confirm('Aktifkan periode &quot;{{ $period->name }}&quot; sekarang?')"
                                                    >
                                                        @csrf

                                                        <button
                                                            type="submit"
                                                            class="inline-flex items-center gap-1.5
                                                                   px-3 py-2
                                                                   rounded-xl
                                                                   bg-emerald-100
                                                                   text-emerald-700
                                                                   text-xs
                                                                   font-semibold
                                                                   hover:bg-emerald-200
                                                                   transition-all
                                                                   active:scale-[0.98]"
                                                        >

                                                            <svg
                                                                class="w-3.5 h-3.5"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                viewBox="0 0 24 24"
                                                            >
                                                                <path
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M5 13l4 4L19 7"
                                                                />
                                                            </svg>

                                                            Aktifkan

                                                        </button>

                                                    </form>

                                                @endif


                                                {{-- ========================================= --}}
                                                {{-- EDIT --}}
                                                {{-- ========================================= --}}
                                                <a
                                                    href="{{ route('admin.periods.edit', $period) }}"
                                                    onclick="event.stopPropagation()"
                                                    class="inline-flex items-center gap-1.5
                                                           px-3 py-2
                                                           rounded-xl
                                                           bg-slate-100
                                                           text-slate-700
                                                           text-xs
                                                           font-semibold
                                                           hover:bg-slate-200
                                                           transition-all"
                                                >

                                                    <svg
                                                        class="w-3.5 h-3.5"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"
                                                        />

                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                                        />
                                                    </svg>

                                                    Edit

                                                </a>


                                                {{-- ========================================= --}}
                                                {{-- HAPUS --}}
                                                {{-- ========================================= --}}
                                                <form
                                                    action="{{ route('admin.periods.destroy', $period) }}"
                                                    method="POST"
                                                    onclick="event.stopPropagation()"
                                                    onsubmit="return confirm('Yakin ingin menghapus periode &quot;{{ $period->name }}&quot;? Tindakan ini tidak dapat dibatalkan.')"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="inline-flex items-center gap-1.5
                                                               px-3 py-2
                                                               rounded-xl
                                                               bg-red-100
                                                               text-red-700
                                                               text-xs
                                                               font-semibold
                                                               hover:bg-red-200
                                                               transition-all
                                                               active:scale-[0.98]"
                                                    >

                                                        <svg
                                                            class="w-3.5 h-3.5"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            viewBox="0 0 24 24"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m-4 0h14"
                                                            />
                                                        </svg>

                                                        Hapus

                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    {{-- ===================================================== --}}
                    {{-- EMPTY STATE --}}
                    {{-- ===================================================== --}}
                    <div class="px-6 py-16 text-center">

                        <div
                            class="mx-auto w-14 h-14
                                   flex items-center justify-center
                                   rounded-2xl
                                   bg-slate-100
                                   text-slate-400"
                        >

                            <svg
                                class="w-7 h-7"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                                />
                            </svg>

                        </div>

                        <p class="mt-4 text-sm font-semibold text-slate-700">
                            Belum ada periode
                        </p>

                        <p class="mt-1 text-xs text-slate-400">
                            Buat periode pertama untuk memulai pemilihan pegawai teladan.
                        </p>

                        <a
                            href="{{ route('admin.periods.create') }}"
                            class="inline-flex items-center gap-2
                                   mt-5
                                   px-4 py-2.5
                                   rounded-xl
                                   bg-emerald-600
                                   text-white
                                   text-sm
                                   font-semibold
                                   hover:bg-emerald-700
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
                                    stroke-width="2.5"
                                    d="M12 4v16m8-8H4"
                                />
                            </svg>

                            Tambah Periode

                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>