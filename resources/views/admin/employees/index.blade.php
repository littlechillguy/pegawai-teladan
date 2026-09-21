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

            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">

                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        Daftar Pegawai
                    </h1>

                    <p class="text-sm text-gray-500 mt-1">
                        Total {{ $employees->count() }} pegawai
                    </p>
                </div>

                <a
    href="{{ route('admin.employees.create') }}"
    class="px-4 py-2 bg-gray-800 text-white rounded-lg text-sm font-medium hover:bg-gray-700"
>
    + Tambah Pegawai
</a>

            </div>

            {{-- Table --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

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
                                    Departemen
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

                        <tbody class="divide-y divide-gray-100">

                            @forelse($employees as $index => $employee)

                                <tr class="hover:bg-gray-50">

                                    {{-- No --}}
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $index + 1 }}
                                    </td>

                                    {{-- Pegawai --}}
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

                                    {{-- NIP --}}
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $employee->nip }}
                                    </td>

                                    {{-- Department --}}
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $employee->department }}
                                    </td>

                                    {{-- Position --}}
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $employee->position }}
                                    </td>

                                    {{-- Status --}}
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

                                    {{-- Action --}}
                                    <td class="px-6 py-4 text-right">

                                        <a
    href="{{ route('admin.employees.edit', $employee) }}"
    class="text-sm font-medium text-gray-700 hover:text-gray-900"
>
    Edit
</a>

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