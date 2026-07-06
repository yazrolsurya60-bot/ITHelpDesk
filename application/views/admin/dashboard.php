<div class="mb-8">
    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-2">Dashboard Admin</h2>
    <p class="text-slate-500">Ringkasan tiket pelayanan IT dan pemantauan kinerja staf secara langsung.</p>
</div>

<!-- Stat Blocks -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <!-- Stat 1 -->
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200 relative overflow-hidden group">
        <div
            class="absolute top-0 right-0 w-24 h-24 bg-amber-50 rounded-full blur-2xl -mr-8 -mt-8 group-hover:bg-amber-100 transition-colors duration-500">
        </div>
        <div class="relative z-10 flex items-start justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Tiket Menunggu</p>
                <h3 class="text-5xl font-extrabold text-slate-900 tracking-tighter"><?php echo $tickets_pending; ?></h3>
            </div>
            <div
                class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-amber-500 shadow-sm border border-slate-100">
                <i class="fas fa-clock text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Stat 2 -->
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200 relative overflow-hidden group">
        <div
            class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-full blur-2xl -mr-8 -mt-8 group-hover:bg-blue-100 transition-colors duration-500">
        </div>
        <div class="relative z-10 flex items-start justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Sedang Dikerjakan</p>
                <h3 class="text-5xl font-extrabold text-slate-900 tracking-tighter"><?php echo $tickets_in_progress; ?>
                </h3>
            </div>
            <div
                class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-blue-500 shadow-sm border border-slate-100">
                <i class="fas fa-spinner fa-spin text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Stat 3 -->
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200 relative overflow-hidden group">
        <div
            class="absolute top-0 right-0 w-24 h-24 bg-emerald-600/5 rounded-full blur-2xl -mr-8 -mt-8 group-hover:bg-emerald-600/10 transition-colors duration-500">
        </div>
        <div class="relative z-10 flex items-start justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Tiket Selesai</p>
                <h3 class="text-5xl font-extrabold text-slate-900 tracking-tighter"><?php echo $tickets_done; ?></h3>
            </div>
            <div
                class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-emerald-600 shadow-sm border border-slate-100">
                <i class="fas fa-check-circle text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Chart & Insight Section (Moved from Laporan) -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    <!-- Chart -->
    <div
        class="lg:col-span-1 bg-white border border-slate-200 rounded-3xl p-6 flex flex-col items-center justify-center shadow-sm relative overflow-hidden">
        <h4 class="font-extrabold text-slate-900 mb-6 text-center w-full border-b border-slate-100 pb-3">Status
            Penanganan Tiket</h4>
        <div class="w-full max-w-[200px] aspect-square relative">
            <canvas id="statusChart"></canvas>
        </div>
    </div>

    <!-- Top Assets -->
    <div class="lg:col-span-2 bg-white border border-slate-200 rounded-3xl p-6 shadow-sm">
        <h4 class="font-extrabold text-slate-900 mb-4 text-center w-full border-b border-slate-100 pb-3">Top 5 Aset
            Sering Rusak</h4>
        <?php if (empty($top_assets)): ?>
            <p class="text-slate-400 text-sm italic text-center py-4 font-medium">Belum ada data kerusakan aset.</p>
        <?php else: ?>
            <ul class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-4">
                <?php foreach ($top_assets as $i => $ta): ?>
                    <li class="flex justify-between items-center bg-slate-50/80 p-3 rounded-2xl border border-slate-100">
                        <div class="flex items-center gap-4">
                            <span
                                class="w-8 h-8 rounded-full bg-white text-slate-500 flex items-center justify-center text-xs font-bold border border-slate-200 shadow-sm shrink-0"><?php echo $i + 1; ?></span>
                            <div>
                                <p class="text-sm font-bold text-slate-900 line-clamp-1" title="<?php echo $ta->nama_asset; ?>">
                                    <?php echo $ta->nama_asset; ?></p>
                                <p class="text-[10px] text-slate-500 uppercase font-bold tracking-wider">
                                    <?php echo $ta->jenis_asset; ?></p>
                            </div>
                        </div>
                        <span
                            class="px-3 py-1 bg-rose-50 border border-rose-200 text-rose-600 font-bold text-xs rounded-full ml-2"><?php echo $ta->total_rusak; ?>x</span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>

