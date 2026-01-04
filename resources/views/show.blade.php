<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $console->name }} | Elite Rental</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { background-color: #050505; color: white; font-family: 'Inter', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .neon-glow { box-shadow: 0 0 30px rgba(0, 242, 255, 0.2); }
    </style>
</head>
<body class="bg-black text-white min-h-screen">

    <div class="container mx-auto px-6 py-12" x-data="{ duration: 1, price: {{ $console->price_per_hour }} }">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-cyan-400 transition mb-8 font-orbitron text-xs">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> BACK TO CATALOG
        </a>

        <div class="grid md:grid-cols-2 gap-12">
            <div class="space-y-6">
                <div class="relative group overflow-hidden rounded-3xl border border-white/10 neon-glow">
                    <img src="https://images.unsplash.com/photo-1606144042614-b2417e99c4e3?q=80&w=1000" class="w-full aspect-video object-cover transition duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <h1 class="text-4xl font-orbitron font-black uppercase tracking-tighter">{{ $console->name }}</h1>
                        <span class="px-4 py-1 bg-cyan-500 text-black text-[10px] font-black rounded-full uppercase mt-2 inline-block">
                            {{ $console->category->name }}
                        </span>
                    </div>
                </div>

                <div class="glass p-8 rounded-3xl">
                    <h3 class="font-orbitron text-sm font-bold text-cyan-400 mb-4 uppercase">Console Specification</h3>
                    <p class="text-gray-400 leading-relaxed">{{ $console->description }}</p>
                    <div class="grid grid-cols-2 gap-4 mt-8">
                        <div class="p-4 bg-white/5 rounded-xl border border-white/5 text-center">
                            <p class="text-[10px] text-gray-500 uppercase font-bold">Performance</p>
                            <p class="font-orbitron text-white">4K / 120 FPS</p>
                        </div>
                        <div class="p-4 bg-white/5 rounded-xl border border-white/5 text-center">
                            <p class="text-[10px] text-gray-500 uppercase font-bold">Controller</p>
                            <p class="font-orbitron text-white">DualSense Pro</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="sticky top-12 glass p-8 rounded-3xl border-t-4 border-t-cyan-500">
                    <h2 class="font-orbitron text-2xl font-bold mb-8 uppercase tracking-widest">Book Your Session</h2>

                    @if(session('success'))
                        <div class="bg-green-500/20 border border-green-500 text-green-400 p-4 rounded-xl mb-6 text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('booking.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="console_id" value="{{ $console->id }}">

                        <div>
                            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 ml-1">Select Start Time</label>
                            <input type="datetime-local" name="start_time" required
                                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-cyan-500 text-white">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 ml-1">Duration (Hours)</label>
                            <div class="flex items-center gap-4 bg-white/5 border border-white/10 rounded-xl p-2">
                                <button type="button" @click="duration > 1 ? duration-- : null" class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center hover:bg-white/10 transition">-</button>
                                <input type="number" name="duration" x-model="duration" readonly
                                    class="flex-1 bg-transparent text-center font-orbitron font-bold text-xl outline-none">
                                <button type="button" @click="duration++" class="w-10 h-10 rounded-lg bg-cyan-500 text-black flex items-center justify-center hover:bg-cyan-400 transition">+</button>
                            </div>
                        </div>

                        <div class="bg-cyan-500/10 rounded-2xl p-6 border border-cyan-500/20">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-gray-400">Price per hour</span>
                                <span class="font-orbitron text-sm">Rp {{ number_format($console->price_per_hour, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center border-t border-white/10 pt-4">
                                <span class="font-bold text-white uppercase text-xs tracking-widest">Grand Total</span>
                                <span class="font-orbitron text-2xl font-black text-cyan-400" x-text="'Rp ' + (duration * price).toLocaleString('id-ID')"></span>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-cyan-500 hover:bg-cyan-400 text-black font-orbitron font-black py-4 rounded-xl transition-all duration-300 transform hover:scale-[1.02] shadow-[0_10px_20px_rgba(0,242,255,0.3)]">
                            CONFIRM BOOKING
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>
