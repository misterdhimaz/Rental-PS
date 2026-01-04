<!DOCTYPE html>
<html lang="id" x-data="{ loading: true, showPass: false, showConfirm: false }" x-init="setTimeout(() => loading = false, 1000)">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Access | Alia Rental PS</title>

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
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        body { background-color: #020617; color: #f1f5f9; font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }

        .glass-container {
            background: linear-gradient(to bottom right, rgba(15, 23, 42, 0.8), rgba(2, 6, 23, 0.9));
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
    </style>
</head>
<body class="antialiased flex items-center justify-center min-h-screen relative px-4 py-12">

    <div class="fixed inset-0 -z-10 bg-dark">
        <div class="absolute top-[-10%] right-[-10%] w-[500px] h-[500px] bg-primary/5 blur-[120px] rounded-full animate-pulse"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[500px] h-[500px] bg-secondary/5 blur-[120px] rounded-full animate-pulse"></div>
    </div>

    <div class="w-full max-w-[480px]" x-cloak x-show="!loading" x-transition:enter="transition ease-out duration-700">

        <div class="text-center mb-8">
            <div class="relative inline-flex items-center justify-center w-16 h-16 bg-card rounded-2xl border border-white/10 shadow-2xl mb-4">
                <i data-lucide="refresh-cw" class="text-primary w-8 h-8"></i>
            </div>
            <h1 class="font-orbitron text-2xl font-black text-white uppercase italic tracking-tighter">RESET <span class="text-primary">ACCESS</span></h1>
            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-[0.3em] mt-2">Enkripsi Ulang Kunci Keamanan</p>
        </div>

        <div class="glass-container rounded-[2.5rem] p-8 md:p-10">
            <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="space-y-2 group">
                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">E-Mail Terverifikasi</label>
                    <div class="input-gradient-border rounded-2xl flex items-center px-4 opacity-60">
                        <i data-lucide="mail" class="w-5 h-5 text-slate-500"></i>
                        <input type="email" name="email" value="{{ old('email', $request->email) }}" required readonly
                            class="w-full bg-transparent border-none py-4 px-4 text-sm text-slate-400 focus:ring-0 font-medium cursor-not-allowed">
                    </div>
                    @error('email') <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2 group">
                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Kunci Baru</label>
                    <div class="input-gradient-border rounded-2xl flex items-center px-4">
                        <i data-lucide="lock" class="w-5 h-5 text-slate-500 group-focus-within:text-primary"></i>
                        <input :type="showPass ? 'text' : 'password'" name="password" required autofocus autocomplete="new-password"
                            class="w-full bg-transparent border-none py-4 px-4 text-sm text-white placeholder-slate-600 focus:ring-0 font-medium"
                            placeholder="Min. 8 karakter baru">
                        <button type="button" @click="showPass = !showPass" class="text-slate-500 hover:text-primary transition-colors">
                            <i :data-lucide="showPass ? 'eye-off' : 'eye'" class="w-4 h-4"></i>
                        </button>
                    </div>
                    @error('password') <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2 group">
                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Verifikasi Kunci</label>
                    <div class="input-gradient-border rounded-2xl flex items-center px-4">
                        <i data-lucide="shield-check" class="w-5 h-5 text-slate-500 group-focus-within:text-primary"></i>
                        <input :type="showConfirm ? 'text' : 'password'" name="password_confirmation" required autocomplete="new-password"
                            class="w-full bg-transparent border-none py-4 px-4 text-sm text-white placeholder-slate-600 focus:ring-0 font-medium"
                            placeholder="Ulangi kunci baru">
                        <button type="button" @click="showConfirm = !showConfirm" class="text-slate-500 hover:text-primary transition-colors">
                            <i :data-lucide="showConfirm ? 'eye-off' : 'eye'" class="w-4 h-4"></i>
                        </button>
                    </div>
                    @error('password_confirmation') <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <button type="submit"
                    class="btn-sultan w-full text-dark py-5 rounded-2xl font-orbitron font-black text-xs uppercase tracking-[0.3em] shadow-xl mt-4">
                    Update Passcode
                </button>
            </form>
        </div>

        <p class="text-center mt-8 text-[9px] font-black text-slate-600 uppercase tracking-[0.5em]">Secure Protocol v2.0 - Alia Rental System</p>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
