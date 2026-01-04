<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ELITE RENTAL | @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    @stack('styles')
    <style>
        body { background: #020617; color: #f8fafc; font-family: 'Inter', sans-serif; overflow-x: hidden; }
        .glass { background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .text-glow { text-shadow: 0 0 15px rgba(34, 211, 238, 0.5); }
        .mesh-gradient {
            background: radial-gradient(at 0% 0%, rgba(34, 211, 238, 0.15) 0px, transparent 50%),
                        radial-gradient(at 100% 100%, rgba(129, 140, 248, 0.15) 0px, transparent 50%);
        }
    </style>
</head>
<body class="mesh-gradient min-h-screen">
    <nav class="fixed top-0 w-full z-50 glass border-b border-white/5 px-6 py-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="flex items-center gap-3 group">
                <div class="p-2 bg-primary/20 rounded-lg group-hover:bg-primary/40 transition">
                    <i data-lucide="gamepad-2" class="text-primary w-6 h-6"></i>
                </div>
                <span class="font-orbitron font-black text-xl tracking-tighter uppercase">Elite<span class="text-primary">Rent</span></span>
            </a>

            <div class="hidden md:flex gap-10 font-orbitron text-[10px] tracking-[0.3em] font-bold">
                <a href="/" class="hover:text-primary transition">Consoles</a>
                <a href="/dashboard" class="hover:text-primary transition">Dashboard</a>
                <a href="#" class="hover:text-primary transition">Special Offers</a>
            </div>

            <div class="flex items-center gap-4">
                @auth
                    <a href="/dashboard" class="glass px-5 py-2 rounded-full text-xs font-bold border-primary/20 hover:border-primary transition">MY ACCOUNT</a>
                @else
                    <a href="/login" class="bg-primary text-dark-950 px-6 py-2 rounded-full text-xs font-black font-orbitron hover:scale-105 transition shadow-glow-primary">LOGIN</a>
                @endauth
            </div>
        </div>
    </nav>

    @yield('content')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });
        lucide.createIcons();
    </script>
</body>
</html>
