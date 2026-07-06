<div class="mb-8">
    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-2">Laporan & Analitik Tiket</h2>
    <p class="text-slate-500">Pantau performa layanan IT dan ekspor data laporan.</p>
</div>

<!-- Header Card -->
<div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 md:p-8 mb-8 relative overflow-hidden">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <h3 class="text-xl font-bold text-slate-900"><i class="fas fa-chart-pie mr-2 text-emerald-600"></i>Analitik Kendala IT</h3>
        <div class="flex gap-3 w-full md:w-auto">
            <a href="<?php echo base_url('admin/export_pdf?tahun='.$selected_tahun.'&kategori_id='.$selected_kategori); ?>" target="_blank" 
               class="flex-1 md:flex-none justify-center px-5 py-2.5 bg-rose-50 text-rose-600 rounded-full text-sm font-bold hover:bg-rose-100 transition-colors flex items-center border border-rose-200">
                <i class="fas fa-file-pdf mr-2"></i> Cetak PDF
            </a>
            <a href="<?php echo base_url('admin/export_excel?tahun='.$selected_tahun.'&kategori_id='.$selected_kategori); ?>" 
               class="flex-1 md:flex-none justify-center px-5 py-2.5 bg-emerald-600/10 text-emerald-600 rounded-full text-sm font-bold hover:bg-emerald-600/20 transition-colors flex items-center border border-emerald-600/20">
                <i class="fas fa-file-excel mr-2"></i> Export Excel
            </a>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 mb-8">
        <form action="<?php echo base_url('admin/laporan'); ?>" method="GET" class="flex flex-col md:flex-row gap-5 items-end">
            <div class="w-full md:w-1/3">
                <label class="block text-sm font-bold text-slate-900 mb-2">Filter Tahun</label>
                <select name="tahun" class="w-full border border-slate-200 bg-white rounded-2xl px-4 py-3 outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                    <option value="">Semua Tahun</option>
                    <?php foreach($years as $y): ?>
                        <option value="<?php echo $y; ?>" <?php echo ($selected_tahun == $y) ? 'selected' : ''; ?>><?php echo $y; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="w-full md:w-1/3">
                <label class="block text-sm font-bold text-slate-900 mb-2">Kategori Kendala</label>
                <select name="kategori_id" class="w-full border border-slate-200 bg-white rounded-2xl px-4 py-3 outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                    <option value="">Semua Kategori</option>
                    <?php foreach($categories as $c): ?>
                        <option value="<?php echo $c->id_kategori; ?>" <?php echo ($selected_kategori == $c->id_kategori) ? 'selected' : ''; ?>><?php echo $c->nama_kategori; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="w-full md:w-1/3 flex gap-3">
                <button type="submit" class="w-full bg-slate-900 text-white px-4 py-3 rounded-full font-bold hover:bg-slate-900Dark transition-colors shadow-lg shadow-slate-900/20">
                    Terapkan Filter
                </button>
                <a href="<?php echo base_url('admin/laporan'); ?>" class="w-full text-center bg-white text-slate-600 border border-slate-200 px-4 py-3 rounded-full font-bold hover:bg-slate-50 transition-colors">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="lg:col-span-3">
        <div class="overflow-x-auto rounded-3xl border border-slate-200 shadow-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-emerald-600/10 text-emerald-600 text-xs uppercase tracking-widest border-b border-emerald-600/20">
                            <th class="px-5 py-4 font-bold">Waktu Dibuat</th>
                            <th class="px-5 py-4 font-bold">Aset Terkait</th>
                            <th class="px-5 py-4 font-bold">Kategori</th>
                            <th class="px-5 py-4 font-bold">Teknisi</th>
                            <th class="px-5 py-4 font-bold text-center">Status</th>
                            <th class="px-5 py-4 font-bold text-center">Durasi Penyelesaian</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <?php if(empty($tickets)): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-slate-400">
                                        <i class="fas fa-file-invoice text-4xl mb-3 opacity-50"></i>
                                        <p class="font-medium">Data laporan kosong.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php foreach($tickets as $t): ?>
                        <tr class="border-b border-slate-100 hover:bg-slate-50/80 transition-colors">
                            <td class="px-5 py-4">
                                <span class="font-semibold text-slate-900"><?php echo date('d M Y', strtotime($t->waktu_dibuat)); ?></span><br>
                                <span class="text-xs text-slate-500"><?php echo date('H:i', strtotime($t->waktu_dibuat)); ?> WIB</span>
                            </td>
                            <td class="px-5 py-4 text-xs font-bold text-emerald-600"><?php echo $t->nama_asset ? $t->nama_asset : '<span class="text-slate-400 font-normal italic">-</span>'; ?></td>
                            <td class="px-5 py-4 text-sm font-semibold text-slate-600"><?php echo $t->nama_kategori; ?></td>
                            <td class="px-5 py-4 text-sm text-slate-900 font-medium"><?php echo $t->nama_staf ? $t->nama_staf : '<span class="text-slate-400 font-normal italic">-</span>'; ?></td>
                            <td class="px-5 py-4 text-center">
                                <?php if($t->status_tiket == 'Menunggu'): ?>
                                    <span class="inline-flex px-2.5 py-1 bg-amber-50 text-amber-600 border border-amber-200 text-[10px] font-bold rounded-full tracking-wider">MENUNGGU</span>
                                <?php elseif($t->status_tiket == 'Dikerjakan' || $t->status_tiket == 'Menuju Lokasi'): ?>
                                    <span class="inline-flex px-2.5 py-1 bg-blue-50 text-blue-600 border border-blue-200 text-[10px] font-bold rounded-full tracking-wider">PROSES</span>
                                <?php else: ?>
                                    <span class="inline-flex px-2.5 py-1 bg-emerald-600/10 text-emerald-600 border border-emerald-600/20 text-[10px] font-bold rounded-full tracking-wider">SELESAI</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-5 py-4 text-center text-sm font-bold text-slate-600">
                                <?php 
                                    if($t->status_tiket == 'Selesai' && $t->waktu_selesai) {
                                        $start = strtotime($t->waktu_dibuat);
                                        $end = strtotime($t->waktu_selesai);
                                        $diff = $end - $start;
                                        $jam = floor($diff / 3600);
                                        $menit = floor(($diff % 3600) / 60);
                                        echo $jam . 'j ' . $menit . 'm';
                                    } else if (in_array($t->status_tiket, ['Dikerjakan','Menuju Lokasi'])) {
                                        echo "<span class='text-blue-500 text-xs italic font-medium'>Berjalan...</span>";
                                    } else {
                                        echo '<span class="text-slate-400 font-normal">-</span>';
                                    }
                                ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


