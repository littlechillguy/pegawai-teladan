<x-guest-layout>
    <div class="mb-7 text-center">
        <div class="w-14 h-14 mx-auto rounded-2xl bg-emerald-600 flex items-center justify-center shadow-sm mb-4">
            <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
            </svg>
        </div>

        <h1 class="text-2xl font-extrabold text-slate-800">
            Ruang Keteladanan
        </h1>

        <p class="mt-1 text-xs font-bold tracking-widest text-emerald-600">
            PPSDM
        </p>

        <p class="mt-3 text-sm text-slate-500">
            Silakan login menggunakan NIP dan password
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        {{-- NIP --}}
        <div>
            <x-input-label for="nip" :value="'NIP'" class="text-slate-700 font-semibold"/>

            <x-text-input
                id="nip"
                class="block mt-2 w-full rounded-xl border-slate-300 bg-white text-slate-800 focus:border-emerald-500 focus:ring-emerald-500"
                type="text"
                name="nip"
                :value="old('nip')"
                required
                autofocus
                autocomplete="username"
                placeholder="Masukkan NIP"
            />

            <x-input-error :messages="$errors->get('nip')" class="mt-2"/>
        </div>

        {{-- PASSWORD --}}
        <div>
            <x-input-label for="password" :value="'Password'" class="text-slate-700 font-semibold"/>

            <div class="relative mt-2">
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="block w-full rounded-xl border-slate-300 bg-white text-slate-800 pr-12 focus:border-emerald-500 focus:ring-emerald-500"
                    placeholder="Masukkan password"
                >

                <button
                    type="button"
                    onclick="togglePassword('password', this)"
                    class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 hover:text-emerald-600 transition"
                    aria-label="Tampilkan password"
                >
                    <svg class="w-5 h-5 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>

                    <svg class="w-5 h-5 eye-closed hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 3l18 18"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.584 10.587a2 2 0 002.829 2.829"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.88 5.09A10.94 10.94 0 0112 5c4.477 0 8.268 2.943 9.542 7a10.96 10.96 0 01-4.132 5.411M6.228 6.228A10.94 10.94 0 002.458 12a10.96 10.96 0 004.132 5.411"/>
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        {{-- LOGIN --}}
        <div class="pt-2">
            <button
                type="submit"
                class="w-full px-4 py-3 rounded-xl bg-emerald-600 text-white text-sm font-bold hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 shadow-sm transition active:scale-[0.99]"
            >
                Masuk
            </button>
        </div>
    </form>

    <div class="mt-6 pt-5 border-t border-slate-100 text-center">
        <p class="text-[11px] text-slate-400">
            Ruang Keteladanan · PPSDM
        </p>
    </div>

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