<!-- Live Monitoring Table -->
<div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden mb-8 relative">
    <div
        class="p-6 md:p-8 border-b border-slate-100 flex flex-col md:flex-row justify-between items-start md:items-center bg-slate-50/50 gap-4">
        <div>
            <h3 class="text-xl font-extrabold text-slate-900">Pemantauan Kinerja Staf</h3>
            <p class="text-sm text-slate-500 mt-1">Live monitoring penugasan aktif (diperbarui otomatis).</p>
        </div>
        <div class="flex items-center gap-4 w-full md:w-auto">
            <div class="flex items-center gap-2">
                <span class="relative flex h-3 w-3">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-600 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-600"></span>
                </span>
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Live</span>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr
                    class="bg-emerald-600/10 text-emerald-600 font-bold text-xs uppercase tracking-widest border-b border-emerald-600/20">
                    <th class="px-6 py-4 font-bold">ID Tiket</th>
                    <th class="px-6 py-4 font-bold">Staf Penanggung Jawab</th>
                    <th class="px-6 py-4 font-bold">Kategori Masalah</th>
                    <th class="px-6 py-4 font-bold">Waktu Mulai</th>
                    <th class="px-6 py-4 font-bold text-center">Status & Durasi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                <?php if (empty($tickets_monitoring)): ?>
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <i class="fas fa-inbox text-4xl mb-3 opacity-50"></i>
                                <p class="font-medium">Tidak ada tiket yang sedang dikerjakan saat ini.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($tickets_monitoring as $tm):
                    $waktu_dibuat = strtotime($tm->waktu_dibuat);
                    $waktu_sekarang = time();
                    $diff_seconds = $waktu_sekarang - $waktu_dibuat;
                    $hours = floor($diff_seconds / 3600);
                    $minutes = floor(($diff_seconds % 3600) / 60);

                    // Determine styling based on duration (e.g., > 2 hours is red)
                    $duration_class = ($hours >= 2) ? 'bg-rose-50 text-rose-600 border border-rose-200' : 'bg-slate-50 text-slate-600 border border-slate-200';
                    ?>
                    <tr class="border-b border-slate-100 hover:bg-slate-50/80 transition-colors">
                        <td class="px-6 py-5 font-bold text-slate-900">
                            <span
                                class="text-slate-400 font-normal">#</span><?php echo str_pad($tm->id_tiket, 4, '0', STR_PAD_LEFT); ?>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-slate-900/5 border border-slate-900/10 text-slate-900 flex items-center justify-center font-bold text-sm shrink-0">
                                    <?php echo strtoupper(substr($tm->nama_staf, 0, 2)); ?>
                                </div>
                                <span class="font-semibold text-slate-900"><?php echo $tm->nama_staf; ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold">
                                <?php echo $tm->nama_kategori; ?>
                            </span>
                        </td>
                        <td class="px-6 py-5 text-slate-500 font-medium">
                            <?php echo date('d M Y', $waktu_dibuat); ?><br>
                            <span class="text-xs"><?php echo date('H:i', $waktu_dibuat); ?> WIB</span>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex flex-col items-center gap-2">
                                <?php if ($tm->status_tiket == 'Menuju Lokasi'): ?>
                                    <span
                                        class="text-[10px] bg-amber-50 border border-amber-200 text-amber-700 px-2.5 py-1 rounded-full font-bold uppercase tracking-wider">Menuju
                                        Lokasi</span>
                                <?php else: ?>
                                    <span
                                        class="text-[10px] bg-emerald-600/10 border border-emerald-600/20 text-emerald-600 px-2.5 py-1 rounded-full font-bold uppercase tracking-wider">Sedang
                                        Dikerjakan</span>
                                <?php endif; ?>

                                <span class="px-3 py-1 rounded-full text-xs font-bold <?php echo $duration_class; ?>">
                                    <i class="fas fa-stopwatch mr-1 opacity-70"></i> <?php echo $hours; ?>j
                                    <?php echo $minutes; ?>m
                                </span>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Refresh halaman setiap 15 detik untuk update real-time
    setTimeout(function () {
        window.location.reload();
    }, 15000);
</script>

<!-- Script for Chart (Moved from Laporan) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('statusChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Menunggu', 'Dikerjakan', 'Selesai'],
                datasets: [{
                    data: [
                        <?php echo $chart_data['Menunggu'] ?? 0; ?>,
                        <?php echo $chart_data['Dikerjakan'] ?? 0; ?>,
                        <?php echo $chart_data['Selesai'] ?? 0; ?>
                    ],
                    backgroundColor: [
                        '#F59E0B', // amber-500
                        '#3B82F6', // blue-500
                        '#10B981'  // emerald-500
                    ],
                    hoverOffset: 4,
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                family: "'Outfit', sans-serif",
                                size: 12,
                                weight: '600'
                            },
                            color: '#475569',
                            usePointStyle: true,
                            padding: 20
                        }
                    }
                },
                cutout: '75%'
            }
        });
    });
</script>