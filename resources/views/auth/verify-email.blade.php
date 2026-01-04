<!DOCTYPE html>
<html lang="id" x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 1000)">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Protocol | Alia Rental PS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
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
        body { background-color: #020617; color: #f1f5f9; font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }
        .glass-container { background: linear-gradient(to bottom right, rgba(15, 23, 42, 0.8), rgba(2, 6, 23, 0.9)); backdrop-filter: blur(40px); border: 1px solid rgba(255, 255, 255, 0.08); }
        .btn-sultan { background: linear-gradient(90deg, #00f2ff, #7000ff); background-size: 200% auto; transition: 0.5s; }
        .btn-sultan:hover { background-position: right center; box-shadow: 0 0 30px rgba(0, 242, 255, 0.4); }
    </style>
</head>
<body class="antialiased flex items-center justify-center min-h-screen px-4">

    <div class="fixed inset-0 -z-10 bg-dark">
        <div class="absolute bottom-[-20%] right-[-10%] w-[600px] h-[600px] bg-secondary/10 blur-[150px] rounded-full"></div>
    </div>

    <div class="w-full max-w-[480px]" x-cloak x-show="!loading">
        <div class="text-center mb-8">
            <div class="relative inline-flex items-center justify-center w-16 h-16 bg-card rounded-2xl border border-white/10 shadow-2xl mb-4">
                <i data-lucide="mail-check" class="text-primary w-8 h-8"></i>
            </div>
            <h1 class="font-orbitron text-2xl font-black text-white uppercase italic tracking-tighter">VERIFY <span class="text-primary">PROTOCOL</span></h1>
            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-[0.3em] mt-2">Langkah Terakhir Menjadi Sultan</p>
        </div>

        <div class="glass-container rounded-[2.5rem] p-8 md:p-10">
            <div class="mb-8 text-sm text-slate-400 leading-relaxed text-center font-medium italic">
                Sistem kami telah mengirimkan sinyal verifikasi ke email Anda. Silakan klik tautan di dalam email tersebut untuk mengaktifkan akses Sultan penuh Anda.
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-8 p-4 bg-primary/10 border border-primary/20 rounded-xl text-primary text-[11px] font-black uppercase text-center tracking-widest italic">
                    Sinyal Baru Terkirim! Cek folder Inbox/Spam Anda.
                </div>
            @endif

            <div class="flex flex-col gap-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn-sultan w-full text-dark py-5 rounded-2xl font-orbitron font-black text-xs uppercase tracking-[0.2em] shadow-xl">
                        Kirim Ulang Sinyal Verifikasi
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-slate-500 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest hover:text-red-500 transition-colors">
                        Batalkan Akses & Keluar
                    </button>
                </form>
            </div>
        </div>

        <p class="text-center mt-8 text-[9px] font-black text-slate-600 uppercase tracking-[0.5em]">Alia System Identity Protection</p>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>
