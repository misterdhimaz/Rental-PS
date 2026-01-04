<!DOCTYPE html>
<html lang="id" x-data="{ loading: true, showPass: false, showConfirm: false }" x-init="setTimeout(() => loading = false, 1200)">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Protocol | Alia Rental PS</title>

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
                    animation: {
                        'pulse-slow': 'pulse 6s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        body { background-color: #020617; color: #f1f5f9; font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }

        .glass-container {
            background: radial-gradient(circle at top left, rgba(0, 242, 255, 0.05), transparent),
                        linear-gradient(to bottom right, rgba(15, 23, 42, 0.8), rgba(2, 6, 23, 0.9));
            backdrop-filter: blur(40px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .input-gradient-border {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .input-gradient-border:focus-within {
            border-color: #00f2ff;
            box-shadow: 0 0 20px rgba(0, 242, 255, 0.15);
            transform: translateY(-2px);
        }

        .btn-sultan {
            background: linear-gradient(90deg, #00f2ff, #7000ff);
            background-size: 200% auto;
            transition: 0.5s;
        }

        .btn-sultan:hover {
            background-position: right center;
            box-shadow: 0 0 30px rgba(0, 242, 255, 0.4);
            transform: scale(1.02);
        }

        .bg-animate {
            background: radial-gradient(circle at 50% 50%, #7000ff15 0%, transparent 50%);
            animation: move 10s infinite alternate;
        }

        @keyframes move {
            from { transform: translate(-10%, -10%); }
            to { transform: translate(10%, 10%); }
        }
    </style>
</head>
<body class="antialiased flex items-center justify-center min-h-screen relative px-4 py-12">

    <div x-show="loading" class="fixed inset-0 z-[200] bg-dark flex flex-col items-center justify-center">
        <div class="relative w-20 h-20">
            <div class="absolute inset-0 border-4 border-primary/10 rounded-full"></div>
            <div class="absolute inset-0 border-4 border-primary rounded-full border-t-transparent animate-spin"></div>
        </div>
        <p class="mt-8 font-orbitron text-[10px] tracking-[0.6em] text-primary uppercase animate-pulse">Creating Sultan Identity</p>
    </div>

    <div class="fixed inset-0 -z-10 overflow-hidden bg-dark">
        <div class="absolute top-[-20%] left-[-10%] w-[600px] h-[600px] bg-primary/10 blur-[150px] rounded-full animate-pulse-slow"></div>
        <div class="absolute bottom-[-20%] right-[-10%] w-[600px] h-[600px] bg-secondary/10 blur-[150px] rounded-full animate-pulse-slow"></div>
        <div class="absolute inset-0 bg-animate"></div>
    </div>

    <div class="w-full max-w-[500px]" x-cloak x-show="!loading" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-95 translate-y-8">

        <div class="text-center mb-8">
            <div class="relative inline-block group">
                <div class="absolute -inset-1 bg-gradient-to-r from-primary to-secondary rounded-2xl blur opacity-25 group-hover:opacity-60 transition duration-1000"></div>
                <div class="relative flex items-center justify-center w-16 h-16 bg-card rounded-2xl border border-white/10 shadow-2xl mb-4">
                    <i data-lucide="user-plus" class="text-primary w-8 h-8"></i>
                </div>
            </div>
            <h1 class="font-orbitron text-2xl font-black text-white uppercase italic tracking-tighter">
                NEW <span class="text-primary">MEMBER</span>
            </h1>
            <p class="text-slate-500 text-[9px] font-bold uppercase tracking-[0.4em] mt-2 text-glow">Join The Elite Gaming Hub</p>
        </div>

        <div class="glass-container rounded-[2.5rem] p-8 md:p-10">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div class="space-y-2 group">
                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Full Identity</label>
                    <div class="input-gradient-border rounded-2xl flex items-center px-4">
                        <i data-lucide="user" class="w-5 h-5 text-slate-500 group-focus-within:text-primary"></i>
                        <input type="text" name="name" :value="old('name')" required autofocus
                            class="w-full bg-transparent border-none py-4 px-4 text-sm text-white placeholder-slate-600 focus:ring-0 font-medium"
                            placeholder="Nama Lengkap Sultan">
                    </div>
                    @error('name') <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2 group">
                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Universal Mail</label>
                    <div class="input-gradient-border rounded-2xl flex items-center px-4">
                        <i data-lucide="mail" class="w-5 h-5 text-slate-500 group-focus-within:text-primary"></i>
                        <input type="email" name="email" :value="old('email')" required
                            class="w-full bg-transparent border-none py-4 px-4 text-sm text-white placeholder-slate-600 focus:ring-0 font-medium"
                            placeholder="sultan@email.com">
                    </div>
                    @error('email') <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2 group">
                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Secure Passcode</label>
                    <div class="input-gradient-border rounded-2xl flex items-center px-4">
                        <i data-lucide="lock" class="w-5 h-5 text-slate-500 group-focus-within:text-primary"></i>
                        <input :type="showPass ? 'text' : 'password'" name="password" required
                            class="w-full bg-transparent border-none py-4 px-4 text-sm text-white placeholder-slate-600 focus:ring-0 font-medium"
                            placeholder="Min. 8 Karakter">
                        <button type="button" @click="showPass = !showPass" class="text-slate-500 hover:text-primary">
                            <i :data-lucide="showPass ? 'eye-off' : 'eye'" class="w-4 h-4"></i>
                        </button>
                    </div>
                    @error('password') <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2 group">
                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Verify Passcode</label>
                    <div class="input-gradient-border rounded-2xl flex items-center px-4 border-dashed">
                        <i data-lucide="shield-check" class="w-5 h-5 text-slate-500 group-focus-within:text-primary"></i>
                        <input :type="showConfirm ? 'text' : 'password'" name="password_confirmation" required
                            class="w-full bg-transparent border-none py-4 px-4 text-sm text-white placeholder-slate-600 focus:ring-0 font-medium"
                            placeholder="Ulangi Password">
                        <button type="button" @click="showConfirm = !showConfirm" class="text-slate-500 hover:text-primary">
                            <i :data-lucide="showConfirm ? 'eye-off' : 'eye'" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="btn-sultan w-full text-dark py-5 rounded-2xl font-orbitron font-black text-xs uppercase tracking-[0.3em] shadow-xl mt-4">
                    Create Identity
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-white/5 text-center">
                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                    Already a Sultan?
                    <a href="{{ route('login') }}" class="text-primary hover:text-white transition-colors ml-2">Access Portal</a>
                </p>
            </div>
        </div>

        <div class="mt-8 flex justify-center items-center gap-4 opacity-20">
            <p class="text-[7px] font-black text-slate-500 uppercase tracking-[0.5em]">System Core v2.0 - Alia Registration Protocol</p>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
