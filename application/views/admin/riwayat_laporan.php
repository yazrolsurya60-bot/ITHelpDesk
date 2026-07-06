<div class="mb-8">
    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-2">Riwayat & Rekap Laporan</h2>
    <p class="text-slate-500">Generate laporan bulanan dan simpan riwayat kinerjanya.</p>
</div>


<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Generate Laporan Baru -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 md:p-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-600/5 rounded-full blur-3xl -mr-12 -mt-12"></div>
            <div class="relative z-10">
                <h3 class="text-xl font-extrabold text-slate-900 mb-2">Generate Laporan</h3>
                <p class="text-slate-500 text-sm mb-6">Pilih periode laporan untuk disimpan sebagai arsip permanen bulanan.</p>
                
                <?php echo form_open('admin/generate_report', ['class' => 'space-y-5']); ?>
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-900">Bulan</label>
                    <select name="bulan" required class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3.5 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                        <?php
                        $namaBulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                        for($i = 1; $i <= 12; $i++): ?>
                        <option value="<?php echo $i; ?>" <?php echo ($i == date('n')) ? 'selected' : ''; ?>><?php echo $namaBulan[$i-1]; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-900">Tahun</label>
                    <select name="tahun" required class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3.5 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                        <?php for($y = date('Y'); $y >= date('Y') - 3; $y--): ?>
                        <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                
                <button type="submit" class="w-full bg-emerald-600 text-white py-3.5 rounded-full font-bold hover:bg-emerald-600 transition-colors shadow-lg shadow-emerald-600/20 flex items-center justify-center gap-2 mt-4">
                    <i class="fas fa-save"></i> Simpan Rekap Laporan
                </button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <!-- Riwayat Laporan -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 md:p-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-extrabold text-slate-900">Arsip Laporan Bulanan</h3>
            </div>

            <?php if(empty($reports)): ?>
                <div class="py-16 px-4 text-center text-slate-400 bg-slate-50 rounded-2xl border border-slate-100 border-dashed">
                    <i class="far fa-folder-open text-5xl mb-4 opacity-50"></i>
                    <p class="font-bold text-slate-500">Arsip Kosong</p>
                    <p class="text-sm mt-1">Belum ada laporan yang digenerate dan disimpan.</p>
                </div>
            <?php else: ?>
            <div class="overflow-x-auto border border-slate-200 rounded-2xl">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-emerald-600/10 text-emerald-600 text-xs uppercase tracking-widest border-b border-emerald-600/20">
                            <th class="px-5 py-4 font-bold">Judul & Kreator</th>
                            <th class="px-5 py-4 font-bold text-center">Total Tiket</th>
                            <th class="px-5 py-4 font-bold text-center">Status Selesai</th>
                            <th class="px-5 py-4 font-bold text-center">Avg. Durasi</th>
                            <th class="px-5 py-4 font-bold">Tanggal Dibuat</th>
                            <th class="px-5 py-4 font-bold text-center w-24">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <?php foreach($reports as $r): ?>
                        <tr class="border-b border-slate-100 hover:bg-slate-50/80 transition-colors">
                            <td class="px-5 py-4">
                                <p class="font-bold text-slate-900 text-[15px]"><?php echo $r->judul; ?></p>
                                <p class="text-xs text-slate-500 font-medium flex items-center gap-1 mt-0.5">
                                    <i class="fas fa-user-circle"></i> <?php echo $r->nama_admin ?? 'Sistem'; ?>
                                </p>
                            </td>
                            <td class="px-5 py-4 text-center">
                                <span class="font-extrabold text-lg text-slate-900"><?php echo $r->total_tiket; ?></span>
                            </td>
                            <td class="px-5 py-4 text-center">
                                <div class="flex flex-col items-center gap-1">
                                    <span class="inline-flex px-2 py-0.5 bg-emerald-600/10 text-emerald-600 border border-emerald-600/20 text-xs font-bold rounded-full w-20 justify-center">
                                        <?php echo $r->tiket_selesai; ?> OK
                                    </span>
                                    <span class="inline-flex px-2 py-0.5 bg-amber-50 text-amber-600 border border-amber-200 text-[10px] font-bold rounded-full w-20 justify-center">
                                        <?php echo $r->tiket_pending; ?> Pending
                                    </span>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-center text-sm font-bold text-slate-600">
                                <?php echo $r->avg_durasi_menit ? $r->avg_durasi_menit . ' menit' : '<span class="text-slate-400 font-normal">-</span>'; ?>
                            </td>
                            <td class="px-5 py-4 text-sm font-semibold text-slate-600">
                                <?php echo date('d M Y', strtotime($r->created_at)); ?>
                            </td>
                            <td class="px-5 py-4 text-center">
                                <a href="<?php echo base_url('admin/delete_report/'.$r->id_report); ?>" 
                                   onclick="return confirm('Hapus permanen arsip laporan ini?')" 
                                   class="w-8 h-8 rounded-full bg-rose-100 text-rose-600 hover:bg-rose-500 hover:text-white flex items-center justify-center transition-colors mx-auto tooltip-btn" title="Hapus">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
