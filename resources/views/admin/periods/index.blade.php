<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Manajemen Periode
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Kelola periode pemilihan pegawai teladan.
                </p>
            </div>

            <a href="{{ route('admin.periods.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                + Tambah Periode
            </a>
        </div>
    </x-slot>


    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- SUCCESS --}}
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif


            {{-- ERROR --}}
            @if (session('error'))
                <div class="mb-6 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif


            {{-- VALIDATION ERROR --}}
            @if ($errors->any())
                <div class="mb-6 rounded-lg bg-red-50 border border-red-200 px-4 py-3">

                    <ul class="text-sm text-red-700 list-disc list-inside">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>
            @endif


            {{-- TABLE --}}
            <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">

                <div class="px-6 py-4 border-b border-gray-200">

                    <h3 class="font-semibold text-gray-800">
                        Daftar Periode
                    </h3>

                </div>


                @if ($periods->count())

                    <div class="overflow-x-auto">

                        <table class="w-full text-sm text-left">

                            <thead class="bg-gray-50 border-b border-gray-200">

                                <tr>

                                    <th class="px-6 py-4 font-semibold text-gray-600">
                                        Periode
                                    </th>

                                    <th class="px-6 py-4 font-semibold text-gray-600">
                                        Mulai
                                    </th>

                                    <th class="px-6 py-4 font-semibold text-gray-600">
                                        Selesai
                                    </th>

                                    <th class="px-6 py-4 font-semibold text-gray-600">
                                        Status
                                    </th>

                                    <th class="px-6 py-4 font-semibold text-gray-600 text-right">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-100">

                                @foreach ($periods as $period)

                                    <tr @if ($period->status === 'completed')
                                        onclick="window.location='{{ route('admin.periods.winner', $period) }}'"
                                    class="cursor-pointer hover:bg-gray-50 transition" @else
                                        class="hover:bg-gray-50 transition" @endif>

                                        {{-- NAMA PERIODE --}}
                                        <td class="px-6 py-4">

                                            <div class="font-medium text-gray-800">
                                                {{ $period->name }}
                                            </div>

                                            @if ($period->status === 'completed')
                                                <div class="text-xs text-gray-400 mt-1">
                                                    Klik untuk melihat Pegawai Teladan
                                                </div>
                                            @endif

                                        </td>


                                        {{-- TANGGAL MULAI --}}
                                        <td class="px-6 py-4 text-gray-600">

                                            {{ $period->start_date->format('d M Y') }}

                                        </td>


                                        {{-- TANGGAL SELESAI --}}
                                        <td class="px-6 py-4 text-gray-600">

                                            {{ $period->end_date->format('d M Y') }}

                                        </td>


                                        {{-- STATUS --}}
                                        <td class="px-6 py-4">

                                            @if ($period->status === 'active')

                                                <span
                                                    class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                                    Aktif
                                                </span>

                                            @elseif ($period->status === 'upcoming')

                                                <span
                                                    class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                                    Akan Datang
                                                </span>

                                            @else

                                                <span
                                                    class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                                    Selesai
                                                </span>

                                            @endif

                                        </td>


                                        {{-- AKSI --}}
                                        <td class="px-6 py-4 text-right" onclick="event.stopPropagation()">

                                            <div class="flex items-center justify-end gap-2">

                                                {{-- AKTIFKAN --}}
                                                @if ($period->status !== 'active')

                                                    <form action="{{ route('admin.periods.activate', $period) }}" method="POST"
                                                        onclick="event.stopPropagation()"
                                                        onsubmit="return confirm('Aktifkan periode &quot;{{ $period->name }}&quot; sekarang?')">
                                                        @csrf

                                                        <button type="submit"
                                                            class="inline-flex items-center px-3 py-2 rounded-lg bg-green-100 text-green-700 text-xs font-semibold hover:bg-green-200">
                                                            Aktifkan
                                                        </button>
                                                    </form>

                                                @endif


                                                {{-- EDIT --}}
                                                <a href="{{ route('admin.periods.edit', $period) }}"
                                                    onclick="event.stopPropagation()"
                                                    class="inline-flex items-center px-3 py-2 rounded-lg bg-gray-100 text-gray-700 text-xs font-semibold hover:bg-gray-200">
                                                    Edit
                                                </a>


                                                {{-- HAPUS --}}
                                                <form action="{{ route('admin.periods.destroy', $period) }}" method="POST"
                                                    onclick="event.stopPropagation()"
                                                    onsubmit="return confirm('Yakin ingin menghapus periode &quot;{{ $period->name }}&quot;? Tindakan ini tidak dapat dibatalkan.')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="inline-flex items-center px-3 py-2 rounded-lg bg-red-100 text-red-700 text-xs font-semibold hover:bg-red-200">
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

                    {{-- EMPTY --}}
                    <div class="px-6 py-12 text-center">

                        <p class="text-gray-500">
                            Belum ada periode.
                        </p>

                        <a href="{{ route('admin.periods.create') }}"
                            class="inline-block mt-4 text-sm font-semibold text-gray-800 hover:underline">
                            Tambah periode pertama
                        </a>

                    </div>

                @endif

            </div>

        </div>
    </div>

</x-app-layout>