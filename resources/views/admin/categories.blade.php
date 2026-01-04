<x-app-layout>
    <div class="p-6 sm:p-12 space-y-12 bg-dark min-h-screen text-white" x-data="{ openAdd: false, openEdit: false, selectedCat: {} }">

        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-orbitron text-3xl font-black italic tracking-tighter uppercase">KELOLA <span class="text-secondary">KATEGORI</span></h2>
                <p class="text-slate-500 text-[10px] font-bold uppercase tracking-[0.3em] mt-2">Master Data Category System</p>
            </div>
            <button @click="openAdd = true" class="px-8 py-4 bg-secondary text-white font-orbitron font-black text-[10px] tracking-widest rounded-2xl shadow-lg shadow-secondary/20 hover:scale-105 transition-all uppercase">
                + Kategori Baru
            </button>
        </div>

        <div class="glass-card rounded-[2.5rem] overflow-hidden border border-white/5 bg-slate-900/40 shadow-2xl">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white/[0.02] text-slate-500 text-[9px] font-black uppercase tracking-[0.3em]">
                        <th class="px-10 py-6">Nama Kategori</th>
                        <th class="px-10 py-6">Jumlah Unit</th>
                        <th class="px-10 py-6">Slug Sistem</th>
                        <th class="px-10 py-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($categories as $cat)
                    <tr class="hover:bg-white/[0.01] transition-all group">
                        <td class="px-10 py-6 font-bold uppercase text-white group-hover:text-secondary transition-colors">{{ $cat->name }}</td>
                        <td class="px-10 py-6"><span class="px-3 py-1 bg-white/5 rounded-lg text-[10px] font-black text-slate-400">{{ $cat->consoles_count }} UNIT</span></td>
                        <td class="px-10 py-6 text-slate-500 text-xs font-mono">{{ $cat->slug }}</td>
                        <td class="px-10 py-6 text-right">
                            <div class="flex justify-end gap-3">
                                <button @click="selectedCat = {id: '{{$cat->id}}', name: '{{$cat->name}}'}; openEdit = true" class="p-2 hover:text-secondary transition-colors"><i data-lucide="edit-3" class="w-4 h-4"></i></button>
                                <form action="{{ route('admin.categories.delete', $cat->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="p-2 hover:text-red-500 transition-colors"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
<div x-show="openEdit" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-dark/95 backdrop-blur-md">
    <div class="glass-card w-full max-w-md p-10 rounded-[2.5rem] border border-secondary/30">
        <h3 class="font-orbitron font-black text-xl mb-8 uppercase italic text-secondary">EDIT KATEGORI</h3>

        <form :action="'/admin/categories/' + selectedCat.id + '/update'" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Nama Kategori</label>
                <input type="text" name="name" x-model="selectedCat.name" required class="w-full bg-slate-950 border border-white/10 rounded-xl py-4 px-5 text-sm text-white focus:border-secondary outline-none">
            </div>

            <div class="flex gap-4 mt-10">
                <button type="button" @click="openEdit = false" class="flex-1 py-4 text-[10px] font-black uppercase text-slate-500">Batal</button>
                <button type="submit" class="flex-1 py-4 bg-secondary text-white rounded-xl font-orbitron font-black text-[10px] uppercase shadow-lg shadow-secondary/20">Update Data</button>
            </div>
        </form>
    </div>
</div>
        <div x-show="openAdd" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-dark/95 backdrop-blur-md">
            <div class="glass-card w-full max-w-md p-10 rounded-[2.5rem] border border-secondary/30">
                <h3 class="font-orbitron font-black text-xl mb-8 uppercase italic text-secondary">TAMBAH KATEGORI</h3>
                <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2 text-left">
                        <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest ml-1">Nama Kategori (Contoh: Nintendo Switch)</label>
                        <input type="text" name="name" required class="w-full bg-slate-950 border border-white/10 rounded-xl py-4 px-5 text-sm text-white focus:border-secondary outline-none transition-all">
                    </div>
                    <div class="flex gap-4 mt-10">
                        <button type="button" @click="openAdd = false" class="flex-1 py-4 text-[10px] font-black uppercase text-slate-500">Batal</button>
                        <button type="submit" class="flex-1 py-4 bg-secondary text-white rounded-xl font-orbitron font-black text-[10px] uppercase shadow-lg shadow-secondary/20">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
