<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Data Pegawai
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Kelola data pegawai Ruang Keteladanan
            </p>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            {{-- ========================================================= --}}
            {{-- HEADER --}}
            {{-- ========================================================= --}}

            <div class="flex items-center justify-between mb-6">

                <div>

                    <h1 class="text-2xl font-bold text-gray-800">
                        Daftar Pegawai
                    </h1>

                    <p class="text-sm text-gray-500 mt-1">
                        Total {{ $employees->count() }} pegawai
                    </p>

                </div>


                {{-- ===================================================== --}}
                {{-- TAMBAH PEGAWAI --}}
                {{-- HILANG JIKA VOTING SUDAH SELESAI --}}
                {{-- ===================================================== --}}

                @if (!$activePeriod || !$activePeriod->voting_completed)

                    <a
                        href="{{ route('admin.employees.create') }}"
                        class="px-4 py-2 bg-gray-800 text-white rounded-lg text-sm font-medium hover:bg-gray-700"
                    >
                        + Tambah Pegawai
                    </a>

                @endif

            </div>


            {{-- ========================================================= --}}
            {{-- INFO JIKA VOTING SUDAH SELESAI --}}
            {{-- ========================================================= --}}

            @if ($activePeriod && $activePeriod->voting_completed)

                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3">

                    <div class="flex items-start gap-3">

                        <svg
                            class="w-5 h-5 text-green-600 mt-0.5 shrink-0"
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


                        <div>

                            <p class="text-sm font-semibold text-green-800">
                                Pemilihan Pegawai Teladan Telah Diselesaikan
                            </p>

                            <p class="text-sm text-green-700 mt-1">
                                Periode {{ $activePeriod->name }} telah memiliki Pegawai Teladan.
                                Penambahan atau perubahan kandidat tidak tersedia untuk periode ini.
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            {{-- ========================================================= --}}
            {{-- TABLE --}}
            {{-- ========================================================= --}}

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">


                        {{-- ================================================= --}}
                        {{-- HEADER TABLE --}}
                        {{-- ================================================= --}}

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                                    No
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                                    Pegawai
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                                    NIP
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                                    Pokja
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                                    Jabatan
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        {{-- ================================================= --}}
                        {{-- BODY --}}
                        {{-- ================================================= --}}

                        <tbody class="divide-y divide-gray-100">


                            @forelse($employees as $index => $employee)


                                <tr class="hover:bg-gray-50">


                                    {{-- ================================================= --}}
                                    {{-- NO --}}
                                    {{-- ================================================= --}}

                                    <td class="px-6 py-4 text-sm text-gray-600">

                                        {{ $index + 1 }}

                                    </td>


                                    {{-- ================================================= --}}
                                    {{-- PEGAWAI --}}
                                    {{-- ================================================= --}}

                                    <td class="px-6 py-4">

                                        <div class="flex items-center gap-3">


                                            @if($employee->photo)

                                                <img
                                                    src="{{ asset('storage/' . $employee->photo) }}"
                                                    alt="{{ $employee->name }}"
                                                    class="w-10 h-10 rounded-full object-cover"
                                                >

                                            @else

                                                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">

                                                    <span class="text-sm font-semibold text-gray-500">

                                                        {{ strtoupper(substr($employee->name, 0, 1)) }}

                                                    </span>

                                                </div>

                                            @endif


                                            <div>

                                                <p class="font-medium text-gray-800">
                                                    {{ $employee->name }}
                                                </p>

                                                <p class="text-xs text-gray-500">
                                                    {{ $employee->phone ?? '-' }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- ================================================= --}}
                                    {{-- NIP --}}
                                    {{-- ================================================= --}}

                                    <td class="px-6 py-4 text-sm text-gray-700">

                                        {{ $employee->nip }}

                                    </td>


                                    {{-- ================================================= --}}
                                    {{-- POKJA --}}
                                    {{-- ================================================= --}}

                                    <td class="px-6 py-4 text-sm text-gray-700">

                                        {{ $employee->pokja ?? '-' }}

                                    </td>


                                    {{-- ================================================= --}}
                                    {{-- JABATAN --}}
                                    {{-- ================================================= --}}

                                    <td class="px-6 py-4 text-sm text-gray-700">

                                        {{ $employee->position ?? '-' }}

                                    </td>


                                    {{-- ================================================= --}}
                                    {{-- STATUS --}}
                                    {{-- ================================================= --}}

                                    <td class="px-6 py-4">

                                        @if($employee->status === 'active')

                                            <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">

                                                Aktif

                                            </span>

                                        @else

                                            <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-600">

                                                Tidak Aktif

                                            </span>

                                        @endif

                                    </td>


                                    {{-- ================================================= --}}
                                    {{-- AKSI --}}
                                    {{-- ================================================= --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="flex items-center justify-end gap-2">


                                            {{-- ================================================= --}}
                                            {{-- EDIT --}}
                                            {{-- ================================================= --}}

                                            <a
                                                href="{{ route('admin.employees.edit', $employee) }}"
                                                class="px-3 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700"
                                            >
                                                Edit
                                            </a>


                                            {{-- ================================================= --}}
                                            {{-- HAPUS --}}
                                            {{-- TETAP ADA --}}
                                            {{-- ================================================= --}}

                                            <form
                                                action="{{ route('admin.employees.destroy', $employee) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus {{ $employee->name }} secara PERMANEN? Seluruh riwayat kandidat dan penilaian miliknya akan ikut terhapus dan tidak bisa dikembalikan.')"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="px-3 py-2 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700"
                                                >
                                                    Hapus
                                                </button>

                                            </form>


                                            {{-- ================================================= --}}
                                            {{-- KANDIDAT --}}
                                            {{-- HANYA MUNCUL JIKA VOTING BELUM SELESAI --}}
                                            {{-- ================================================= --}}

                                            @if (!$activePeriod || !$activePeriod->voting_completed)


                                                @if (in_array($employee->id, $candidateEmployeeIds))


                                                    {{-- ================================================= --}}
                                                    {{-- BATALKAN KANDIDAT --}}
                                                    {{-- ================================================= --}}

                                                    <form
                                                        action="{{ route('admin.employees.cancel-candidate', $employee) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Batalkan {{ $employee->name }} sebagai kandidat periode ini?')"
                                                    >

                                                        @csrf

                                                        <button
                                                            type="submit"
                                                            class="px-3 py-2 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700"
                                                        >
                                                            Batalkan Kandidat
                                                        </button>

                                                    </form>


                                                @else


                                                    {{-- ================================================= --}}
                                                    {{-- PILIH KANDIDAT --}}
                                                    {{-- ================================================= --}}

                                                    <form
                                                        action="{{ route('admin.employees.select-candidate', $employee) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Pilih {{ $employee->name }} sebagai kandidat periode ini?')"
                                                    >

                                                        @csrf

                                                        <button
                                                            type="submit"
                                                            class="px-3 py-2 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700"
                                                        >
                                                            Pilih Kandidat
                                                        </button>

                                                    </form>

                                                @endif


                                            @endif


                                        </div>

                                    </td>


                                </tr>


                            @empty


                                <tr>

                                    <td
                                        colspan="7"
                                        class="px-6 py-12 text-center text-gray-500"
                                    >

                                        Belum ada data pegawai.

                                    </td>

                                </tr>


                            @endforelse


                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>