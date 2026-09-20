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

            <x-text-input
                id="nip"
                class="block mt-1 w-full"
                type="text"
                name="nip"
                :value="old('nip')"
                required
                autofocus
                autocomplete="username"
            />

            <x-input-error :messages="$errors->get('nip')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="'Password'" />

            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-6">
            <button
                type="submit"
                class="w-full px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
            >
                Login
            </button>
        </div>
    </form>
</x-guest-layout>