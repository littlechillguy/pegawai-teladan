<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ubah Password
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Perbarui password akun Anda
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Warning --}}
            @if (session('warning'))
                <div class="mb-6 rounded-lg bg-yellow-50 border border-yellow-200 px-4 py-3">
                    <div class="flex items-start gap-3">
                        <span class="text-yellow-600 text-lg">⚠</span>

                        <p class="text-sm font-medium text-yellow-700">
                            {{ session('warning') }}
                        </p>
                    </div>
                </div>
            @endif

            {{-- Success --}}
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 px-4 py-3">
                    <p class="text-sm font-medium text-green-700">
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            {{-- Form --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100">

                {{-- Header Card --}}
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Ubah Password
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Masukkan password lama dan password baru Anda.
                    </p>
                </div>

                <form
                    action="{{ route('password.update') }}"
                    method="POST"
                    class="p-6"
                >

                    @csrf
                    @method('PUT')

                    {{-- PASSWORD LAMA --}}
                    <div>
                        <label
                            for="current_password"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Password Lama
                        </label>

                        <div class="relative mt-2">

                            <input
                                id="current_password"
                                type="password"
                                name="current_password"
                                required
                                autocomplete="current-password"
                                class="block w-full rounded-lg border-gray-300 pr-12 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Masukkan password lama"
                            >

                            {{-- Toggle --}}
                            <button
                                type="button"
                                onclick="togglePassword('current_password', this)"
                                class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-400 hover:text-gray-600"
                                aria-label="Tampilkan password"
                            >

                                {{-- Mata terbuka --}}
                                <svg
                                    class="w-5 h-5 eye-open"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                    />
                                </svg>

                                {{-- Mata dicoret --}}
                                <svg
                                    class="w-5 h-5 eye-closed hidden"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 3l18 18"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10.477 10.477a3 3 0 004.243 4.243"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9.88 19.08A10.94 10.94 0 0112 19c4.477 0 8.268-2.943 9.542-7a11.05 11.05 0 00-3.04-4.75"
                                    />
                                </svg>

                            </button>
                        </div>

                        @error('current_password')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- PASSWORD BARU --}}
                    <div class="mt-5">

                        <label
                            for="password"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Password Baru
                        </label>

                        <div class="relative mt-2">

                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                class="block w-full rounded-lg border-gray-300 pr-12 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Masukkan password baru"
                            >

                            {{-- Toggle --}}
                            <button
                                type="button"
                                onclick="togglePassword('password', this)"
                                class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-400 hover:text-gray-600"
                                aria-label="Tampilkan password"
                            >

                                {{-- Mata terbuka --}}
                                <svg
                                    class="w-5 h-5 eye-open"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                    />
                                </svg>

                                {{-- Mata dicoret --}}
                                <svg
                                    class="w-5 h-5 eye-closed hidden"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 3l18 18"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10.477 10.477a3 3 0 004.243 4.243"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268-2.943 9.542-7"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9.88 19.08A10.94 10.94 0 0112 19c4.477 0 8.268-2.943 9.542-7a11.05 11.05 0 00-3.04-4.75"
                                    />
                                </svg>

                            </button>
                        </div>

                        <p class="mt-2 text-xs text-gray-500">
                            Password minimal 8 karakter.
                        </p>

                        @error('password')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- KONFIRMASI PASSWORD --}}
                    <div class="mt-5">

                        <label
                            for="password_confirmation"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Konfirmasi Password Baru
                        </label>

                        <div class="relative mt-2">

                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                class="block w-full rounded-lg border-gray-300 pr-12 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Ulangi password baru"
                            >

                            {{-- Toggle --}}
                            <button
                                type="button"
                                onclick="togglePassword('password_confirmation', this)"
                                class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-400 hover:text-gray-600"
                                aria-label="Tampilkan password"
                            >

                                {{-- Mata terbuka --}}
                                <svg
                                    class="w-5 h-5 eye-open"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                    />
                                </svg>

                                {{-- Mata dicoret --}}
                                <svg
                                    class="w-5 h-5 eye-closed hidden"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 3l18 18"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10.477 10.477a3 3 0 004.243 4.243"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268-2.943 9.542-7"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9.88 19.08A10.94 10.94 0 0112 19c4.477 0 8.268-2.943 9.542-7a11.05 11.05 0 00-3.04-4.75"
                                    />
                                </svg>

                            </button>
                        </div>

                    </div>


                    {{-- BUTTON --}}
                    <div class="mt-6 flex items-center justify-end gap-3">

                        <a
                            href="{{ url()->previous() }}"
                            class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 text-sm font-medium hover:bg-gray-50 transition"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2 rounded-lg bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition"
                        >
                            Simpan Password
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>


    {{-- PASSWORD TOGGLE SCRIPT --}}
    <script>
        function togglePassword(inputId, button) {

            const input = document.getElementById(inputId);
            const eyeOpen = button.querySelector('.eye-open');
            const eyeClosed = button.querySelector('.eye-closed');

            if (input.type === 'password') {

                // Tampilkan password
                input.type = 'text';

                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');

                button.setAttribute(
                    'aria-label',
                    'Sembunyikan password'
                );

            } else {

                // Sembunyikan password
                input.type = 'password';

                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');

                button.setAttribute(
                    'aria-label',
                    'Tampilkan password'
                );
            }
        }
    </script>

</x-app-layout>