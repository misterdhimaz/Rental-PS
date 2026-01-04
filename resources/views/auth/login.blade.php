<!DOCTYPE html>
<html lang="id" x-data="{ loading: true, showPass: false }" x-init="setTimeout(() => loading = false, 1200)">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Sultan | Alia Rental PS</title>

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

        /* Scan line stay inside container */
        .scan-line {
            width: 100%;
            height: 2px;
            background: linear-gradient(to right, transparent, #00f2ff, transparent);
            position: absolute;
            animation: scan 4s linear infinite;
            opacity: 0.15;
            z-index: 10;
        }

        @keyframes scan {
            0% { top: 0; }
            100% { top: 100%; }
        }
    </style>
</head>
<body class="antialiased flex items-center justify-center min-h-screen relative px-4 py-10">

    <div x-show="loading" class="fixed inset-0 z-[200] bg-dark flex flex-col items-center justify-center p-6">
        <div class="relative w-16 h-16 sm:w-20 sm:h-20 flex items-center justify-center">
            <div class="absolute inset-0 border-4 border-primary/10 rounded-full"></div>
            <div class="absolute inset-0 border-4 border-primary rounded-full border-t-transparent animate-spin"></div>
            <i data-lucide="shield-check" class="text-primary w-6 h-6 sm:w-8 sm:h-8 animate-pulse"></i>
        </div>
        <p class="mt-6 sm:mt-8 font-orbitron text-[8px] sm:text-[10px] tracking-[0.4em] sm:tracking-[0.6em] text-primary uppercase animate-pulse text-center">
            Menghubungkan Sinyal Sultan
        </p>
    </div>

    <div class="fixed inset-0 -z-10 overflow-hidden bg-dark">
        <div class="absolute top-[-10%] left-[-10%] w-[300px] h-[300px] sm:w-[500px] sm:h-[500px] bg-primary/10 blur-[100px] sm:blur-[150px] rounded-full animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[300px] h-[300px] sm:w-[500px] sm:h-[500px] bg-secondary/10 blur-[100px] sm:blur-[150px] rounded-full animate-pulse"></div>
        <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
    </div>

    <div class="w-full max-w-[450px] mx-auto" x-cloak x-show="!loading" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-95 translate-y-4">

        <div class="text-center mb-6 sm:mb-8">
            <div class="relative inline-block group">
                <div class="absolute -inset-1 bg-gradient-to-r from-primary to-secondary rounded-2xl blur opacity-30 group-hover:opacity-100 transition duration-1000"></div>
                <div class="relative flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-card rounded-2xl border border-white/10 shadow-2xl mb-4 sm:mb-6">
                    <i data-lucide="gamepad-2" class="text-primary w-8 h-8 sm:w-10 sm:h-10"></i>
                </div>
            </div>
            <h1 class="font-orbitron text-2xl sm:text-3xl font-black text-white uppercase italic tracking-tighter leading-none">
                ALIA<span class="text-primary">CORE</span>
            </h1>
            <p class="text-slate-500 text-[8px] sm:text-[10px] font-bold uppercase tracking-[0.4em] sm:tracking-[0.5em] mt-3 sm:mt-4">
                Akses Terbatas Khusus Sultan
            </p>
        </div>

        <div class="glass-container rounded-[2rem] sm:rounded-[2.5rem] p-6 sm:p-10 md:p-12 relative overflow-hidden shadow-2xl">
            <div class="scan-line"></div>

            @if ($errors->any())
                <div class="mb-6 p-3 sm:p-4 bg-red-500/10 border border-red-500/30 rounded-xl flex items-start gap-3">
                    <i data-lucide="alert-octagon" class="text-red-500 w-4 h-4 sm:w-5 sm:h-5 shrink-0"></i>
                    <p class="text-red-400 text-[10px] sm:text-[11px] font-bold uppercase tracking-widest leading-tight">Verifikasi Gagal: Cek kembali data Anda.</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4 sm:space-y-6">
                @csrf

                <div class="space-y-2 group">
                    <label class="text-[8px] sm:text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Identitas Terminal</label>
                    <div class="input-glow-group bg-slate-900/50 border border-white/10 rounded-xl sm:rounded-2xl flex items-center px-3 sm:px-4 transition-all duration-300">
                        <i data-lucide="user" class="w-4 h-4 sm:w-5 sm:h-5 text-slate-500 group-focus-within:text-primary"></i>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full bg-transparent border-none py-3 sm:py-4 px-3 sm:px-4 text-xs sm:text-sm text-white placeholder-slate-600 focus:ring-0 font-medium"
                            placeholder="email@sultan.com">
                    </div>
                </div>

                <div class="space-y-2 group">
                    <div class="flex justify-between items-center px-1">
                        <label class="text-[8px] sm:text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">Kunci Keamanan</label>
                        <a href="{{ route('password.request') }}" class="text-[8px] sm:text-[9px] font-bold text-primary hover:text-white transition-colors tracking-widest">LUPA?</a>
                    </div>
                    <div class="input-glow-group bg-slate-900/50 border border-white/10 rounded-xl sm:rounded-2xl flex items-center px-3 sm:px-4 transition-all duration-300">
                        <i data-lucide="lock" class="w-4 h-4 sm:w-5 sm:h-5 text-slate-500 group-focus-within:text-primary"></i>
                        <input :type="showPass ? 'text' : 'password'" name="password" required
                            class="w-full bg-transparent border-none py-3 sm:py-4 px-3 sm:px-4 text-xs sm:text-sm text-white placeholder-slate-600 focus:ring-0 font-medium"
                            placeholder="••••••••">
                        <button type="button" @click="showPass = !showPass" class="text-slate-500 hover:text-primary p-1">
                            <i :data-lucide="showPass ? 'eye-off' : 'eye'" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center gap-3 px-1 py-1">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="remember" class="sr-only peer">
                        <div class="w-8 sm:w-9 h-4 sm:h-5 bg-slate-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-3 sm:after:h-4 after:w-3 sm:after:w-4 after:transition-all peer-checked:bg-primary"></div>
                        <span class="ml-3 text-[9px] sm:text-[10px] font-bold text-slate-500 uppercase tracking-widest">Ingat Sesi Saya</span>
                    </label>
                </div>

                <button type="submit"
                    class="btn-sultan w-full text-dark py-4 sm:py-5 rounded-xl sm:rounded-2xl font-orbitron font-black text-[10px] sm:text-xs uppercase tracking-[0.2em] sm:tracking-[0.3em] shadow-xl mt-2">
                    Inisialisasi Akses
                </button>
            </form>

            <div class="mt-8 sm:mt-10 pt-6 sm:pt-8 border-t border-white/5 text-center">
                <p class="text-[9px] sm:text-[10px] font-bold text-slate-600 uppercase tracking-widest leading-relaxed">
                    Belum Menjadi Sultan? <br>
                    <a href="{{ route('register') }}" class="text-primary hover:text-white transition-colors mt-2 inline-block underline underline-offset-4">Minta Kartu Akses Sultan</a>
                </p>
            </div>
        </div>

        <div class="mt-6 sm:mt-8 text-center opacity-30 flex items-center justify-center gap-3 sm:gap-4">
            <div class="h-px w-6 sm:w-10 bg-slate-600"></div>
            <p class="text-[7px] sm:text-[8px] font-black text-slate-500 uppercase tracking-[0.3em] sm:tracking-[0.4em]">Alia Protocol Sec-v.2.1</p>
            <div class="h-px w-6 sm:w-10 bg-slate-600"></div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
