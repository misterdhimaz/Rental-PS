<x-app-layout>
    <div class="p-6 sm:p-12 space-y-12 bg-dark min-h-screen text-white"
         x-data="{ openAdd: false, openEdit: false, selectedConsole: {} }">

        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div data-aos="fade-right">
                <h2 class="font-orbitron text-3xl font-black italic tracking-tighter uppercase">
                    KELOLA <span class="text-primary italic">UNIT</span>
                </h2>
                <p class="text-slate-500 text-[10px] font-bold uppercase tracking-[0.3em] mt-2">Inventory Management Sultan Core</p>
            </div>
            <button @click="openAdd = true"
                class="px-8 py-4 bg-primary text-dark-950 font-orbitron font-black text-[10px] tracking-widest rounded-2xl shadow-lg shadow-primary/20 hover:scale-105 transition-all uppercase">
                + Tambah Unit Baru
            </button>
        </div>

        <div class="glass-card rounded-[2.5rem] overflow-hidden border border-white/5 bg-slate-900/40 shadow-2xl" data-aos="fade-up">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white/[0.02] text-slate-500 text-[9px] font-black uppercase tracking-[0.3em]">
                            <th class="px-10 py-6">Nama Unit</th>
                            <th class="px-10 py-6">Kategori</th>
                            <th class="px-10 py-6">Harga / Jam</th>
                            <th class="px-10 py-6">Status</th>
                            <th class="px-10 py-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($consoles as $console)
                        <tr class="hover:bg-white/[0.01] transition-all group">
                            <td class="px-10 py-6 font-bold uppercase tracking-tighter text-white group-hover:text-primary transition-colors">
                                {{ $console->name }}
                            </td>
                            <td class="px-10 py-6">
                                <span class="text-primary text-[10px] font-black uppercase tracking-widest">
                                    {{ $console->category->name }}
                                </span>
                            </td>
                            <td class="px-10 py-6 font-orbitron text-sm text-slate-300">
                                Rp {{ number_format($console->price_per_hour, 0, ',', '.') }}
                            </td>
                            <td class="px-10 py-6">
                                <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase {{ $console->status == 'available' ? 'bg-green-500/10 text-green-400' : ($console->status == 'maintenance' ? 'bg-orange-500/10 text-orange-400' : 'bg-red-500/10 text-red-400') }}">
                                    {{ $console->status }}
                                </span>
                            </td>
                            <td class="px-10 py-6 text-right">
                                <div class="flex justify-end gap-3">
                                    <button @click="selectedConsole = {{ $console }}; openEdit = true"
                                            class="p-2 bg-white/5 rounded-lg hover:text-primary transition-colors">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </button>

                                    <form action="{{ route('admin.consoles.delete', $console->id) }}" method="POST" onsubmit="return confirm('Protokol Penghapusan: Yakin hapus unit ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="p-2 bg-white/5 rounded-lg hover:text-red-500 transition-colors">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="openAdd" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-dark/95 backdrop-blur-md">
            <div class="glass-card w-full max-w-lg p-10 rounded-[2.5rem] border border-primary/20 bg-slate-900 shadow-2xl">
                <h3 class="font-orbitron font-black text-xl mb-8 uppercase italic tracking-tighter text-white">
                    TAMBAH <span class="text-primary">UNIT BARU</span>
                </h3>
                <form action="{{ route('admin.consoles.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest ml-1">Nama Unit</label>
                        <input type="text" name="name" required class="w-full bg-slate-950 border border-white/10 rounded-xl py-4 px-5 text-sm text-white focus:border-primary outline-none transition-all">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest ml-1">Kategori Console</label>
                        <select name="category_id" class="w-full bg-slate-950 border border-white/10 rounded-xl py-4 px-5 text-sm text-white focus:border-primary outline-none appearance-none">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest ml-1">Harga Per Jam (Rp)</label>
                        <input type="number" name="price_per_hour" required class="w-full bg-slate-950 border border-white/10 rounded-xl py-4 px-5 text-sm text-white focus:border-primary outline-none">
                    </div>
                    <div class="flex gap-4 mt-10">
                        <button type="button" @click="openAdd = false" class="flex-1 py-4 text-[10px] font-black uppercase text-slate-500 tracking-widest hover:text-white">Batal</button>
                        <button type="submit" class="flex-1 py-4 bg-primary text-dark-950 rounded-xl font-orbitron font-black text-[10px] uppercase tracking-widest shadow-lg shadow-primary/20 hover:scale-105 transition-all">Aktifkan Unit</button>
                    </div>
                </form>
            </div>
        </div>

        <div x-show="openEdit" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-dark/95 backdrop-blur-md">
            <div class="glass-card w-full max-w-lg p-10 rounded-[2.5rem] border border-primary/20 bg-slate-900 shadow-2xl">
                <h3 class="font-orbitron font-black text-xl mb-8 uppercase italic tracking-tighter text-white">
                    EDIT <span class="text-primary">UNIT SULTAN</span>
                </h3>

                <form :action="'/admin/consoles/' + selectedConsole.id + '/update'" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-2">
                        <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest ml-1">Nama Unit</label>
                        <input type="text" name="name" x-model="selectedConsole.name" required
                               class="w-full bg-slate-950 border border-white/10 rounded-xl py-4 px-5 text-sm text-white focus:border-primary outline-none">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest ml-1">Kategori Console</label>
                        <select name="category_id" x-model="selectedConsole.category_id"
                                class="w-full bg-slate-950 border border-white/10 rounded-xl py-4 px-5 text-sm text-white focus:border-primary outline-none appearance-none">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest ml-1">Harga (Rp)</label>
                            <input type="number" name="price_per_hour" x-model="selectedConsole.price_per_hour" required
                                   class="w-full bg-slate-950 border border-white/10 rounded-xl py-4 px-5 text-sm text-white focus:border-primary outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest ml-1">Status Unit</label>
                            <select name="status" x-model="selectedConsole.status"
                                    class="w-full bg-slate-950 border border-white/10 rounded-xl py-4 px-5 text-sm text-white focus:border-primary outline-none appearance-none">
                                <option value="available">Available</option>
                                <option value="unavailable">Unavailable</option>
                                <option value="maintenance">Maintenance</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex gap-4 mt-10">
                        <button type="button" @click="openEdit = false" class="flex-1 py-4 text-[10px] font-black uppercase text-slate-500 tracking-widest hover:text-white">Batal</button>
                        <button type="submit" class="flex-1 py-4 bg-primary text-dark-950 rounded-xl font-orbitron font-black text-[10px] uppercase tracking-widest shadow-lg shadow-primary/20">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
