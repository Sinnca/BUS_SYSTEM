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
    <!-- Add this link to include Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Laravel Vite (KEEP THIS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-white">

    <!-- Background -->
    <div class="min-h-screen flex items-center justify-center"
         style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.6) 0%, rgba(250, 245, 255, 0.6) 50%, rgba(99, 102, 241, 0.2) 100%), url('https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=1600&q=80'); background-size: cover; background-position: center;">

<div class="w-full max-w-md">

    <!-- Logo / Branding -->
    <div class="flex justify-center mb-2">
        <a href="/" class="flex items-center gap-3 group">
            <!-- Bus icon container -->
            <div class="w-12 h-12 flex items-center justify-center text-[#1a2139]">
                <i class="fas fa-bus text-3xl group-hover:scale-110 transition-transform duration-200"></i>
            </div>
            <!-- Brand name -->
            <span class="text-3xl font-bold text-[#1a2139] tracking-tight group-hover:opacity-80 transition-opacity duration-200">
                MoveON
            </span>
        </a>
    </div>

    <!-- Main Card Container -->
    <div class="relative">
        <!-- Outer glow effect -->
        <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 
                    rounded-[28px] opacity-20 blur-xl"></div>
        
        <!-- Glass Card -->
        <div class="relative bg-[#1a2139] backdrop-blur-xl
                    border-2 border-indigo-400/20 rounded-[26px]
                    shadow-2xl shadow-black/40
                    px-10 py-12">

            <!-- Top accent line -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-1 
                        bg-gradient-to-r from-transparent via-indigo-400 to-transparent 
                        rounded-full"></div>

            <!-- Decorative corner accents -->
            <div class="absolute top-4 right-4 w-20 h-20 bg-indigo-500/10 rounded-full blur-2xl"></div>
            <div class="absolute bottom-4 left-4 w-24 h-24 bg-purple-500/10 rounded-full blur-2xl"></div>

            <!-- Slot Content -->
            <div class="relative z-10">
                {{ $slot }}
            </div>

            <!-- Bottom subtle gradient -->
            <div class="absolute bottom-0 left-0 right-0 h-32 
                        bg-gradient-to-t from-indigo-500/5 to-transparent 
                        rounded-b-[26px] pointer-events-none"></div>

        </div>
    </div>

    <!-- Footer Links (Optional) -->
    

</div>

    <!-- Bootstrap JS Bundle -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
    </script>

</body>
</html>
