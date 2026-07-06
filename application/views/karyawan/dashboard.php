<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h3 class="text-lg font-bold text-slate-800">Riwayat Tiket Saya</h3>
        <button onclick="openLaporModal()" class="bg-emerald-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-emerald-700 transition flex items-center shadow-sm">
            <i class="fas fa-plus mr-2"></i> Buat Laporan Baru
        </button>
    </div>
    


    <!-- Tiket Saya -->
    <div class="overflow-x-auto border border-slate-200 rounded-xl">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-emerald-600 text-white text-sm border-b border-emerald-700">
                    <th class="p-4 font-semibold rounded-tl-xl">Tanggal</th>
                    <th class="p-4 font-semibold">Kategori</th>
                    <th class="p-4 font-semibold">Detail</th>
                    <th class="p-4 font-semibold text-center rounded-tr-xl">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($tickets)): ?>
                <tr>
                    <td colspan="4" class="p-8 text-center text-slate-500">
                        <i class="fas fa-ticket-alt text-4xl mb-3 text-slate-300"></i>
                        <p>Belum ada tiket yang diajukan.</p>
                    </td>
                </tr>
                <?php endif; ?>
                
                <?php foreach($tickets as $t): ?>
                <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                    <td class="p-4 text-sm text-slate-700 whitespace-nowrap"><?php echo date('d M Y H:i', strtotime($t->waktu_dibuat)); ?></td>
                    <td class="p-4 text-sm font-medium text-slate-800"><?php echo $t->nama_kategori; ?></td>
                    <td class="p-4 text-sm text-slate-600 max-w-md"><?php echo $t->deskripsi_masalah; ?></td>
                    <td class="p-4 text-center">
                        <div class="flex flex-col items-center gap-2">
                            <?php if($t->status_tiket == 'Menunggu'): ?>
                                <span class="px-3 py-1.5 bg-amber-50 text-amber-600 border border-amber-200 text-[11px] uppercase tracking-wide font-bold rounded-lg w-full flex items-center justify-center gap-1.5 shadow-sm"><i class="fas fa-clock"></i> MENUNGGU</span>
                            <?php elseif($t->status_tiket == 'Menuju Lokasi'): ?>
                                <span class="px-3 py-1.5 bg-indigo-50 text-indigo-600 border border-indigo-200 text-[11px] uppercase tracking-wide font-bold rounded-lg w-full flex items-center justify-center gap-1.5 shadow-sm"><i class="fas fa-motorcycle"></i> MENUJU LOKASI</span>
                            <?php elseif($t->status_tiket == 'Dikerjakan'): ?>
                                <span class="px-3 py-1.5 bg-blue-50 text-blue-600 border border-blue-200 text-[11px] uppercase tracking-wide font-bold rounded-lg w-full flex items-center justify-center gap-1.5 shadow-sm"><i class="fas fa-tools"></i> DIKERJAKAN</span>
                            <?php else: ?>
                                <span class="px-3 py-1.5 bg-emerald-50 text-emerald-600 border border-emerald-200 text-[11px] uppercase tracking-wide font-bold rounded-lg w-full flex items-center justify-center gap-1.5 shadow-sm mb-2"><i class="fas fa-check-circle"></i> SELESAI</span>
                                
                                <!-- Tombol Evaluasi (Hanya muncul jika belum dievaluasi/rating masih null di DB) -->
                                <form action="<?php echo base_url('karyawan/evaluasi'); ?>" method="POST" class="w-full">
                                    <input type="hidden" name="tiket_id" value="<?php echo $t->id_tiket; ?>">
                                    <select name="rating" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-2 py-1.5 text-xs font-medium text-slate-700 outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 mb-1.5 cursor-pointer transition">
                                        <option value="">Beri Nilai</option>
                                        <option value="5">⭐⭐⭐⭐⭐</option>
                                        <option value="4">⭐⭐⭐⭐</option>
                                        <option value="3">⭐⭐⭐</option>
                                        <option value="2">⭐⭐</option>
                                        <option value="1">⭐</option>
                                    </select>
                                    <button type="submit" class="w-full bg-emerald-600 text-white font-semibold text-xs py-1.5 rounded-lg hover:bg-emerald-700 transition shadow-sm">Kirim</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Buat Laporan -->
