<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ config('app.name', 'Ruang Keteladanan') }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    <div class="min-h-screen">

        {{-- Navigation --}}
        @include('layouts.navigation')

        {{-- Header --}}
        @isset($header)
            <header class="bg-white border-b border-gray-200">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- Main Content --}}
        <main>
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <footer class="border-t border-gray-200 bg-white mt-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

                <div class="text-center">

                    <p class="text-sm font-medium text-gray-700">
                        Ruang Keteladanan
                    </p>

                    <p class="text-xs text-gray-500 mt-1">
                        Sistem Penilaian dan Penghargaan Pegawai
                    </p>

                    <p class="text-xs text-gray-400 mt-3">
                        © {{ date('Y') }} Kementerian Hak Asasi Manusia Republik Indonesia
                    </p>

                    <p class="text-xs text-gray-400 mt-1">
                        Developed by Raisya Mahija G. &amp; Dzakwan Rafly H. — SMKN 43 Jakarta
                    </p>

                </div>

            </div>
        </footer>

    </div>

</body>

</html>