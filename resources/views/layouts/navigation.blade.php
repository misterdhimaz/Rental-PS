<nav class="glass-nav sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center shadow-[0_0_15px_rgba(0,242,255,0.3)]">
                        <i data-lucide="gamepad-2" class="text-dark w-6 h-6"></i>
                    </div>
                    <span class="font-orbitron font-black text-white tracking-tighter uppercase italic">ALIA<span class="text-primary italic">CORE</span></span>
                </a>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right mr-3 hidden sm:block">
                    <p class="text-[10px] font-black text-primary uppercase tracking-widest">{{ Auth::user()->name }}</p>
                    <p class="text-[8px] text-slate-500 uppercase font-bold">{{ Auth::user()->is_admin ? 'Admin Control' : 'Elite Member' }}</p>
                </div>
                @if(Auth::user()->is_admin)
    <div class="flex gap-2 bg-white/5 p-1 rounded-2xl border border-white/5">
        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-dark' : 'text-slate-500' }}">Dashboard</a>
        <a href="{{ route('admin.consoles.index') }}" class="px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest {{ request()->routeIs('admin.consoles.*') ? 'bg-primary text-dark' : 'text-slate-500' }}">Kelola Unit</a>
        <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest {{ request()->routeIs('admin.categories.*') ? 'bg-secondary text-white' : 'text-slate-500' }}">Kategori</a>
    </div>
@endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="p-3 bg-red-500/10 border border-red-500/20 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
