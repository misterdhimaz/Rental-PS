<x-app-layout>
    <div class="p-6 lg:p-12 space-y-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-slate-900/40 border border-white/5 p-8 rounded-[2.5rem] relative overflow-hidden group hover:border-primary/30 transition-all">
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-primary/5 rounded-full blur-3xl group-hover:bg-primary/10 transition-all"></div>
                <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-4">Total Revenue</p>
                <p class="text-3xl font-orbitron font-black text-white">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
            </div>

            <div class="bg-slate-900/40 border border-white/5 p-8 rounded-[2.5rem] relative overflow-hidden group hover:border-primary/30 transition-all text-primary">
                <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-4">Active Units</p>
                <p class="text-3xl font-orbitron font-black leading-none">{{ $stats['active_bookings'] }} Unit</p>
            </div>

            </div>

        <div class="bg-slate-900/40 border border-white/5 rounded-[3rem] overflow-hidden shadow-2xl">
            <div class="p-10 border-b border-white/5 flex justify-between items-center bg-white/[0.01]">
                <h3 class="font-orbitron font-black text-white uppercase italic tracking-widest text-sm">Live Command Monitoring</h3>
                <span class="px-4 py-2 bg-primary/10 text-primary text-[9px] font-black rounded-full uppercase tracking-widest animate-pulse">Scanning...</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-white/[0.02] text-[9px] font-black text-slate-500 uppercase tracking-[0.3em]">
                            <th class="px-10 py-6">Identity</th>
                            <th class="px-10 py-6">Unit Protocol</th>
                            <th class="px-10 py-6">Status</th>
                            <th class="px-10 py-6 text-right">Command</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($bookings as $item)
                        <tr class="hover:bg-white/[0.01] transition-all group">
                            <td class="px-10 py-8">
                                <p class="text-sm font-black text-white uppercase tracking-tighter">{{ $item->user->name }}</p>
                                <p class="text-[9px] text-slate-500 uppercase mt-1">{{ $item->user->email }}</p>
                            </td>
                            <td class="px-10 py-8">
                                <span class="px-3 py-1 bg-primary/10 border border-primary/20 text-primary text-[10px] font-black rounded-lg uppercase italic">{{ $item->console->name }}</span>
                            </td>
                            <td class="px-10 py-8">
                                <div class="flex items-center gap-2">
                                    <div class="w-1.5 h-1.5 rounded-full {{ $item->status == 'pending' ? 'bg-yellow-500 animate-pulse' : 'bg-green-500' }}"></div>
                                    <span class="text-[10px] font-black uppercase tracking-widest {{ $item->status == 'pending' ? 'text-yellow-500' : 'text-green-500' }}">{{ $item->status }}</span>
                                </div>
                            </td>
                            <td class="px-10 py-8 text-right">
                                <form action="{{ route('admin.booking.status', $item->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="confirmed">
                                    <button class="p-3 bg-white/5 rounded-xl hover:bg-primary hover:text-dark transition-all">
                                        <i data-lucide="zap" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-10 py-16 text-center text-slate-600 uppercase text-xs font-black tracking-widest">No Incoming Sinyal Detected</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
