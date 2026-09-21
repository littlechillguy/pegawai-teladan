<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Pegawai
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Perbarui data pegawai dan akun login
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

                <form
                    method="POST"
                    action="{{ route('admin.employees.update', $employee) }}"
                    enctype="multipart/form-data"
                >

                    @csrf
                    @method('PUT')

                    {{-- Data Pegawai --}}
                    <div class="mb-6">

                        <h3 class="text-lg font-semibold text-gray-800">
                            Data Pegawai
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Perbarui informasi pegawai.
                        </p>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- NIP --}}
                        <div>
                            <x-input-label
                                for="nip"
                                value="NIP"
                            />

                            <x-text-input
                                id="nip"
                                name="nip"
                                type="text"
                                class="block mt-1 w-full"
                                value="{{ old('nip', $employee->nip) }}"
                                required
                                autofocus
                            />

                            <x-input-error
                                :messages="$errors->get('nip')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Nama --}}
                        <div>
                            <x-input-label
                                for="name"
                                value="Nama Lengkap"
                            />

                            <x-text-input
                                id="name"
                                name="name"
                                type="text"
                                class="block mt-1 w-full"
                                value="{{ old('name', $employee->name) }}"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('name')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Departemen --}}
                        <div>
                            <x-input-label
                                for="department"
                                value="Departemen"
                            />

                            <x-text-input
                                id="department"
                                name="department"
                                type="text"
                                class="block mt-1 w-full"
                                value="{{ old('department', $employee->department) }}"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('department')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Jabatan --}}
                        <div>
                            <x-input-label
                                for="position"
                                value="Jabatan"
                            />

                            <x-text-input
                                id="position"
                                name="position"
                                type="text"
                                class="block mt-1 w-full"
                                value="{{ old('position', $employee->position) }}"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('position')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Nomor Telepon --}}
                        <div>
                            <x-input-label
                                for="phone"
                                value="Nomor Telepon"
                            />

                            <x-text-input
                                id="phone"
                                name="phone"
                                type="text"
                                class="block mt-1 w-full"
                                value="{{ old('phone', $employee->phone) }}"
                            />

                            <x-input-error
                                :messages="$errors->get('phone')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Status --}}
                        <div>

                            <x-input-label
                                for="status"
                                value="Status"
                            />

                            <select
                                id="status"
                                name="status"
                                class="block mt-1 w-full border-gray-300 focus:border-gray-500 focus:ring-gray-500 rounded-md shadow-sm"
                                required
                            >

                                <option
                                    value="active"
                                    {{ old('status', $employee->status) === 'active' ? 'selected' : '' }}
                                >
                                    Aktif
                                </option>

                                <option
                                    value="inactive"
                                    {{ old('status', $employee->status) === 'inactive' ? 'selected' : '' }}
                                >
                                    Tidak Aktif
                                </option>

                            </select>

                            <x-input-error
                                :messages="$errors->get('status')"
                                class="mt-2"
                            />

                        </div>

                    </div>


                    {{-- Foto --}}
                    <div class="mt-6">

                        <x-input-label
                            for="photo"
                            value="Foto Pegawai"
                        />

                        @if($employee->photo)

                            <div class="mt-3 mb-4 flex items-center gap-4">

                                <img
                                    src="{{ asset('storage/' . $employee->photo) }}"
                                    alt="{{ $employee->name }}"
                                    class="w-20 h-20 rounded-full object-cover border border-gray-200"
                                >

                                <div>
                                    <p class="text-sm font-medium text-gray-700">
                                        Foto saat ini
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        Upload foto baru jika ingin menggantinya.
                                    </p>
                                </div>

                            </div>

                        @endif

                        <input
                            id="photo"
                            name="photo"
                            type="file"
                            accept=".jpg,.jpeg,.png,.webp"
                            class="block mt-1 w-full text-sm text-gray-600 border border-gray-300 rounded-md cursor-pointer bg-white focus:outline-none"
                        >

                        <p class="mt-1 text-xs text-gray-500">
                            JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                        </p>

                        <x-input-error
                            :messages="$errors->get('photo')"
                            class="mt-2"
                        />

                    </div>


                    {{-- Akun Login --}}
                    <div class="mt-10 mb-6">

                        <h3 class="text-lg font-semibold text-gray-800">
                            Akun Login
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Kosongkan password jika tidak ingin mengubah password.
                        </p>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Password --}}
                        <div>

                            <x-input-label
                                for="password"
                                value="Password Baru"
                            />

                            <x-text-input
                                id="password"
                                name="password"
                                type="password"
                                class="block mt-1 w-full"
                            />

                            <p class="mt-1 text-xs text-gray-500">
                                Minimal 8 karakter.
                            </p>

                            <x-input-error
                                :messages="$errors->get('password')"
                                class="mt-2"
                            />

                        </div>

                        {{-- Konfirmasi Password --}}
                        <div>

                            <x-input-label
                                for="password_confirmation"
                                value="Konfirmasi Password Baru"
                            />

                            <x-text-input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                class="block mt-1 w-full"
                            />

                            <x-input-error
                                :messages="$errors->get('password_confirmation')"
                                class="mt-2"
                            />

                        </div>

                    </div>


                    {{-- Tombol --}}
                    <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">

                        <a
                            href="{{ route('admin.employees.index') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2 text-sm font-medium text-white bg-gray-800 rounded-lg hover:bg-gray-700"
                        >
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>