<div id="laporModal" class="fixed inset-0 bg-slate-900 bg-opacity-50 flex items-center justify-center hidden z-50 p-4 overflow-y-auto">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-slate-800">Buat Tiket Pelaporan</h3>
            <button onclick="closeLaporModal()" class="text-slate-400 hover:text-slate-600"><i class="fas fa-times text-xl"></i></button>
        </div>
        <p class="text-slate-500 text-sm mb-6 pb-4 border-b border-slate-100">Silakan isi form di bawah ini dengan detail kendala Anda.</p>
        
        <?php echo form_open_multipart('karyawan/lapor'); ?>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Kategori Kendala</label>
                    <select name="category_id" id="selectKategori" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 outline-none focus:border-emerald-500 focus:bg-white transition">
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach($categories as $c): ?>
                        <option value="<?php echo $c->id_kategori; ?>" data-nama-kategori="<?php echo $c->nama_kategori; ?>"><?php echo $c->nama_kategori; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Lokasi (Lantai/Ruang)</label>
                    <select name="location_id" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 outline-none focus:border-emerald-500 focus:bg-white transition">
                        <option value="">-- Pilih Lokasi --</option>
                        <?php foreach($locations as $l): ?>
                        <option value="<?php echo $l->id_lokasi; ?>"><?php echo $l->lantai . " - " . $l->nama_ruangan; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div id="assetSection" class="hidden">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Aset / Perangkat yang Rusak <span class="text-slate-400 font-normal">(Opsional)</span></label>
                    <select name="asset_id" id="selectAsset" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 outline-none focus:border-emerald-500 focus:bg-white transition">
                        <option value="">-- Pilih Aset --</option>
                        <?php foreach($assets as $a): ?>
                        <option value="<?php echo $a->id_asset; ?>" data-kategori="<?php echo $a->jenis_asset; ?>" <?php echo ($a->kondisi != 'Baik') ? 'disabled' : ''; ?>>
                            <?php echo $a->nama_asset; ?> (<?php echo $a->jenis_asset; ?>)
                            <?php if($a->kondisi != 'Baik') echo ' - Sedang ' . $a->kondisi; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="text-xs text-emerald-600 font-medium mt-1"><i class="fas fa-info-circle mr-1"></i>Pilih aset fisik yang terkait dengan kendala ini</p>
                </div>
                
                <div id="assetNotApplicable" class="hidden">
                    <div class="flex items-center gap-2 bg-slate-50 border border-slate-200 rounded-lg px-4 py-3">
                        <i class="fas fa-info-circle text-slate-400"></i>
                        <p class="text-sm text-slate-500">Kategori ini tidak memerlukan pemilihan aset fisik.</p>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Detail Masalah</label>
                    <textarea name="description" required rows="4" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 outline-none focus:border-emerald-500 focus:bg-white transition" placeholder="Ceritakan detail kendala secara lengkap..."></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Upload Foto / Screenshot (Opsional)</label>
                    <input type="file" name="photo" accept="image/*" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 outline-none focus:border-emerald-500 focus:bg-white transition text-sm">
                </div>
                
                <div class="flex justify-end space-x-3 pt-4 border-t border-slate-100">
                    <button type="button" onclick="closeLaporModal()" class="px-5 py-2.5 bg-slate-100 text-slate-700 rounded-lg font-medium hover:bg-slate-200 transition">Batal</button>
                    <button type="submit" class="px-5 py-2.5 bg-emerald-600 text-white rounded-lg font-medium hover:bg-emerald-700 transition flex items-center shadow-md hover:shadow-lg">
                        <i class="fas fa-paper-plane mr-2"></i> Kirim Tiket
                    </button>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
    const categoryAssetMap = <?php echo $category_asset_map; ?>;
    
    function openLaporModal() {
        document.getElementById('laporModal').classList.remove('hidden');
        toggleAssetSection(); // reset on open
    }
    
    function closeLaporModal() {
        document.getElementById('laporModal').classList.add('hidden');
    }

    function toggleAssetSection() {
        const kategoriSelect = document.getElementById('selectKategori');
        const selectedId = kategoriSelect.value;
        const selectedOption = kategoriSelect.options[kategoriSelect.selectedIndex];
        const selectedName = selectedOption ? selectedOption.getAttribute('data-nama-kategori') : '';
        
        const assetSection = document.getElementById('assetSection');
        const assetNotApplicable = document.getElementById('assetNotApplicable');
        const assetSelect = document.getElementById('selectAsset');
        
        if (!selectedId) {
            // Nothing selected yet — hide both
            assetSection.classList.add('hidden');
            assetNotApplicable.classList.add('hidden');
        } else if (categoryAssetMap[selectedId] === true) {
            // Category supports assets — show picker
            assetSection.classList.remove('hidden');
            assetNotApplicable.classList.add('hidden');
            
            // Filter assets by category name
            for (let i = 0; i < assetSelect.options.length; i++) {
                const opt = assetSelect.options[i];
                if (opt.value === "") continue; // skip the placeholder option
                
                if (opt.getAttribute('data-kategori') === selectedName) {
                    opt.style.display = 'block';
                } else {
                    opt.style.display = 'none';
                }
            }
            assetSelect.value = ""; // reset selected asset
        } else {
            // Category does NOT support assets — show info
            assetSection.classList.add('hidden');
            assetNotApplicable.classList.remove('hidden');
            assetSelect.value = "";
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const sel = document.getElementById('selectKategori');
        if (sel) sel.addEventListener('change', toggleAssetSection);
    });
</script>
