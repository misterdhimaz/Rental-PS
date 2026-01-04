<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sultan Control Center | Alia Rental</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { 'primary': '#00f2ff', 'secondary': '#7000ff', 'dark': '#020617', 'card': '#0f172a' },
                    fontFamily: { orbitron: ['Orbitron', 'sans-serif'], sans: ['Plus Jakarta Sans', 'sans-serif'] }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        body { background-color: #020617; color: #f1f5f9; overflow-x: hidden; }
        .glass-sidebar { background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(20px); border-right: 1px solid rgba(255, 255, 255, 0.05); }
        .nav-link-active { background: linear-gradient(90deg, rgba(0, 242, 255, 0.1), transparent); border-left: 4px solid #00f2ff; color: #00f2ff; }
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-thumb { background: #00f2ff; border-radius: 10px; }
    </style>
</head>
<body class="antialiased flex min-h-screen">

    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-50 w-72 glass-sidebar transition-transform duration-300 lg:translate-x-0 lg:static">

        <div class="p-8 flex flex-col h-full">
            <div class="flex items-center gap-4 mb-12">
                <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center shadow-[0_0_20px_rgba(0,242,255,0.4)]">
                    <i data-lucide="shield-check" class="text-dark w-6 h-6"></i>
                </div>
                <h1 class="font-orbitron font-black text-xl tracking-tighter italic uppercase">ALIA<span class="text-primary">CORE</span></h1>
            </div>

            <nav class="flex-1 space-y-2">
                <p class="text-[9px] font-black text-slate-500 uppercase tracking-[0.4em] mb-4 ml-4">Main Terminal</p>

                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-6 py-4 rounded-xl font-bold text-sm transition-all {{ request()->routeIs('admin.dashboard') ? 'nav-link-active' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Dashboard
                </a>

                <a href="{{ route('admin.consoles.index') }}" class="flex items-center gap-4 px-6 py-4 rounded-xl font-bold text-sm transition-all {{ request()->routeIs('admin.consoles.*') ? 'nav-link-active' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <i data-lucide="gamepad-2" class="w-5 h-5"></i> Kelola Unit
                </a>

                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-4 px-6 py-4 rounded-xl font-bold text-sm transition-all {{ request()->routeIs('admin.categories.*') ? 'nav-link-active' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <i data-lucide="layers" class="w-5 h-5"></i> Kategori
                </a>

                <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-4 px-6 py-4 rounded-xl font-bold text-sm transition-all {{ request()->routeIs('admin.reports.*') ? 'nav-link-active' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <i data-lucide="bar-chart-3" class="w-5 h-5"></i> Laporan
                </a>
            </nav>

            <div class="pt-6 border-t border-white/5 space-y-4">
                <div class="flex items-center gap-3 px-4">
                    <div class="w-8 h-8 rounded-lg bg-secondary flex items-center justify-center font-bold text-xs uppercase">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase text-white leading-none">{{ Auth::user()->name }}</p>
                        <p class="text-[8px] font-bold text-slate-500 uppercase mt-1">Sultan Admin</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-3 py-4 bg-red-500/10 text-red-500 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all">
                        <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <div class="flex-1 flex flex-col min-w-0">
        <header class="h-20 flex items-center justify-between px-6 lg:px-12 sticky top-0 z-40 bg-dark/50 backdrop-blur-md border-b border-white/5">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 text-primary">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                <h2 class="font-orbitron font-bold text-sm text-slate-400 uppercase tracking-widest hidden sm:block">Control Center</h2>
            </div>

            <div class="flex items-center gap-6">
                <div class="hidden sm:flex items-center gap-3 px-4 py-2 bg-green-500/5 border border-green-500/20 rounded-full">
                    <div class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-[9px] font-black text-green-500 uppercase tracking-widest">System Online</span>
                </div>
                <button class="relative p-2 text-slate-400 hover:text-primary transition-colors">
                    <i data-lucide="bell" class="w-5 h-5"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-primary rounded-full border-2 border-dark"></span>
                </button>
            </div>
        </header>

        <main class="flex-1">
            {{ $slot }}
        </main>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>
