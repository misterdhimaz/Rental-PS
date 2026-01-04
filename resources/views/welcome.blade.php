<!DOCTYPE html>
<html lang="id" x-data="{
    scrolled: false,
    activeCategory: 'all',
    showModal: false,
    selectedConsole: { name: '', price: 0, duration: 1, cat: '' },
    loading: true,
    mobileMenu: false,
    cartCount: 0
}" @scroll.window="scrolled = (window.pageYOffset > 50) ? true : false" x-init="setTimeout(() => loading = false, 1500)">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alia Rental PS | Premium Gaming Experience</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#00f2ff', // Neon Cyan
                        'secondary': '#7000ff', // Deep Purple
                        'dark': { 950: '#020617', 900: '#0f172a', 800: '#1e293b', 700: '#334155' }
                    },
                    fontFamily: {
                        orbitron: ['Orbitron', 'sans-serif'],
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #020617; }
        ::-webkit-scrollbar-thumb { background: #00f2ff; border-radius: 10px; }

        body { background-color: #020617; color: #f1f5f9; font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }

        /* Navbar & Glassmorphism */
        .glass-nav {
            background: rgba(2, 6, 23, 0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 242, 255, 0.2);
        }

        .product-card {
            background: linear-gradient(145deg, #0f172a, #020617);
            border: 1px solid rgba(255, 255, 255, 0.03);
            transition: all 0.5s ease;
        }
        .product-card:hover {
            border-color: #00f2ff;
            transform: translateY(-10px);
            box-shadow: 0 40px 80px -20px rgba(0, 0, 0, 0.8), 0 0 20px rgba(0, 242, 255, 0.1);
        }

        .img-light { background: radial-gradient(circle at center, rgba(0, 242, 255, 0.12), transparent 70%); }
        .text-glow { text-shadow: 0 0 15px rgba(0, 242, 255, 0.6); }

        /* Bento Grid: Compact & Tight */
        .bento-tight {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.05);
            background: #0f172a;
            height: 100%;
        }
        .bento-tight:hover { border-color: #00f2ff; }
        .bento-overlay {
            background: linear-gradient(to top, rgba(2, 6, 23, 1) 0%, rgba(2, 6, 23, 0.4) 60%, transparent 100%);
        }

        /* Floating Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1.8) translateX(-5rem); }
            50% { transform: translateY(-20px) scale(1.8) translateX(-5rem); }
        }
        .animate-massive-float {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="antialiased">

    <div x-show="loading" class="fixed inset-0 z-[200] bg-dark-950 flex flex-col items-center justify-center">
        <div class="relative w-24 h-24 flex items-center justify-center">
            <div class="absolute inset-0 border-2 border-primary/10 rounded-full"></div>
            <div class="absolute inset-0 border-2 border-primary rounded-full border-t-transparent animate-spin"></div>
            <i data-lucide="gamepad-2" class="w-8 h-8 text-primary animate-pulse"></i>
        </div>
        <p class="mt-8 font-orbitron text-[10px] tracking-[0.5em] text-primary/60 uppercase animate-pulse">ALIA SYSTEMS LOADING</p>
    </div>
@if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
         class="fixed top-24 right-6 z-[200] bg-cyan-400 text-slate-950 px-8 py-4 rounded-2xl font-orbitron font-black shadow-2xl flex items-center gap-4 transition-all">
        <i data-lucide="check-circle" class="w-6 h-6"></i>
        <span class="text-xs tracking-widest uppercase">{{ session('success') }}</span>
        <button @click="show = false" class="ml-4 opacity-50 hover:opacity-100">&times;</button>
    </div>
@endif

   <nav class="fixed top-0 w-full z-[100] transition-all duration-500"
     :class="scrolled ? 'glass-nav py-3 shadow-2xl' : 'glass-nav py-5 shadow-xl'">
    <div class="container mx-auto px-6 flex justify-between items-center">
        <a href="/" class="flex items-center gap-4 group">
            <div class="w-11 h-11 bg-primary rounded-xl flex items-center justify-center transition-all duration-500 shadow-lg shadow-primary/20 group-hover:rotate-6">
                <i data-lucide="gamepad-2" class="text-dark-950 w-6 h-6"></i>
            </div>
            <div class="flex flex-col text-left">
                <span class="font-orbitron font-black text-xl tracking-tighter leading-none italic text-glow uppercase">ALIA<span class="text-primary italic">RENTAL</span></span>
                <span class="text-[8px] font-bold text-slate-500 tracking-[0.4em] uppercase">Premium Hub</span>
            </div>
        </a>

        <div class="hidden lg:flex items-center gap-10 font-sans text-[10px] font-black uppercase tracking-[0.25em]">
            <a href="#katalog" class="text-primary text-glow hover:text-white transition-all">Katalog</a>
            <a href="#fitur" class="text-primary text-glow hover:text-white transition-all">Fasilitas</a>
            <a href="#testi" class="text-primary text-glow hover:text-white transition-all">Testimoni</a>
        </div>

        <div class="flex items-center gap-4">
            @auth
                <a href="/dashboard" class="hidden sm:block px-6 py-2.5 bg-white/5 border border-white/10 rounded-xl font-bold text-[10px] tracking-widest uppercase hover:bg-primary hover:text-dark-950 transition-all duration-500">DASHBOARD</a>
            @else
                <a href="/login" class="hidden sm:block px-8 py-3 bg-primary text-dark-950 rounded-xl font-black text-[10px] tracking-[0.2em] uppercase hover:scale-105 shadow-lg shadow-primary/30 transition-all">Login Account</a>
            @endauth

            <button @click="mobileMenu = !mobileMenu" class="lg:hidden p-2 text-primary">
                <i data-lucide="menu" x-show="!mobileMenu" class="w-7 h-7"></i>
                <i data-lucide="x" x-show="mobileMenu" class="w-7 h-7"></i>
            </button>
        </div>
    </div>

    <div x-show="mobileMenu" x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-x-full"
         x-transition:enter-end="opacity-100 translate-x-0"
         class="lg:hidden fixed inset-0 z-50 bg-dark-950/95 backdrop-blur-xl p-8 flex flex-col gap-8 font-orbitron text-sm tracking-[0.2em]">
        <div class="flex justify-between items-center mb-10 border-b border-white/5 pb-6">
            <span class="text-primary font-black uppercase text-glow">MENU SISTEM</span>
            <i data-lucide="x" @click="mobileMenu = false" class="text-primary"></i>
        </div>
        <a href="#katalog" @click="mobileMenu = false" class="text-primary text-glow">01. KATALOG UNIT</a>
        <a href="#fitur" @click="mobileMenu = false" class="text-primary text-glow">02. FASILITAS VIP</a>
        <a href="#leaderboard" @click="mobileMenu = false" class="text-primary text-glow">03. RANKING PEMAIN</a>
        <a href="/login" class="mt-auto py-5 bg-primary text-dark-950 rounded-2xl text-center font-black shadow-lg shadow-primary/20">AKSES MASUK</a>
    </div>
</nav>

    <section class="relative min-h-screen flex items-center pt-24 pb-12 overflow-visible">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-b from-dark-950/80 via-dark-950/60 to-dark-950 z-10"></div>
            <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=2000" class="w-full h-full object-cover opacity-60 shadow-2xl" alt="Alia Rental Background">
        </div>

        <div class="container mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center relative z-10 overflow-visible">
            <div class="text-center lg:text-left z-20" data-aos="fade-right" data-aos-duration="1000">
                <div class="inline-flex items-center gap-3 px-4 py-2 rounded-lg bg-primary/10 border border-primary/20 text-primary mb-8 mt-10">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    <span class="text-[9px] font-black uppercase tracking-[0.2em]">The Best PS Rental in Palembang</span>
                </div>
                <h1 class="text-4xl md:text-7xl lg:text-8xl font-orbitron font-black leading-tight mb-8 tracking-tighter uppercase">
                    MAIN GAME <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-white to-secondary italic text-glow">SULTAN.</span>
                </h1>
                <p class="text-slate-400 text-sm md:text-lg max-w-xl mx-auto lg:mx-0 mb-12 leading-relaxed font-medium">
                    Sewa PlayStation dengan kualitas setup sultan. Alia Rental menghadirkan performa gaming 4K ultra-low latency untuk kenyamanan maksimal setiap gamers.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-6">
                    <a href="#katalog" class="w-full sm:w-auto px-10 py-5 bg-white text-dark-950 font-orbitron font-black text-[11px] tracking-[0.3em] rounded-xl hover:bg-primary transition-all shadow-2xl">SEWA SEKARANG</a>
                    <a href="#harga" class="w-full sm:w-auto px-10 py-5 border border-white/10 rounded-xl font-orbitron text-[11px] font-black tracking-[0.3em] hover:bg-white/5 transition-all uppercase">Daftar Harga</a>
                </div>

                <div class="mt-16 flex justify-center lg:justify-start gap-8 md:gap-12 border-t border-white/5 pt-12">
                    <div><p class="text-2xl md:text-3xl font-orbitron font-black text-white tracking-tighter">24<span class="text-primary">+</span></p><p class="text-[8px] font-bold text-slate-500 uppercase tracking-widest mt-2">Units</p></div>
                    <div><p class="text-2xl md:text-3xl font-orbitron font-black text-white tracking-tighter">1.2K</p><p class="text-[8px] font-bold text-slate-500 uppercase tracking-widest mt-2">Players</p></div>
                    <div><p class="text-2xl md:text-3xl font-orbitron font-black text-white tracking-tighter">4.9</p><p class="text-[8px] font-bold text-slate-500 uppercase tracking-widest mt-2">Ratings</p></div>
                </div>
            </div>

            <div class="relative flex justify-center lg:justify-end overflow-visible" data-aos="zoom-in" data-aos-duration="1200">
                <div class="relative w-full max-w-md md:max-w-lg lg:overflow-visible">
                    <img src="https://gmedia.playstation.com/is/image/SIEPDC/ps5-product-thumbnail-01-en-14sep21?$facebook$"
                         class="w-full lg:scale-[1.8] lg:-translate-x-24 lg:-translate-y-20 animate-massive-float drop-shadow-[0_0_120px_rgba(0,242,255,0.45)] z-20 relative transition-all duration-700"
                         alt="PS5 Pro Premium Sultan">
                </div>
            </div>
        </div>
    </section>

    <section id="katalog"
    class="py-40 bg-dark-900/30">

    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-center md:items-end gap-10 mb-24">
            <div class="text-center md:text-left" data-aos="fade-up">
                <h2 class="font-orbitron text-4xl md:text-5xl font-black mb-6 uppercase tracking-tighter italic">
                    <span class="text-primary italic">KATALOG</span> UNIT
                </h2>
                <p class="text-slate-500 max-w-md text-sm font-medium leading-relaxed uppercase tracking-widest">
                    Pilih Mesin Tempur Sultan. Tersedia Unit Siap Main.
                </p>
            </div>

            <div class="flex p-1.5 bg-white/5 rounded-2xl border border-white/5 overflow-x-auto max-w-full">
                <button @click="activeCategory = 'all'"
                    :class="activeCategory === 'all' ? 'bg-primary text-dark-950 font-black shadow-lg' : 'text-slate-500'"
                    class="whitespace-nowrap px-8 py-3 rounded-xl text-[10px] font-orbitron transition-all uppercase tracking-widest">
                    SEMUA
                </button>

                @foreach($categories as $cat)
                    <button @click="activeCategory = '{{ strtolower($cat->slug) }}'"
                        :class="activeCategory === '{{ strtolower($cat->slug) }}' ? 'bg-primary text-dark-950 font-black shadow-lg' : 'text-slate-500'"
                        class="whitespace-nowrap px-8 py-3 rounded-xl text-[10px] font-orbitron transition-all uppercase tracking-widest">
                        {{ $cat->name }}
                    </button>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 lg:gap-14">
            @foreach($consoles as $console)
                <div x-show="activeCategory === 'all' || activeCategory === '{{ strtolower($console->category->slug) }}'"
                     x-data="{ duration: 1, basePrice: {{ $console->price_per_hour }} }"
                     class="product-card group rounded-[2.5rem] p-4 flex flex-col h-full overflow-hidden"
                     data-aos="fade-up">

                    <div class="relative h-64 md:h-72 overflow-hidden rounded-[2rem] bg-slate-900/50 flex items-center justify-center p-6 mb-8 group">
                        <img src="https://images.unsplash.com/photo-1606144042614-b2417e99c4e3?q=80&w=800"
                             class="w-full h-full object-contain z-10 group-hover:scale-110 transition-all duration-700">
                        <div class="absolute inset-0 bg-primary/5 opacity-0 group-hover:opacity-100 transition-opacity border-2 border-primary/20 rounded-[2rem]"></div>
                        <div class="absolute top-6 left-6">
                            <span class="px-4 py-1.5 glass border border-primary/30 rounded-lg text-primary text-[10px] font-black uppercase tracking-widest">
                                {{ $console->category->name }}
                            </span>
                        </div>
                    </div>

                    <div class="px-4 flex-1 flex flex-col">
                        <h3 class="font-orbitron text-2xl font-black text-white group-hover:text-primary transition-colors mb-6 uppercase tracking-tighter">
                            {{ $console->name }}
                        </h3>

                        <div class="grid grid-cols-2 gap-4 mb-10">
                            <div class="flex items-center gap-3 p-3 bg-white/[0.02] rounded-xl border border-white/5">
                                <i data-lucide="monitor" class="w-4 h-4 text-primary opacity-50"></i>
                                <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest italic">4K / 120Hz</span>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-white/[0.02] rounded-xl border border-white/5">
                                <i data-lucide="wifi" class="w-4 h-4 text-primary opacity-50"></i>
                                <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest italic">Online</span>
                            </div>
                        </div>

                        <div class="mt-auto pt-8 border-t border-white/5 flex flex-col sm:flex-row items-center justify-between gap-6">
                            <div class="flex items-center gap-4 bg-dark-950 p-1.5 rounded-2xl border border-white/5">
                                <button @click="if(duration > 1) duration--" class="w-10 h-10 flex items-center justify-center hover:bg-primary hover:text-dark-950 rounded-xl transition-all font-black text-xl text-white">-</button>
                                <span class="font-orbitron font-black text-sm w-12 text-center text-white" x-text="duration + 'H'"></span>
                                <button @click="duration++" class="w-10 h-10 flex items-center justify-center hover:bg-primary hover:text-dark-950 rounded-xl transition-all font-black text-xl text-white">+</button>
                            </div>
                            <div class="text-center sm:text-right">
                                <p class="text-[8px] font-black text-slate-600 uppercase mb-1">TOTAL BIAYA</p>
                                <p class="text-2xl font-orbitron font-black text-white text-glow" x-text="'Rp' + (duration * basePrice).toLocaleString('id-ID')"></p>
                            </div>
                        </div>

                        <button @click="selectedConsole = {id: '{{ $console->id }}', name: '{{ $console->name }}', price: {{ $console->price_per_hour }}, duration: duration, cat: '{{ $console->category->name }}'}; showModal = true"
                                class="mt-10 w-full py-5 bg-white text-dark-950 rounded-2xl font-orbitron font-black text-[10px] tracking-[0.3em] hover:bg-primary transition-all uppercase shadow-2xl">
                            AMANKAN SLOT
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<div x-show="showModal" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-dark/95 backdrop-blur-md">
    <div @click.away="showModal = false" class="glass-card w-full max-w-lg p-10 rounded-[2.5rem] border border-primary/20 bg-slate-900 shadow-2xl">
        <h3 class="font-orbitron font-black text-xl mb-6 uppercase italic text-primary">KONFIRMASI <span class="text-white">BOOKING</span></h3>

        <form action="{{ route('booking.store') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="console_id" :value="selectedConsole.id">
            <input type="hidden" name="duration" :value="selectedConsole.duration">

            <div class="bg-white/5 p-6 rounded-2xl border border-white/5 space-y-4">
                <div class="flex justify-between">
                    <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Unit Dipilih</span>
                    <span class="text-sm font-bold text-white uppercase" x-text="selectedConsole.name"></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Durasi Sewa</span>
                    <span class="text-sm font-bold text-primary" x-text="selectedConsole.duration + ' Jam'"></span>
                </div>
                <div class="pt-4 border-t border-white/10 flex justify-between items-center">
                    <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Total Bayar</span>
                    <span class="text-xl font-orbitron font-black text-white" x-text="'Rp' + (selectedConsole.duration * selectedConsole.price).toLocaleString('id-ID')"></span>
                </div>
            </div>

            <p class="text-[9px] text-slate-400 leading-relaxed uppercase tracking-wider text-center">
                Dengan mengklik tombol di bawah, pesanan Anda akan segera diproses oleh Admin Command Center.
            </p>

            <div class="flex gap-4 mt-8">
                <button type="button" @click="showModal = false" class="flex-1 py-4 text-[10px] font-black uppercase text-slate-500">Batal</button>
                <button type="submit" class="flex-1 py-4 bg-primary text-dark rounded-xl font-orbitron font-black text-[10px] uppercase shadow-lg shadow-primary/20 hover:scale-105 transition-all">
                    KIRIM PESANAN
                </button>
            </div>
        </form>
    </div>
</div>

    <section id="harga" class="py-40 bg-dark-950 relative overflow-hidden border-t border-white/5">
    <div class="absolute top-0 left-0 w-[400px] h-[400px] bg-primary/5 blur-[120px] rounded-full pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-secondary/5 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="container mx-auto px-6">
        <div class="text-center mb-24" data-aos="fade-up">
            <span class="text-primary font-orbitron font-bold text-[10px] tracking-[0.5em] uppercase mb-4 block">// PRICING ENGINE</span>
            <h2 class="text-4xl md:text-6xl font-orbitron font-black uppercase text-white leading-tight tracking-tighter">DAFTAR <span class="text-primary italic">HARGA</span> LENGKAP.</h2>
            <p class="text-slate-500 mt-6 text-sm md:text-base font-medium">Dari mesin legendaris hingga konsol masa depan.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">

            <div class="product-card rounded-[2.5rem] p-8 flex flex-col border-white/5 opacity-80 hover:opacity-100" data-aos="fade-up">
                <div class="flex justify-between items-center mb-8">
                    <div class="w-12 h-12 bg-slate-800 rounded-xl flex items-center justify-center"><i data-lucide="history" class="text-slate-400 w-6 h-6"></i></div>
                    <span class="text-[8px] font-black text-slate-500 uppercase tracking-widest px-3 py-1 bg-white/5 rounded-full border border-white/5">Legacy</span>
                </div>
                <h3 class="font-orbitron text-xl font-black text-white uppercase mb-6 italic">PlayStation 2</h3>
                <div class="space-y-4 mb-10 flex-1">
                    <div class="flex justify-between items-center text-xs font-bold border-b border-white/5 pb-3"><span class="text-slate-400">Normal</span><span class="text-white font-orbitron">Rp 3.000/H</span></div>
                    <div class="flex justify-between items-center text-xs font-bold border-b border-white/5 pb-3"><span class="text-slate-400">Paket 4 Jam</span><span class="text-primary font-orbitron">Rp 10.000</span></div>
                </div>
                <ul class="space-y-3 mb-10 text-[9px] font-black text-slate-500 uppercase tracking-widest">
                    <li class="flex items-center gap-2"><i data-lucide="check" class="text-primary w-3 h-3"></i> TV Tabung/LED</li>
                    <li class="flex items-center gap-2"><i data-lucide="check" class="text-primary w-3 h-3"></i> 2 Stick Getar</li>
                </ul>
            </div>

            <div class="product-card rounded-[2.5rem] p-8 flex flex-col border-white/5" data-aos="fade-up" data-aos-delay="100">
                <div class="flex justify-between items-center mb-8">
                    <div class="w-12 h-12 bg-slate-800 rounded-xl flex items-center justify-center border border-white/5"><i data-lucide="gamepad" class="text-slate-300 w-6 h-6"></i></div>
                    <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest px-3 py-1 bg-white/5 rounded-full border border-white/5">Classic</span>
                </div>
                <h3 class="font-orbitron text-xl font-black text-white uppercase mb-6 italic">PlayStation 3</h3>
                <div class="space-y-4 mb-10 flex-1">
                    <div class="flex justify-between items-center text-xs font-bold border-b border-white/5 pb-3"><span class="text-slate-400">Normal</span><span class="text-white font-orbitron">Rp 5.000/H</span></div>
                    <div class="flex justify-between items-center text-xs font-bold border-b border-white/5 pb-3"><span class="text-slate-400">Paket 3 Jam</span><span class="text-primary font-orbitron">Rp 12.000</span></div>
                </div>
                <ul class="space-y-3 mb-10 text-[9px] font-black text-slate-500 uppercase tracking-widest">
                    <li class="flex items-center gap-2"><i data-lucide="check" class="text-primary w-3 h-3"></i> HD Display</li>
                    <li class="flex items-center gap-2"><i data-lucide="check" class="text-primary w-3 h-3"></i> Stick Wireless</li>
                </ul>
            </div>

            <div class="product-card rounded-[2.5rem] p-8 flex flex-col border-white/5" data-aos="fade-up" data-aos-delay="200">
                <div class="flex justify-between items-center mb-8">
                    <div class="w-12 h-12 bg-slate-800 rounded-xl flex items-center justify-center border border-white/5"><i data-lucide="zap" class="text-slate-200 w-6 h-6"></i></div>
                    <span class="text-[8px] font-black text-primary uppercase tracking-widest px-3 py-1 bg-primary/10 rounded-full border border-primary/20">Standard Pro</span>
                </div>
                <h3 class="font-orbitron text-xl font-black text-white uppercase mb-6 italic">PlayStation 4</h3>
                <div class="space-y-4 mb-10 flex-1">
                    <div class="flex justify-between items-center text-xs font-bold border-b border-white/5 pb-3"><span class="text-slate-400">Normal</span><span class="text-white font-orbitron">Rp 8.000/H</span></div>
                    <div class="flex justify-between items-center text-xs font-bold border-b border-white/5 pb-3"><span class="text-slate-400">Paket 3 Jam</span><span class="text-primary font-orbitron">Rp 20.000</span></div>
                </div>
                <ul class="space-y-3 mb-10 text-[9px] font-black text-slate-500 uppercase tracking-widest">
                    <li class="flex items-center gap-2"><i data-lucide="check" class="text-primary w-3 h-3"></i> Full HD 1080p</li>
                    <li class="flex items-center gap-2"><i data-lucide="check" class="text-primary w-3 h-3"></i> AA Games Ready</li>
                </ul>
            </div>

            <div class="product-card rounded-[2.5rem] p-8 flex flex-col border-primary/30 bg-dark-900 shadow-[0_0_40px_rgba(0,242,255,0.1)] relative overflow-hidden" data-aos="fade-up" data-aos-delay="300">
                <div class="absolute top-0 right-0 p-4">
                    <span class="px-3 py-1 bg-primary text-dark-950 font-orbitron font-black text-[7px] uppercase rounded-full">Best Seller</span>
                </div>
                <div class="flex justify-between items-center mb-8">
                    <div class="w-12 h-12 bg-primary/20 rounded-xl flex items-center justify-center border border-primary/30 shadow-[0_0_15px_rgba(0,242,255,0.3)]"><i data-lucide="crown" class="text-primary w-6 h-6"></i></div>
                    <span class="text-[8px] font-black text-primary uppercase tracking-widest px-3 py-1 bg-primary/10 rounded-full border border-primary/20">Sultan VIP</span>
                </div>
                <h3 class="font-orbitron text-xl font-black text-white uppercase mb-6 italic text-glow">PlayStation 5</h3>
                <div class="space-y-4 mb-10 flex-1">
                    <div class="flex justify-between items-center text-xs font-bold border-b border-white/5 pb-3"><span class="text-slate-400">Normal</span><span class="text-white font-orbitron">Rp 15.000/H</span></div>
                    <div class="flex justify-between items-center text-xs font-bold border-b border-white/5 pb-3"><span class="text-slate-400">Paket 3 Jam</span><span class="text-primary font-orbitron">Rp 40.000</span></div>
                </div>
                <ul class="space-y-3 mb-10 text-[9px] font-black text-slate-500 uppercase tracking-widest">
                    <li class="flex items-center gap-2"><i data-lucide="check" class="text-primary w-3 h-3"></i> 4K Ultra HD OLED</li>
                    <li class="flex items-center gap-2"><i data-lucide="check" class="text-primary w-3 h-3"></i> DualSense Edge</li>
                </ul>
                <a href="#katalog" class="w-full py-3 bg-primary text-dark-950 rounded-xl font-orbitron font-black text-[9px] tracking-[0.2em] text-center hover:scale-105 transition-all uppercase">Booking Now</a>
            </div>

        </div>
    </div>
</section>

    <section id="fitur" class="py-32 container mx-auto px-6">
        <div class="text-center md:text-left mb-20" data-aos="fade-up">
            <span class="text-primary font-orbitron font-bold text-[10px] tracking-[0.6em] uppercase mb-4 block underline underline-offset-8">Facility Protocol</span>
            <h2 class="text-4xl md:text-5xl font-orbitron font-black uppercase text-white leading-tight tracking-tighter">STANDAR <span class="text-primary">VIP HUB.</span></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-6 gap-6 items-start">
            <div class="md:col-span-4 bento-tight group" data-aos="fade-right">
                <div class="relative w-full aspect-video md:aspect-[16/7.5] overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1592839494881-28d84459635b?q=80&w=1200" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000" alt="Setup Sultan">
                    <div class="absolute inset-0 bento-overlay"></div>
                    <div class="absolute bottom-0 p-6 md:p-10">
                        <h4 class="font-orbitron text-2xl font-black text-white uppercase mb-2">Setup Kelas Sultan</h4>
                        <p class="text-slate-400 text-xs font-bold uppercase tracking-widest max-w-sm">Monitor 144Hz & Kursi Gaming Ergonomis paling premium.</p>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2 bento-tight group flex flex-col bg-secondary/20" data-aos="fade-left">
                <div class="relative w-full aspect-square md:aspect-auto md:h-full overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=800" class="w-full h-full object-cover opacity-40 grayscale group-hover:grayscale-0 transition-all duration-700">
                    <div class="absolute inset-0 bento-overlay"></div>
                    <div class="absolute bottom-0 p-8">
                        <div class="w-12 h-12 bg-secondary rounded-2xl flex items-center justify-center mb-6"><i data-lucide="zap" class="text-white w-6 h-6"></i></div>
                        <h5 class="font-orbitron text-lg font-black text-white uppercase">Instan Akses</h5>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2 bento-tight group" data-aos="fade-up">
                <div class="relative aspect-square overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1627850604058-52e40de1b847?q=80&w=800" class="w-full h-full object-cover opacity-30">
                    <div class="absolute inset-0 bento-overlay"></div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-6">
                        <div class="w-14 h-14 bg-green-500/10 rounded-full flex items-center justify-center mb-6 border border-green-500/20"><i data-lucide="shield-check" class="text-green-500 w-8 h-8"></i></div>
                        <h5 class="font-orbitron text-xl font-black text-white uppercase mb-2 leading-none">Higienis <br> Total</h5>
                    </div>
                </div>
            </div>

            <div class="md:col-span-4 bento-tight group" data-aos="fade-up">
                <div class="relative aspect-video md:aspect-[21/9.5] overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1493711662062-fa541adb3fc8?q=80&w=1200" class="w-full h-full object-cover opacity-20">
                    <div class="absolute inset-0 bento-overlay"></div>
                    <div class="absolute inset-0 flex flex-col md:flex-row items-center justify-between px-10 gap-8">
                        <div>
                            <h5 class="font-orbitron text-3xl font-black text-white uppercase mb-2 italic">Library AAA</h5>
                            <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.4em]">FC25 / GTA VI READY / SPIDERMAN 2</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="testi" class="py-40 bg-dark-900/10">
        <div class="container mx-auto px-6 text-center">
            <h2 class="font-orbitron text-3xl md:text-4xl font-black uppercase mb-24 tracking-tighter">HALL OF <span class="text-primary italic">FAME.</span></h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @for($i=1; $i<=3; $i++)
                <div class="product-card p-10 rounded-[3rem] text-left border-white/5 hover:bg-white/[0.02] transition-all group" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    <div class="flex items-center gap-6 mb-8">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $i }}" class="w-16 h-16 rounded-2xl bg-dark-800 ring-2 ring-primary/20 p-1">
                        <div>
                            <p class="font-black text-white uppercase tracking-widest text-sm italic">Player_{{ $i }}</p>
                            <div class="flex gap-1 text-primary mt-1">@for($j=0; $j<5; $j++) <i data-lucide="star" class="w-3 h-3 fill-current"></i> @endfor</div>
                        </div>
                    </div>
                    <p class="text-slate-400 italic font-medium leading-relaxed">"Sewa di Alia Rental setup-nya beneran premium, internet kenceng buat main online, beneran sultan!"</p>
                </div>
                @endfor
            </div>
        </div>
    </section>

    <footer class="bg-dark-950 pt-40 pb-16 border-t border-white/5 relative overflow-hidden text-center md:text-left">
        <div class="absolute -bottom-20 -right-20 text-[200px] font-orbitron font-black text-white/[0.02] select-none uppercase leading-none italic pointer-events-none">ALIA</div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-20 mb-32">
                <div class="md:col-span-2">
                    <div class="flex items-center justify-center md:justify-start gap-4 mb-10">
                        <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center"><i data-lucide="gamepad-2" class="text-dark-950 w-6 h-6"></i></div>
                        <span class="font-orbitron font-black text-2xl tracking-tighter uppercase text-white">ALIA<span class="text-primary italic">RENTAL</span></span>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed max-w-sm mx-auto md:mx-0 font-medium italic">Rental PS Profesional nomor #1 di Palembang. Menghadirkan kualitas visual 4K dan kenyamanan premium untuk setiap gamers.</p>
                </div>
                <div>
                    <h6 class="font-orbitron text-[10px] font-black uppercase tracking-[0.5em] text-primary mb-10 italic underline underline-offset-8">Navigasi</h6>
                    <ul class="space-y-5 font-sans font-black text-[10px] text-slate-500 uppercase tracking-widest">
                        <li><a href="#" class="hover:text-primary transition-all">Sistem Katalog</a></li>
                        <li><a href="#" class="hover:text-primary transition-all">Membership Rank</a></li>
                        <li><a href="#" class="hover:text-primary transition-all">Support Center</a></li>
                        <li><a href="#harga" class="hover:text-primary transition-all">Daftar Harga Terbaru</a></li>
                    </ul>
                </div>
                <div>
                    <h6 class="font-orbitron text-[10px] font-black uppercase tracking-[0.5em] text-slate-500 mb-10 italic underline underline-offset-8">Developer</h6>
                </div>
            </div>
            <div class="pt-16 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-10">
                <p class="font-black text-[10px] text-slate-600 uppercase tracking-[0.6em] text-center">&copy; 2026 ALIA RENTAL PS PRO - ALL SYSTEMS OPERATIONAL</p>
            </div>
        </div>
    </footer>

    <div x-show="showModal" x-cloak class="fixed inset-0 z-[150] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-dark-950/95 backdrop-blur-xl" @click="showModal = false"></div>
        <div class="relative bg-dark-900 border border-primary/30 w-full max-w-lg rounded-[2.5rem] overflow-hidden shadow-[0_0_50px_rgba(0,242,255,0.3)]"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90 translate-y-10"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0">
            <div class="p-8 md:p-12">
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <span class="text-[10px] font-black text-primary uppercase tracking-[0.4em] mb-2 block">// KONFIRMASI SESI</span>
                        <h2 class="font-orbitron text-3xl font-black text-white uppercase italic" x-text="selectedConsole.name"></h2>
                    </div>
                    <button @click="showModal = false" class="p-2 hover:bg-white/5 rounded-full transition-colors"><i data-lucide="x" class="text-slate-500"></i></button>
                </div>
                <div class="bg-dark-950 rounded-3xl p-8 mb-10 border border-white/5 space-y-4 text-left">
    <div class="flex justify-between"><span class="text-slate-500 text-xs font-bold uppercase tracking-widest">Durasi Sewa:</span><span class="text-white font-orbitron font-bold" x-text="selectedConsole.duration + ' Jam'"></span></div>
    <div class="flex justify-between"><span class="text-slate-500 text-xs font-bold uppercase tracking-widest">Tipe Unit:</span><span class="text-white font-orbitron font-bold" x-text="selectedConsole.cat"></span></div>
    <div class="border-t border-white/5 mt-4 pt-6 flex justify-between">
        <span class="text-primary text-sm font-black uppercase tracking-widest">Total Bayar:</span>
        <span class="text-primary text-2xl font-orbitron font-black text-glow" x-text="'Rp' + (selectedConsole.price * selectedConsole.duration).toLocaleString('id-ID')"></span>
    </div>
</div>

<form action="{{ route('booking.store') }}" method="POST">
    @csrf
    <input type="hidden" name="console_id" :value="selectedConsole.id">
    <input type="hidden" name="duration" :value="selectedConsole.duration">

    <button type="submit" class="w-full py-5 bg-primary text-dark-950 font-orbitron font-black tracking-[0.3em] rounded-2xl hover:scale-[1.02] active:scale-95 transition-all shadow-lg shadow-primary/20 uppercase italic">
        Verifikasi Booking Sultan
    </button>
</form>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true, offset: 50 });
        lucide.createIcons();
    </script>
</body>
</html>
