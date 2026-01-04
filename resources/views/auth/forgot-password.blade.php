<!DOCTYPE html>
<html lang="id" x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 1000)">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemulihan Akses | Alia Rental PS</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#00f2ff',
                        'secondary': '#7000ff',
                        'dark': '#020617',
                        'card': '#0f172a'
                    },
                    fontFamily: {
                        orbitron: ['Orbitron', 'sans-serif'],
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        body { background-color: #020617; color: #f1f5f9; font-family: 'Plus Jakarta Sans', sans-serif; }

        .glass-container {
            background: linear-gradient(to bottom right, rgba(15, 23, 42, 0.7), rgba(2, 6, 23, 0.8));
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .input-glow-group:focus-within {
            border-color: #00f2ff;
            box-shadow: 0 0 20px rgba(0, 242, 255, 0.1);
        }

        .btn-sultan {
            background: linear-gradient(90deg, #00f2ff, #7000ff);
            background-size: 200% auto;
            transition: 0.4s ease;
        }

        .btn-sultan:hover {
            background-position: right center;
            box-shadow: 0 0 25px rgba(0, 242, 255, 0.3);
        }
    </style>
</head>
<body class="antialiased flex items-center justify-center min-h-screen relative px-4 py-10">

    <div x-show="loading" class="fixed inset-0 z-[200] bg-dark flex flex-col items-center justify-center p-6 text-center">
        <div class="relative w-16 h-16 flex items-center justify-center">
            <div class="absolute inset-0 border-4 border-primary/10 rounded-full"></div>
            <div class="absolute inset-0 border-4 border-primary rounded-full border-t-transparent animate-spin"></div>
            <i data-lucide="refresh-cw" class="text-primary w-6 h-6 animate-spin-slow"></i>
        </div>
        <p class="mt-6 font-orbitron text-[10px] tracking-[0.4em] text-primary uppercase animate-pulse">Menyiapkan Protokol Pemulihan</p>
    </div>

    <div class="fixed inset-0 -z-10 overflow-hidden bg-dark">
        <div class="absolute top-[-10%] right-[-10%] w-[300px] h-[300px] sm:w-[500px] sm:h-[500px] bg-primary/10 blur-[100px] rounded-full animate-pulse"></div>
        <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
    </div>

    <div class="w-full max-w-[450px] mx-auto" x-cloak x-show="!loading" x-transition:enter="transition ease-out duration-700">

        <div class="text-center mb-8">
            <div class="relative inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-card rounded-2xl border border-white/10 shadow-2xl mb-6">
                <i data-lucide="key-round" class="text-primary w-8 h-8 sm:w-10 sm:h-10"></i>
            </div>
            <h1 class="font-orbitron text-2xl sm:text-3xl font-black text-white uppercase italic tracking-tighter leading-none">
                RECOVERY<span class="text-primary">MODE</span>
            </h1>
            <p class="text-slate-500 text-[8px] sm:text-[10px] font-bold uppercase tracking-[0.4em] mt-4 px-4">
                Sistem Pemulihan Kunci Keamanan Sultan
            </p>
        </div>

        <div class="glass-container rounded-[2rem] sm:rounded-[2.5rem] p-6 sm:p-10 md:p-12 shadow-2xl">
            <div class="mb-8 text-xs sm:text-sm text-slate-400 leading-relaxed text-center font-medium italic">
                Lupa kata sandi? Masukkan email terminal Anda, dan kami akan mengirimkan sinyal reset untuk enkripsi ulang akun Anda.
            </div>

            @if (session('status'))
                <div class="mb-8 p-4 bg-primary/10 border border-primary/30 rounded-xl text-primary text-[10px] sm:text-[11px] font-black uppercase text-center tracking-widest italic">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <div class="space-y-2 group">
                    <label class="text-[8px] sm:text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 block text-left">Email Terverifikasi</label>
                    <div class="input-glow-group bg-slate-900/50 border border-white/10 rounded-xl sm:rounded-2xl flex items-center px-4 transition-all duration-300">
                        <i data-lucide="mail" class="w-4 h-4 sm:w-5 sm:h-5 text-slate-500 group-focus-within:text-primary"></i>
                        <input type="email" name="email" :value="old('email')" required autofocus
                            class="w-full bg-transparent border-none py-3 sm:py-4 px-4 text-xs sm:text-sm text-white placeholder-slate-600 focus:ring-0 font-medium"
                            placeholder="nama@email.com">
                    </div>
                    @error('email') <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <button type="submit"
                    class="btn-sultan w-full text-dark py-4 sm:py-5 rounded-xl sm:rounded-2xl font-orbitron font-black text-[10px] sm:text-xs uppercase tracking-[0.3em] shadow-xl">
                    Kirim Tautan Reset
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-white/5 text-center">
                <a href="{{ route('login') }}" class="text-[9px] sm:text-[10px] font-black text-slate-500 uppercase tracking-widest hover:text-primary transition-colors flex items-center justify-center gap-2 group">
                    <i data-lucide="arrow-left" class="w-3 h-3 group-hover:-translate-x-1 transition-transform"></i> Kembali ke Portal Login
                </a>
            </div>
        </div>

        <div class="mt-8 text-center opacity-30 flex items-center justify-center gap-4">
            <p class="text-[7px] sm:text-[8px] font-black text-slate-500 uppercase tracking-[0.5em]">Alia Protection System v2.1</p>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
