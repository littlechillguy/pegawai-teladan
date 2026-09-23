<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tambah Pegawai
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Tambahkan data pegawai baru ke Ruang Keteladanan
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

                <form
                    method="POST"
                    action="{{ route('admin.employees.store') }}"
                    enctype="multipart/form-data"
                >

                    @csrf

                    {{-- Data Pegawai --}}
                    <div class="mb-8">

                        <h3 class="text-lg font-semibold text-gray-800">
                            Data Pegawai
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Informasi dasar pegawai.
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
                                value="{{ old('nip') }}"
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
                                value="{{ old('name') }}"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('name')"
                                class="mt-2"
                            />
                        </div>

                       {{-- Pokja --}}
<div>
    <x-input-label
        for="pokja"
        value="Pokja"
    />

    <x-text-input
        id="pokja"
        name="pokja"
        type="text"
        class="block mt-1 w-full"
        value="{{ old('pokja') }}"
        required
    />

    <x-input-error
        :messages="$errors->get('pokja')"
        class="mt-2"
    />
</div>

                        {{-- Position --}}
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
                                value="{{ old('position') }}"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('position')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Phone --}}
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
                                value="{{ old('phone') }}"
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
                                    {{ old('status', 'active') === 'active' ? 'selected' : '' }}
                                >
                                    Aktif
                                </option>

                                <option
                                    value="inactive"
                                    {{ old('status') === 'inactive' ? 'selected' : '' }}
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
                            NIP pegawai akan digunakan sebagai username untuk login.
                        </p>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Password --}}
                        <div>

                            <x-input-label
                                for="password"
                                value="Password"
                            />

                            <x-text-input
                                id="password"
                                name="password"
                                type="password"
                                class="block mt-1 w-full"
                                required
                            />

                            <p class="mt-1 text-xs text-gray-500">
                                Minimal 8 karakter.
                            </p>

                            <x-input-error
                                :messages="$errors->get('password')"
                                class="mt-2"
                            />

                        </div>

                        {{-- Confirm Password --}}
                        <div>

                            <x-input-label
                                for="password_confirmation"
                                value="Konfirmasi Password"
                            />

                            <x-text-input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                class="block mt-1 w-full"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('password_confirmation')"
                                class="mt-2"
                            />

                        </div>

                    </div>


                    {{-- Buttons --}}
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
                            Simpan Pegawai
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>