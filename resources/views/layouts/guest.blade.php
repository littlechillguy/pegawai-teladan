<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ruang Keteladanan</title>

    <link rel="icon" type="image/png" href="{{ asset('storage/logo-ham.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-100">

    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-8">

        {{-- Branding --}}
        <div class="mb-5 text-center">
            <div class="flex items-center justify-center gap-3">
                <img
                    src="{{ asset('storage/logo-ham.png') }}"
                    alt="Logo Kementerian HAM"
                    class="w-12 h-12 object-contain"
                >

                <div class="text-left">
                    <h1 class="text-xl font-bold text-slate-900">
                        Ruang Keteladanan
                    </h1>
                    <p class="text-xs font-semibold text-emerald-600">
                        PPSDM
                    </p>
                </div>
            </div>
        </div>

        <main class="w-full max-w-md">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-7">
                {{ $slot }}
            </div>
        </main>

        <p class="mt-5 text-xs text-slate-400 text-center">
            © {{ date('Y') }} Kementerian Hak Asasi Manusia Republik Indonesia
        </p>

    </div>

</body>

</html>