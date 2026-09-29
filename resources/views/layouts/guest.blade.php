<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ruang Keteladanan') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-100">
    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-8">

        <main class="w-full max-w-md">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-7">
                {{ $slot }}
            </div>
        </main>

    </div>
</body>
</html>