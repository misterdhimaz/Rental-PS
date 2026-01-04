<x-app-layout>
    <div class="py-12 bg-slate-950 min-h-screen font-sans text-slate-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-12 flex flex-col md:flex-row md:items-center justify-between gap-6" data-aos="fade-down">
                <div>
                    <h2 class="font-orbitron text-3xl font-black text-white uppercase tracking-tighter italic">
                        SULTAN <span class="text-cyan-400">DASHBOARD</span>
                    </h2>
                    <p class="text-slate-500 text-sm mt-2 uppercase tracking-[0.2em]">Selamat datang kembali, {{ Auth::user()->name }}!</p>
                </div>
                <a href="/" class="px-6 py-3 bg-white/5 border border-white/10 rounded-xl font-black text-[10px] tracking-widest uppercase hover:bg-cyan-400 hover:text-slate-950 transition-all text-center">
                    KEMBALI KE RENTAL
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-slate-900 border border-white/5 p-8 rounded-[2rem] relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-cyan-400/5 rounded-full blur-3xl"></div>
                    <p class="text-slate-500 text-[10px] font-black uppercase tracking-widest mb-2">Total Pesanan</p>
                    <p class="text-4xl font-orbitron font-black text-white">{{ $bookings->count() }}</p>
                </div>
                <div class="bg-slate-900 border border-white/5 p-8 rounded-[2rem]">
                    <p class="text-slate-500 text-[10px] font-black uppercase tracking-widest mb-2">Status Member</p>
                    <p class="text-2xl font-orbitron font-black text-purple-500 italic uppercase">Elite Member</p>
                </div>
                <div class="bg-slate-900 border border-white/5 p-8 rounded-[2rem]">
                    <p class="text-slate-500 text-[10px] font-black uppercase tracking-widest mb-2">Point Loyalitas</p>
                    <p class="text-4xl font-orbitron font-black text-cyan-400">1.250</p>
                </div>
            </div>

            <div class="bg-slate-900/50 border border-white/5 rounded-[2.5rem] overflow-hidden backdrop-blur-xl">
                <div class="p-8 border-b border-white/5 flex items-center gap-4">
                    <div class="w-10 h-10 bg-cyan-400/20 rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-cyan-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
                    </div>
                    <h3 class="font-orbitron font-bold text-white uppercase tracking-widest">Riwayat Booking Anda</h3>
                </div>

                <div class="p-0 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white/[0.02] text-slate-500 text-[10px] font-black uppercase tracking-[0.2em]">
                                <th class="px-8 py-6">Unit Console</th>
                                <th class="px-8 py-6">Durasi</th>
                                <th class="px-8 py-6">Total Bayar</th>
                                <th class="px-8 py-6">Tanggal</th>
                                <th class="px-8 py-6 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($bookings as $booking)
                            <tr class="hover:bg-white/[0.01] transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-slate-800 rounded-2xl flex items-center justify-center border border-white/5 group-hover:border-cyan-400/50 transition-all">
                                            <span class="font-orbitron font-black text-xs text-cyan-400">{{ $booking->console->category->name }}</span>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-white uppercase tracking-tighter">{{ $booking->console->name }}</p>
                                            <p class="text-[10px] text-slate-500 uppercase tracking-widest">Premium Hardware</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-sm font-orbitron text-slate-300">{{ $booking->duration }} JAM</span>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-sm font-orbitron font-bold text-cyan-400">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-xs text-slate-500 uppercase">{{ $booking->created_at->format('d M Y, H:i') }}</span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    @if($booking->status == 'pending')
                                        <span class="px-4 py-1.5 bg-yellow-500/10 border border-yellow-500/20 text-yellow-500 text-[9px] font-black uppercase rounded-lg animate-pulse">Menunggu Verifikasi</span>
                                    @elseif($booking->status == 'confirmed')
                                        <span class="px-4 py-1.5 bg-green-500/10 border border-green-500/20 text-green-500 text-[9px] font-black uppercase rounded-lg">Sesi Aktif</span>
                                    @else
                                        <span class="px-4 py-1.5 bg-slate-800 text-slate-500 text-[9px] font-black uppercase rounded-lg">{{ $booking->status }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center opacity-20">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
                                        <p class="font-orbitron text-sm uppercase tracking-widest">Belum ada riwayat sewa sultan.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-12 text-center">
                <p class="text-[10px] text-slate-600 uppercase tracking-[0.5em] font-bold">&copy; 2026 ALIA RENTAL PS PRO - ALL SYSTEMS OPERATIONAL</p>
            </div>

        </div>
    </div>
</x-app-layout>
