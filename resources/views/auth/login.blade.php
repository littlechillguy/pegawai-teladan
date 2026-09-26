<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold">
            Pegawai Teladan
        </h1>

        <p class="mt-2 text-sm text-gray-600">
            Silakan login menggunakan NIP dan password
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="nip" :value="'NIP'" />

            <x-text-input id="nip" class="block mt-1 w-full" type="text" name="nip" :value="old('nip')" required
                autofocus autocomplete="username" />

            <x-input-error :messages="$errors->get('nip')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="'Password'" />

            <div class="relative">
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="block w-full rounded-lg border-gray-300 pr-12 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Masukkan password">

                <button type="button" onclick="togglePassword('password', this)"
                    class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-400 hover:text-gray-600"
                    aria-label="Tampilkan password">
                    {{-- Mata --}}
                    <svg class="w-5 h-5 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    {{-- Mata Dicoret --}}
                    <svg class="w-5 h-5 eye-closed hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.584 10.587a2 2 0 002.829 2.829" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.88 5.09A10.94 10.94 0 0112 5c4.477 0 8.268 2.943 9.542 7a10.96 10.96 0 01-4.132 5.411M6.228 6.228A10.94 10.94 0 002.458 12a10.96 10.96 0 004.132 5.411" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                Login
            </button>
        </div>
    </form>

    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);

            const eyeOpen = button.querySelector('.eye-open');
            const eyeClosed = button.querySelector('.eye-closed');

            if (input.type === 'password') {
                input.type = 'text';

                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');

                button.setAttribute('aria-label', 'Sembunyikan password');
            } else {
                input.type = 'password';

                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');

                button.setAttribute('aria-label', 'Tampilkan password');
            }
        }
    </script>
</x-guest-layout>