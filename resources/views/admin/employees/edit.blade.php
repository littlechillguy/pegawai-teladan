<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                Edit Pegawai
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Perbarui data pegawai dan akun login
            </p>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50/50 min-h-[calc(100vh-4rem)]">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6 sm:p-8">

                <form
                    method="POST"
                    action="{{ route('admin.employees.update', $employee) }}"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @method('PUT')

                    {{-- ========================================================= --}}
                    {{-- SECTION 1: DATA PEGAWAI --}}
                    {{-- ========================================================= --}}
                    <div class="mb-6 pb-4 border-b border-slate-100">
                        <h3 class="text-base font-bold text-slate-800 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-teal-500 inline-block"></span>
                            Data Pegawai
                        </h3>
                        <p class="text-xs text-slate-500 mt-1">
                            Perbarui informasi pegawai.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- NIP --}}
                        <div>
                            <x-input-label
                                for="nip"
                                value="NIP"
                                class="!font-semibold !text-slate-700"
                            />

                            <x-text-input
                                id="nip"
                                name="nip"
                                type="text"
                                class="block mt-1.5 w-full !rounded-xl !border-slate-200 focus:!border-teal-500 focus:!ring-teal-500/20 text-sm"
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
                                class="!font-semibold !text-slate-700"
                            />

                            <x-text-input
                                id="name"
                                name="name"
                                type="text"
                                class="block mt-1.5 w-full !rounded-xl !border-slate-200 focus:!border-teal-500 focus:!ring-teal-500/20 text-sm"
                                value="{{ old('name', $employee->name) }}"
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
                                class="!font-semibold !text-slate-700"
                            />

                            <x-text-input
                                id="pokja"
                                name="pokja"
                                type="text"
                                class="block mt-1.5 w-full !rounded-xl !border-slate-200 focus:!border-teal-500 focus:!ring-teal-500/20 text-sm"
                                value="{{ old('pokja', $employee->pokja) }}"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('pokja')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Jabatan --}}
                        <div>
                            <x-input-label
                                for="position"
                                value="Jabatan"
                                class="!font-semibold !text-slate-700"
                            />

                            <x-text-input
                                id="position"
                                name="position"
                                type="text"
                                class="block mt-1.5 w-full !rounded-xl !border-slate-200 focus:!border-teal-500 focus:!ring-teal-500/20 text-sm"
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
                                class="!font-semibold !text-slate-700"
                            />

                            <x-text-input
                                id="phone"
                                name="phone"
                                type="text"
                                class="block mt-1.5 w-full !rounded-xl !border-slate-200 focus:!border-teal-500 focus:!ring-teal-500/20 text-sm"
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
                                class="!font-semibold !text-slate-700"
                            />

                            <select
                                id="status"
                                name="status"
                                class="block mt-1.5 w-full border-slate-200 focus:border-teal-500 focus:ring-teal-500/20 rounded-xl shadow-sm text-sm text-slate-700"
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

                    {{-- Foto Pegawai --}}
                    <div class="mt-6 pt-4 border-t border-slate-100">
                        <x-input-label
                            for="photo"
                            value="Foto Pegawai"
                            class="!font-semibold !text-slate-700"
                        />

                        @if($employee->photo)
                            <div class="mt-3 mb-4 flex items-center gap-4 p-3 rounded-2xl bg-slate-50 border border-slate-200/80 w-fit">
                                <img
                                    src="{{ asset('storage/' . $employee->photo) }}"
                                    alt="{{ $employee->name }}"
                                    class="w-16 h-16 rounded-xl object-cover border border-slate-200 shadow-sm"
                                >
                                <div class="pr-2">
                                    <p class="text-xs font-semibold text-slate-700">
                                        Foto saat ini
                                    </p>
                                    <p class="text-[11px] text-slate-500 mt-0.5">
                                        Upload foto baru di bawah jika ingin menggantinya.
                                    </p>
                                </div>
                            </div>
                        @endif

                        <div class="mt-2 flex items-center gap-4">
                            <input
                                id="photo"
                                name="photo"
                                type="file"
                                accept=".jpg,.jpeg,.png,.webp"
                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 border border-slate-200 rounded-xl cursor-pointer bg-white focus:outline-none transition-all"
                            >
                        </div>

                        <p class="mt-1.5 text-xs text-slate-400">
                            Format yang didukung: JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                        </p>

                        <x-input-error
                            :messages="$errors->get('photo')"
                            class="mt-2"
                        />
                    </div>


                    {{-- ========================================================= --}}
                    {{-- SECTION 2: AKUN LOGIN --}}
                    {{-- ========================================================= --}}
                    <div class="mt-10 mb-6 pb-4 border-b border-slate-100">
                        <h3 class="text-base font-bold text-slate-800 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-slate-800 inline-block"></span>
                            Akun Login
                        </h3>
                        <p class="text-xs text-slate-500 mt-1">
                            Kosongkan password jika tidak ingin mengubah password pegawai.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Password --}}
                        <div>
                            <x-input-label
                                for="password"
                                value="Password Baru"
                                class="!font-semibold !text-slate-700"
                            />

                            <x-text-input
                                id="password"
                                name="password"
                                type="password"
                                class="block mt-1.5 w-full !rounded-xl !border-slate-200 focus:!border-teal-500 focus:!ring-teal-500/20 text-sm"
                                placeholder="••••••••"
                            />

                            <p class="mt-1 text-xs text-slate-400">
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
                                class="!font-semibold !text-slate-700"
                            />

                            <x-text-input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                class="block mt-1.5 w-full !rounded-xl !border-slate-200 focus:!border-teal-500 focus:!ring-teal-500/20 text-sm"
                                placeholder="••••••••"
                            />

                            <x-input-error
                                :messages="$errors->get('password_confirmation')"
                                class="mt-2"
                            />
                        </div>

                    </div>


                    {{-- ========================================================= --}}
                    {{-- BUTTONS --}}
                    {{-- ========================================================= --}}
                    <div class="flex items-center justify-end gap-3 mt-10 pt-6 border-t border-slate-100">

                        <a
                            href="{{ route('admin.employees.index') }}"
                            class="px-4 py-2.5 text-sm font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-all"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2.5 text-sm font-semibold text-white bg-slate-900 hover:bg-slate-800 rounded-xl shadow-sm transition-all active:scale-[0.98]"
                        >
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>