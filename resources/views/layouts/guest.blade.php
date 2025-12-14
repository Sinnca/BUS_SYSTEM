<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MoveON') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CDN (fallback / utility use) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <!-- Laravel Vite (KEEP THIS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-white">

    <!-- Background -->
    <div class="min-h-screen flex items-center justify-center
                bg-gradient-to-br from-[#0b1020] via-[#121933] to-[#1a2145]
                px-4">

        <div class="w-full max-w-md">

            <!-- Logo / Branding -->
            <div class="flex justify-center mb-8">
                <a href="/" class="flex items-center gap-3">
                    <x-application-logo
                        class="w-12 h-12 text-indigo-500 drop-shadow-lg" />
                    <span class="text-2xl font-bold tracking-wide">
                        {{ config('MoveON') }}
                    </span>
                </a>
            </div>

            <!-- Glass Card -->
            <div class="relative bg-white/5 backdrop-blur-xl
                        border border-white/10 rounded-3xl
                        shadow-2xl shadow-indigo-500/20
                        px-8 py-10">

                <!-- Decorative Glow -->
                <div class="absolute inset-0 rounded-3xl
                            bg-gradient-to-br from-indigo-500/10 to-purple-500/10
                            pointer-events-none">
                </div>

                <!-- Slot Content -->
                <div class="relative">
                    {{ $slot }}
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
    </script>

</body>
</html>
