<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                Data Pegawai
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Kelola data pegawai Ruang Keteladanan
            </p>
        </div>
    </x-slot>


    {{-- ========================================================= --}}
    {{-- MAIN CONTENT --}}
    {{-- ========================================================= --}}
    <div class="lg:ml-72 py-8 bg-slate-50/50 min-h-[calc(100vh-4rem)]">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- ================================================= --}}
            {{-- HEADER --}}
            {{-- ================================================= --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">

                <div>
                    <h1 class="text-xl font-bold text-slate-800">
                        Daftar Pegawai
                    </h1>

                    <p class="text-sm text-slate-500 mt-0.5">
                        Total
                        <span class="font-semibold text-emerald-700">
                            {{ $employees->count() }}
                        </span>
                        pegawai terdaftar
                    </p>
                </div>


                {{-- ================================================= --}}
                {{-- TAMBAH PEGAWAI --}}
                {{-- HILANG JIKA VOTING SUDAH SELESAI --}}
                {{-- ================================================= --}}
                <a href="{{ route('admin.employees.create') }}" class="inline-flex items-center justify-center gap-2
           px-4 py-2.5
           bg-emerald-600
           text-white
           rounded-xl
           text-sm
           font-semibold
           shadow-sm
           hover:bg-emerald-700
           transition-all
           active:scale-[0.98]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>

                    <span>Tambah Pegawai</span>
                </a>

            </div>



            {{-- ================================================= --}}
            {{-- INFO JIKA VOTING SUDAH SELESAI --}}
            {{-- ================================================= --}}
            @if ($activePeriod && $activePeriod->voting_completed)

                <div class="mb-6
                               rounded-2xl
                               border border-emerald-200
                               bg-emerald-50/70
                               p-4
                               shadow-sm">

                    <div class="flex items-start gap-3.5">

                        <div class="p-2
                                       bg-emerald-100
                                       rounded-xl
                                       text-emerald-700
                                       shrink-0
                                       mt-0.5">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>

                        </div>


                        <div>

                            <p class="text-sm font-bold text-emerald-900">
                                Pemilihan Pegawai Teladan Telah Diselesaikan
                            </p>

                            <p class="text-sm text-emerald-700 mt-0.5">
                                Periode
                                <span class="font-semibold">
                                    {{ $activePeriod->name }}
                                </span>
                                telah memiliki Pegawai Teladan.
                                Penambahan atau perubahan kandidat tidak tersedia
                                untuk periode ini.
                            </p>

                        </div>

                    </div>

                </div>

            @endif



            {{-- ================================================= --}}
            {{-- TABLE --}}
            {{-- ================================================= --}}
            <div class="bg-white
                       rounded-2xl
                       shadow-sm
                       border border-slate-200/80
                       overflow-hidden">

                {{-- TABLE HEADER --}}
                <div class="px-6 py-5
                           border-b border-slate-100
                           flex items-center justify-between">

                    <div>

                        <h3 class="text-sm font-bold text-slate-800">
                            Data Pegawai
                        </h3>

                        <p class="text-xs text-slate-400 mt-1">
                            Daftar seluruh pegawai yang terdaftar
                            dalam sistem.
                        </p>

                    </div>


                    {{-- Status periode --}}
                    @if ($activePeriod)

                                    <div class="hidden sm:flex items-center gap-2
                                                   px-3 py-1.5
                                                   rounded-lg
                                                   bg-slate-50
                                                   border border-slate-200">

                                        <span class="w-1.5 h-1.5 rounded-full
                                                {{ $activePeriod->voting_completed
                        ? 'bg-slate-400'
                        : 'bg-emerald-500' }}"></span>

                                        <span class="text-xs font-semibold text-slate-600">
                                            {{ $activePeriod->name }}
                                        </span>

                                    </div>

                    @endif

                </div>


                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-slate-100">


                        {{-- ================================================= --}}
                        {{-- HEADER TABLE --}}
                        {{-- ================================================= --}}
                        <thead class="bg-slate-50/80">

                            <tr>

                                <th class="px-6 py-4
                                           text-left
                                           text-xs
                                           font-bold
                                           text-slate-500
                                           uppercase
                                           tracking-wider">
                                    No
                                </th>

                                <th class="px-6 py-4
                                           text-left
                                           text-xs
                                           font-bold
                                           text-slate-500
                                           uppercase
                                           tracking-wider">
                                    Pegawai
                                </th>

                                <th class="px-6 py-4
                                           text-left
                                           text-xs
                                           font-bold
                                           text-slate-500
                                           uppercase
                                           tracking-wider">
                                    NIP
                                </th>

                                <th class="px-6 py-4
                                           text-left
                                           text-xs
                                           font-bold
                                           text-slate-500
                                           uppercase
                                           tracking-wider">
                                    Pokja
                                </th>

                                <th class="px-6 py-4
                                           text-left
                                           text-xs
                                           font-bold
                                           text-slate-500
                                           uppercase
                                           tracking-wider">
                                    Jabatan
                                </th>

                                <th class="px-6 py-4
                                           text-left
                                           text-xs
                                           font-bold
                                           text-slate-500
                                           uppercase
                                           tracking-wider">
                                    Status
                                </th>

                                <th class="px-6 py-4
                                           text-right
                                           text-xs
                                           font-bold
                                           text-slate-500
                                           uppercase
                                           tracking-wider">
                                    Aksi
                                </th>

                            </tr>

                        </thead>



                        {{-- ================================================= --}}
                        {{-- BODY --}}
                        {{-- ================================================= --}}
                        <tbody class="divide-y divide-slate-100 bg-white">

                            @forelse($employees as $index => $employee)

                                <tr class="hover:bg-slate-50/60
                                               transition-colors">

                                    {{-- NO --}}
                                    <td class="px-6 py-4
                                                   whitespace-nowrap
                                                   text-sm
                                                   font-medium
                                                   text-slate-400">
                                        {{ $index + 1 }}
                                    </td>


                                    {{-- ================================================= --}}
                                    {{-- PEGAWAI --}}
                                    {{-- ================================================= --}}
                                    <td class="px-6 py-4
                                                   whitespace-nowrap">

                                        <div class="flex items-center gap-3">

                                            @if($employee->photo)

                                                <img src="{{ asset('storage/' . $employee->photo) }}"
                                                    alt="{{ $employee->name }}" class="w-10 h-10
                                                                   rounded-full
                                                                   object-cover
                                                                   ring-2
                                                                   ring-slate-100
                                                                   shadow-sm">

                                            @else

                                                <div class="w-10 h-10
                                                                   rounded-full
                                                                   bg-emerald-50
                                                                   border border-emerald-100
                                                                   flex items-center
                                                                   justify-center
                                                                   shrink-0">

                                                    <span class="text-sm
                                                                       font-bold
                                                                       text-emerald-700">
                                                        {{ strtoupper(substr($employee->name, 0, 1)) }}
                                                    </span>

                                                </div>

                                            @endif


                                            <div>

                                                <p class="text-sm
                                                               font-bold
                                                               text-slate-800">
                                                    {{ $employee->name }}
                                                </p>

                                                <p class="text-xs
                                                               font-medium
                                                               text-slate-400
                                                               mt-0.5">
                                                    {{ $employee->phone ?? '-' }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- NIP --}}
                                    <td class="px-6 py-4
                                                   whitespace-nowrap
                                                   text-sm
                                                   font-semibold
                                                   text-slate-600
                                                   font-mono">
                                        {{ $employee->nip }}
                                    </td>


                                    {{-- POKJA --}}
                                    <td class="px-6 py-4
                                                   whitespace-nowrap
                                                   text-sm
                                                   text-slate-600">
                                        {{ $employee->pokja ?? '-' }}
                                    </td>


                                    {{-- JABATAN --}}
                                    <td class="px-6 py-4
                                                   whitespace-nowrap
                                                   text-sm
                                                   text-slate-600">
                                        {{ $employee->position ?? '-' }}
                                    </td>


                                    {{-- ================================================= --}}
                                    {{-- STATUS --}}
                                    {{-- ================================================= --}}
                                    <td class="px-6 py-4
                                                   whitespace-nowrap">

                                        @if($employee->status === 'active')

                                            <span class="inline-flex
                                                               items-center
                                                               gap-1.5
                                                               px-3 py-1
                                                               text-xs
                                                               font-semibold
                                                               rounded-full
                                                               bg-emerald-50
                                                               text-emerald-700
                                                               border border-emerald-200/60">

                                                <span class="w-1.5 h-1.5
                                                                   rounded-full
                                                                   bg-emerald-500"></span>

                                                Aktif

                                            </span>

                                        @else

                                            <span class="inline-flex
                                                               items-center
                                                               gap-1.5
                                                               px-3 py-1
                                                               text-xs
                                                               font-semibold
                                                               rounded-full
                                                               bg-slate-100
                                                               text-slate-500
                                                               border border-slate-200/60">

                                                <span class="w-1.5 h-1.5
                                                                   rounded-full
                                                                   bg-slate-400"></span>

                                                Tidak Aktif

                                            </span>

                                        @endif

                                    </td>


                                    {{-- ================================================= --}}
                                    {{-- AKSI --}}
                                    {{-- ================================================= --}}
                                    <td class="px-6 py-4
                                                   whitespace-nowrap">

                                        <div class="flex items-center
                                                       justify-end
                                                       gap-1.5">

                                            {{-- ===================================== --}}
                                            {{-- EDIT --}}
                                            {{-- ===================================== --}}
                                            <a href="{{ route('admin.employees.edit', $employee) }}" class="px-3 py-1.5
                                                           bg-blue-50
                                                           text-blue-600
                                                           hover:bg-blue-600
                                                           hover:text-white
                                                           border border-blue-200/60
                                                           hover:border-blue-600
                                                           text-xs
                                                           font-semibold
                                                           rounded-lg
                                                           transition-all">
                                                Edit
                                            </a>


                                            {{-- ===================================== --}}
                                            {{-- HAPUS --}}
                                            {{-- ===================================== --}}
                                            <form action="{{ route('admin.employees.destroy', $employee) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus {{ $employee->name }} secara PERMANEN? Seluruh riwayat kandidat dan penilaian miliknya akan ikut terhapus dan tidak bisa dikembalikan.')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="px-3 py-1.5
                                                               bg-rose-50
                                                               text-rose-600
                                                               hover:bg-rose-600
                                                               hover:text-white
                                                               border border-rose-200/60
                                                               hover:border-rose-600
                                                               text-xs
                                                               font-semibold
                                                               rounded-lg
                                                               transition-all">
                                                    Hapus
                                                </button>

                                            </form>


                                            {{-- ===================================== --}}
                                            {{-- KANDIDAT --}}
                                            {{-- ===================================== --}}
                                            @if (!$activePeriod || !$activePeriod->voting_completed)

                                                @if (in_array($employee->id, $candidateEmployeeIds))

                                                    {{-- BATALKAN KANDIDAT --}}
                                                    <form action="{{ route('admin.employees.cancel-candidate', $employee) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Batalkan {{ $employee->name }} sebagai kandidat periode ini?')">

                                                        @csrf

                                                        <button type="submit" class="px-3 py-1.5
                                                                               bg-amber-50
                                                                               text-amber-700
                                                                               hover:bg-amber-600
                                                                               hover:text-white
                                                                               border border-amber-200/60
                                                                               hover:border-amber-600
                                                                               text-xs
                                                                               font-semibold
                                                                               rounded-lg
                                                                               transition-all">
                                                            Batalkan Kandidat
                                                        </button>

                                                    </form>

                                                @else

                                                    {{-- PILIH KANDIDAT --}}
                                                    <form action="{{ route('admin.employees.select-candidate', $employee) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Pilih {{ $employee->name }} sebagai kandidat periode ini?')">

                                                        @csrf

                                                        <button type="submit" class="px-3 py-1.5
                                                                               bg-emerald-50
                                                                               text-emerald-700
                                                                               hover:bg-emerald-600
                                                                               hover:text-white
                                                                               border border-emerald-200/60
                                                                               hover:border-emerald-600
                                                                               text-xs
                                                                               font-semibold
                                                                               rounded-lg
                                                                               transition-all">
                                                            Pilih Kandidat
                                                        </button>

                                                    </form>

                                                @endif

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                {{-- ================================================= --}}
                                {{-- EMPTY STATE --}}
                                {{-- ================================================= --}}
                                <tr>

                                    <td colspan="7" class="px-6 py-16 text-center">

                                        <div class="flex flex-col
                                                       items-center
                                                       justify-center">

                                            <div class="w-14 h-14
                                                           bg-slate-100
                                                           rounded-2xl
                                                           flex items-center
                                                           justify-center
                                                           text-slate-400
                                                           mb-4">

                                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857
                                                               M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857
                                                               M7 20H2v-2a3 3 0 015.356-1.857
                                                               M7 20v-2c0-.656.126-1.283.356-1.857m0 0
                                                               a5.002 5.002 0 019.288 0
                                                               M15 7a3 3 0 11-6 0 3 3 0 016 0
                                                               m6 3a2 2 0 11-4 0 2 2 0 014 0
                                                               M7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>

                                            </div>


                                            <p class="text-sm
                                                           font-semibold
                                                           text-slate-600">
                                                Belum ada data pegawai
                                            </p>

                                            <p class="text-xs
                                                           text-slate-400
                                                           mt-1">
                                                Silakan tambahkan data pegawai
                                                baru terlebih dahulu.
                                            </p>

                                        </div>

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