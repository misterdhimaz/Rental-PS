<x-app-layout>
    <div class="p-6 sm:p-12 space-y-12 bg-dark min-h-screen text-white">

        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h2 class="font-orbitron text-3xl font-black italic tracking-tighter uppercase">REVENUE <span class="text-primary">REPORTS</span></h2>
                <p class="text-slate-500 text-[10px] font-bold uppercase tracking-[0.3em] mt-2">Sultan Financial Monitoring System</p>
            </div>
            <div class="px-6 py-3 bg-white/5 border border-white/10 rounded-xl font-orbitron text-xs font-bold text-primary italic">
                Tahun Buku: {{ date('Y') }}
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <div class="glass-card p-8 rounded-[2.5rem] border border-white/5 bg-slate-900/40">
                <h3 class="text-xs font-black uppercase tracking-widest text-slate-500 mb-8">Tren Pendapatan Bulanan</h3>
                <canvas id="monthlyChart" height="200"></canvas>
            </div>

            <div class="glass-card p-8 rounded-[2.5rem] border border-white/5 bg-slate-900/40">
                <h3 class="text-xs font-black uppercase tracking-widest text-slate-500 mb-8">Dominasi Unit (Revenue per Category)</h3>
                <canvas id="categoryChart" height="200"></canvas>
            </div>
        </div>

        <div class="glass-card rounded-[2.5rem] overflow-hidden border border-white/5">
            <div class="p-10 bg-white/[0.02] border-b border-white/5">
                <h3 class="font-orbitron font-bold text-sm uppercase italic">Rincian Performa Kategori</h3>
            </div>
            <table class="w-full text-left">
                <thead class="bg-dark/50 text-[10px] font-black uppercase text-slate-500 tracking-widest">
                    <tr>
                        <th class="px-10 py-6">Kategori</th>
                        <th class="px-10 py-6">Total Pendapatan</th>
                        <th class="px-10 py-6 text-right">Persentase Kontribusi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @php $grandTotal = $categoryRevenue->sum('total'); @endphp
                    @foreach($categoryRevenue as $data)
                    <tr class="hover:bg-white/[0.01] transition-all">
                        <td class="px-10 py-6 font-bold uppercase tracking-widest text-primary">{{ $data->name }}</td>
                        <td class="px-10 py-6 font-orbitron">Rp {{ number_format($data->total, 0, ',', '.') }}</td>
                        <td class="px-10 py-6 text-right">
                            <span class="text-slate-400 font-bold">{{ number_format(($data->total / max($grandTotal, 1)) * 100, 1) }}%</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data Grafik Bulanan
        const ctxMonthly = document.getElementById('monthlyChart').getContext('2d');
        new Chart(ctxMonthly, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Pendapatan (IDR)',
                    data: [/* Data dari Backend */],
                    borderColor: '#00f2ff',
                    backgroundColor: 'rgba(0, 242, 255, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: { plugins: { legend: { display: false } }, scales: { y: { grid: { color: 'rgba(255,255,255,0.05)' } } } }
        });

        // Data Grafik Kategori
        const ctxCategory = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctxCategory, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($categoryRevenue->pluck('name')) !!},
                datasets: [{
                    data: {!! json_encode($categoryRevenue->pluck('total')) !!},
                    backgroundColor: ['#00f2ff', '#7000ff', '#ff00c8', '#00ff8c'],
                    borderWidth: 0
                }]
            }
        });
    </script>
</x-app-layout>
